<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view("login");
    }

    public function showRegister()
    {
        return view("register");
    }

    public function login(LoginUserRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function register(RegisterUserRequest $request)
    {
        $user = User::create($request->all());
        Auth::login($user);

        return redirect()->route('home')->with('success', 'You Are Successfully Registered ');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
