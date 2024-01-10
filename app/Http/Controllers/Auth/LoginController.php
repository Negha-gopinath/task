<?php

namespace App\Http\Controllers\Auth;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Http\Traits\RespondsTrait;
use App\Http\Traits\RespondWithTokenTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use RespondsTrait;
    use RespondWithTokenTrait;

    public function login(AdminRequest $request)
    {

        $credentials = $request->only('email', 'password');
        $checkUser = Admin::where('email', $request->email)->first();


        if ($token = Auth::guard('api')->attempt($credentials)) {
            $response = [
                'id'        =>    $checkUser->id,
                'name'      =>    $checkUser->name,
                'email'     =>    $checkUser->email,
                'mobile'    =>    $checkUser->mobile,
                'token'     =>    $token,

            ];

            $checkUser->update(['api_token' => hash('sha256', $token)]);
            return $this->respondWithToken("Login Success", $response);
        }

        return $this->errorResponse("Login Failed, Check Credentials again", 422);
    }
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
