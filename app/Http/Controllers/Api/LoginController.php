<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    // public function register(RegisterRequest $request)
    // {
    //     $data = $request->validated();
    //     $data['password'] = Hash::make($request->password);
    //     $user = User::create($data);
    //     $token = $user->createToken('app')->plainTextToken;
    //     return $this->successResponse([
    //         'name' => $user->name,
    //         'email' => $user->email,
    //         'api_token' => $token,
    //     ]);
    // }


    public function login(LoginRequest $request)
    {
        if (!$user = User::where('email', $request->email)->first()):
            return $this->errorResponse(message: 'Email not match');
        endif;

        if (Hash::check($request->password, $user->password)):
            $token = $user->createToken('app')->plainTextToken;
            return $this->successResponse([
                'name' => $user->name,
                'email' => $user->email,
                'api_token' => $token,
            ]);
        else:
            return $this->errorResponse(message: 'Password not correct');
        endif;
    }

}
