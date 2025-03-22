<?php

namespace App\Traits;

trait ResponseTrait
{
    public function successResponse(string $message, int $code, $data = null)
    {
        $response = [
            'success' => true,
            'message' => $message,
        ];

        if (isset($data)) {
            $response = array_merge($response, $data);
        }

        return response()->json($response, $code);
    }

    public function failedResponse($errors, int $code = 500)
    {
        $response = [
            'success' => false,
            'errors' => $errors,
        ];

        return response()->json($response, $code);
    }
}
