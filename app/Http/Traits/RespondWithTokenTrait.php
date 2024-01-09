<?php

namespace App\Http\Traits;

trait RespondWithTokenTrait
{
    protected function respondWithToken($message, $token)
    {
        return response()->json([
            'message' => $message,
            'access_token' => $token,
        ]);
    }
}
