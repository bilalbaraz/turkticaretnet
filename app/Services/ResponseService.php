<?php

namespace App\Services;

class ResponseService
{
    public function response(bool $success = true, string $message = null, $statusCode = 200, array $data = [])
    {
        $baseResponse = ['success' => $success, 'message' => $message];
        $response = array_merge($baseResponse, $data);

        return response()->json($response, $statusCode);
    }
}