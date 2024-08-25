<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    protected function successResponse($data = null, $message = null, $statusCode = 200): JsonResponse
    {
        return $this->apiResponse($data, $message, null, $statusCode);
    }

    protected function apiResponse($data = null, $message = null, $errors = null, $statusCode): JsonResponse
    {
        $response = [];

        if ($data !== null) {
            $response['data'] = $data;
        }

        if ($message !== null) {
            $response['message'] = $message;
        }

        if ($errors !== null) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $statusCode);
    }

    protected function errorResponse($message = null, $errors = null, $statusCode = 400): JsonResponse
    {
        return $this->apiResponse(null, $message, $errors, $statusCode);
    }
}
