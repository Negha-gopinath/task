<?php
namespace App\Http\Traits;

trait RespondsTrait {
    protected function successResponse($message, $data = [], $status = 200)
    {
        return response([
            'success' => true,
            'data' => $data,
            'message' => $message,
        ], $status);
    }

}