<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;

class AuthController extends Controller
{


    public function register(RegisterUserRequest $request)
    {
        $data = [
            "name" => $request->name,
            "username" => $request->username,
            "email" => $request->email,
            "password" => $request->password,
        ];

        $user = User::create($data);

        $token = $user->createToken($request['email']);

        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }

    public function login(LoginUserRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return [
                'message' => 'The provided credentials are incorrect'
            ];
        }

        $token = $user->createToken($user->email);

        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return [
            'message' => 'You are logged out.'
        ];
    }
}
