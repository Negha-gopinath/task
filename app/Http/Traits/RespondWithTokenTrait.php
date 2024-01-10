<?php

namespace App\Http\Traits;

trait RespondWithTokenTrait
{
    protected function respondWithToken($message, $response)
    {
        return response()->json([
            'message'   => $message,
            'data'      => $response,
        ]);
    }
}
