<?php

namespace App\Modules\Core\Traits;

use App\Modules\Core\Exceptions\ValidationException;
use Symfony\Component\HttpFoundation\Response;

trait HttpResponseTrait
{
    public function okResponse($data, $message = null): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
        ], Response::HTTP_OK);
    }

    public function notFoundResponse($message = null): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => $message ?? 'Resource not found',
        ], Response::HTTP_NOT_FOUND);
    }

    public function createdResponse($data, $message = 'Created'): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
        ], Response::HTTP_CREATED);
    }

    public function errorResponse($message, $code = Response::HTTP_INTERNAL_SERVER_ERROR): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => $message,
        ], $code);
    }

    public function badRequestResponse($message, $code = Response::HTTP_BAD_REQUEST): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => $message,
        ], $code);
    }

    public function unauthorizedResponse($message = null): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => $message ?? 'Unauthorized',
        ], Response::HTTP_UNAUTHORIZED);
    }
}
