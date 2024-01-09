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
        $credentials = request(['email', 'password']);
        $checkUser = Admin::where('email', $request->email)->first();
        if (!$checkUser) {
            return $this->errorResponse("Sorry,We don't recognize this account");
        }
      
        if ( ! (Hash::check($request->password,  $checkUser->password)))
        {
            return response()->json(['error' => 'Password Incorrect']);         
        }
        if ($token = Auth::attempt(array('email' => $request->email, 'password' => $request->password))) {
            return $this->respondWithToken("Login Success", $token);
          
          
        }


    }
    public function logout()
    {
        auth()->logout();

        return response()->successResponse(['message' => 'Successfully logged out']);
    }
}
