<?php

namespace App\Http\Controllers;

use App\Services\BarangService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BarangController extends Controller
{
    public function index(Request $request, BarangService $service)
    {
        try {
            $data = $service->getDaftarBarang($request->all(), $this->getDefaultDataLimitPerPage());

            return $this->successResponse($data['data'], $data['message']);
        } catch (ValidationException $e) {
            return $this->errorResponse(null, $e->validator->errors(), 'error validation');
        } catch (\Exception $e) {
            return $this->errorResponse(null, $e->getMessage(), 'Data barang gagal diambil');
        }
    }

    public function show($id, BarangService $service)
    {
        try {
            $data = $service->getItem($id);
            return $this->successResponse($data['data'], $data['message']);
        } catch (\Exception) {
            return $this->errorResponse(null, 'error', 'Terjadi Kesalahan', 500);
        }
    }
}
