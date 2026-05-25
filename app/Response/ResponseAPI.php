<?php

namespace App\Response;

use Illuminate\Http\JsonResponse;

trait ResponseAPI
{
    const int DEFAULT_DATA_LIMIT_PER_PAGE = 10;
    public function successResponse(mixed $data, string $message, int $code = 200): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'code' => $code < 200 || $code > 299 ? 200 : $code,
            'success' => true
        ], $code);
    }

    public function errorResponse(mixed $data, mixed $error, string $message, int $code = 400): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'error' => $error,
            'message' => $message,
            'code' => $code < 300 || $code > 599 ? 400 : $code,
            'success' => false
        ], $code);
    }

    public function getDefaultDataLimitPerPage(): int
    {
        return self::DEFAULT_DATA_LIMIT_PER_PAGE;
    }
}
