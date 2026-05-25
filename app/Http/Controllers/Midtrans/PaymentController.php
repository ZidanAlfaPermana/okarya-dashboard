<?php

namespace App\Http\Controllers\Midtrans;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Cart;
use App\Models\ItemTransaction;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PaymentController extends Controller
{
    private $rules = [
        'payment_method' => 'required|in:cash,cashless',
        'keterangan' => 'nullable|string|max:255',
        'checkout_type' => 'required|in:cart,direct',
    ];

    private $messages = [
        'required' => ':attribute Metode pembayaran wajib dipilih.',
        'in' => ':attribute Metode pembayaran tidak valid',
        'exists' => ':attribute Tidak ditemukan',
        'integer' => ':attribute harus berupa integer',
        'min' => ':attribute minimum kata atau value harus lebih dari :min',
    ];

    public function process(Request $request)
    {
        try {
            $rules = $this->rules;

            if ($request->checkout_type === 'direct') {
                $rules['id_barang'] = 'required|exists:barang,id_barang';
                $rules['qty'] = 'required|integer|min:1';
            }

            if ($request->payment_method === 'cashless') {
                $rules['channel_code'] = 'required|string|in:QRIS,ID_OVO,ID_DANA,ID_SHOPEEPAY,ID_LINKAJA';
            }

            $request->validate($rules, $this->messages);

            $userId = auth()->id();
            $checkoutType = $request->checkout_type;
            $paymentMethod = $request->payment_method;

            $itemsToProcess = [];

            if ($checkoutType === 'direct') {
                $barang = Barang::findOrFail($request->id_barang);

                if ($barang->stok < $request->qty) {
                    return $this->errorResponse(null, 'Stok tidak mencukupi', 'Stok terbatas');
                }

                $itemsToProcess[] = [
                    'id_barang' => $barang->id_barang,
                    'qty' => $request->qty,
                    'barang' => $barang
                ];
            } else {
                $carts = Cart::where('user_id', $userId)->with('barang')->get();
                if ($carts->isEmpty()) {
                    return $this->errorResponse(null, 'empty', 'Keranjang belanja anda kosong');
                }

                foreach ($carts as $cart) {
                    if (!$cart->barang) continue;

                    if ($cart->barang->stok < $cart->qty) {
                        return $this->errorResponse(null, "Stok {$cart->barang->nama_barang} tidak cukup", 'Stok terbatas');
                    }

                    $itemsToProcess[] = [
                        'id_barang' => $cart->id_barang,
                        'qty' => $cart->qty,
                        'barang' => $cart->barang
                    ];
                }
            }

            DB::beginTransaction();
            try {
                $kodeTransaksi = 'TRX-' . time() . '-' . Str::random(5);
                $totalHarga = 0;

                $pembayaran = Pembayaran::create([
                    'user_id' => $userId,
                    'kode_transaksi' => $kodeTransaksi,
                    'total' => 0,
                    'status' => 'pending',
                    'payment_type' => $paymentMethod,
                    'keterangan' => $this->keteranganHandler($request->input('keterangan'), $paymentMethod),
                ]);

                foreach ($itemsToProcess as $item) {
                    $hargaSatuan = $item['barang']->harga;
                    $totalHarga += ($hargaSatuan * $item['qty']);

                    $item['barang']->decrement('stok', $item['qty']);

                    ItemTransaction::create([
                        'id_pembayaran' => $pembayaran->id_pembayaran,
                        'id_barang' => $item['id_barang'],
                        'qty' => $item['qty'],
                        'harga_satuan' => $hargaSatuan
                    ]);
                }

                $pembayaran->update(['total' => $totalHarga]);

                if ($checkoutType === 'cart') {
                    Cart::where('user_id', $userId)->delete();
                }

                if ($paymentMethod === 'cash') {
                    $response = $this->handleCashPayment($kodeTransaksi, $totalHarga);
                } else {
                    $channelCode = $request->input('channel_code');
                    $response = $this->handleCashlessPayment($kodeTransaksi, $totalHarga, $channelCode);
                }

                DB::commit();
                return $this->successResponse($response['data'], $response['message']);

            } catch (\Exception $e) {
                DB::rollBack();
                return $this->errorResponse(null, ['error' => $e->getMessage(), 'line' => $e->getLine()], 'Internal server error saat transaksi');
            }
        } catch (ValidationException $e) {
            return $this->errorResponse(null, $e->validator->errors(), 'Terdapat data yang kurang lengkap');
        } catch (\Throwable $e) {
            return $this->errorResponse(null, $e->getMessage(), 'Terjadi kesalahan sistem');
        }
    }

    public function callback(Request $request)
    {
        try {
            $xenditToken = config('xendit.webhook');

            if ($request->header('x-callback-token') !== $xenditToken) {
                return response()->json(['message' => 'Invalid Callback Token'], 403);
            }

            $referenceId = $request->input('data.reference_id') ?? $request->input('external_id');
            $status = $request->input('data.status') ?? $request->input('status');
            $event = $request->input('event', 'unknown_event');

            if (!$referenceId || !$status) {
                return response()->json(['message' => 'Invalid Payload Format'], 400);
            }

            $pembayaran = Pembayaran::where('kode_transaksi', $referenceId)->first();

            if (!$pembayaran) {
                return response()->json(['message' => 'Transaction Not Found'], 404);
            }

            if ($pembayaran->status === 'success') {
                return response()->json(['message' => 'Already processed']);
            }

            $newStatus = 'pending';

            if ($status === 'SUCCEEDED' || $status === 'COMPLETED') {
                $newStatus = 'success';
            } elseif ($status === 'FAILED' || $status === 'VOIDED' || $status === 'EXPIRED') {
                $newStatus = 'failed';
            }

            $pembayaran->update(['status' => $newStatus]);

            return response()->json([
                'message' => 'Callback processed successfully',
                'event_processed' => $event
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    private function handleCashPayment($kodeTransaksi, $totalHarga)
    {
        return [
            'data' => [
                'kode_transaksi' => $kodeTransaksi,
                'total' => $totalHarga,
                'payment_method' => 'cash'
            ],
            'message' => 'Pesanan berhasil dibuat. Tunjukkan kode transaksi ini ke kasir.'
        ];
    }

    private function handleCashlessPayment($kodeTransaksi, $totalHarga, $channelCode)
    {
        $user = auth()->user();
        $secretKey = config('xendit.secret_key');

        if ($channelCode === 'QRIS') {
            $response = Http::timeout(10)->withBasicAuth($secretKey, '')
                ->post('https://api.xendit.co/qr_codes', [
                    'external_id' => $kodeTransaksi,
                    'type' => 'DYNAMIC',
                    'amount' => (int) $totalHarga,
                    'currency' => 'IDR',
                    'callback_url' => config('xendit.webhook_url_qris') ?? 'https://api.toko-smk.com/api/callback'
                ]);

            if ($response->failed()) {
                throw new \Exception('Gagal membuat QRIS Xendit: ' . $response->body());
            }

            return [
                'data' => [
                    'kode_transaksi' => $kodeTransaksi,
                    'total' => $totalHarga,
                    'payment_method' => 'cashless',
                    'channel' => 'QRIS',
                    'qr_data' => $response->json('qr_string'),
                    'payment_url' => null
                ],
                'message' => 'QRIS berhasil dibuat, silakan scan untuk membayar.'
            ];
        }

        $response = Http::timeout(10)->withBasicAuth($secretKey, '')
            ->post('https://api.xendit.co/ewallets/charges', [
                'reference_id' => $kodeTransaksi,
                'amount' => (int) $totalHarga,
                'currency' => 'IDR',
                'checkout_method' => 'ONE_TIME_PAYMENT',
                'channel_code' => $channelCode,
                'channel_properties' => [
                    'success_redirect_url' => 'https://tokohijau.app/finish',
                    'mobile_number' => $channelCode === 'ID_OVO' ? ($user->no_telp ?? '080000000000') : '+6285706341874',
                ]
            ]);

        if ($response->failed()) {
            throw new \Exception('Gagal membuat tagihan E-Wallet Xendit: ' . $response->body());
        }

        $actions = $response->json('actions');

        $redirectUrl = $actions['mobile_deeplink_checkout_url']
            ?? $actions['mobile_web_checkout_url']
            ?? $actions['desktop_web_checkout_url']
            ?? null;

        return [
            'data' => [
                'kode_transaksi' => $kodeTransaksi,
                'total' => $totalHarga,
                'payment_method' => 'cashless',
                'channel' => $channelCode,
                'qr_data' => null,
                'payment_url' => $redirectUrl
            ],
            'message' => 'Tagihan E-Wallet berhasil dibuat.'
        ];
    }

    private function keteranganHandler(string|null $keterangan, string $paymentMethod)
    {
        return $keterangan ?? 'Pesanan via ' . strtoupper($paymentMethod);
    }
}
