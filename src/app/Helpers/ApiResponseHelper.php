<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponse;

class ApiResponseHelper
{
    use ApiResponse;

    public static function success($data = null, $message = null): JsonResponse
    {
        return (new self)->successResponse($data, $message);
    }

    public static function error($message = null, $errors = null, $statusCode = 400): JsonResponse
    {
        return (new self)->errorResponse($message, $errors, $statusCode);
    }
}
