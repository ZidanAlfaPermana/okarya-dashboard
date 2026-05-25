<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Services\KategoriService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class KategoriController extends Controller
{
    public function index(Request $request, KategoriService $service)
    {
        try {
            $data = $service->getKategori($request->all(), $this->getDefaultDataLimitPerPage());
        } catch (ValidationException $e) {
            return $this->errorResponse(null, $e->validator->errors(), 'error validation');
        } catch (\Exception $e) {
            return $this->errorResponse(null, 'error', 'Terjadi Kesalahan');
        }
    }
}
