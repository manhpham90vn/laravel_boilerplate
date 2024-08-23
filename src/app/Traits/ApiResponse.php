<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    protected function successResponse($data = null, $message = null): JsonResponse
    {
        return $this->apiResponse($data, $message);
    }

    protected function apiResponse($data = null, $message = null, $errors = null, $statusCode = 200): JsonResponse
    {
        $response = ['data' => $data, 'message' => $message];

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
