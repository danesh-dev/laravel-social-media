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
        // dd($request->all());
        // $data = $request->validated([
        //     "name" => "required|max:255",
        //     "email"=> "required|email|unique:users",
        //     "username" => "required|unique:users|max:255",
        //     "bio" => "max:500",
        //     "password"=> "required"
        // ]);

        // $user = User::create([
        //     "name" => $data['name'],
        //     "username" => $data['username'],
        //     "email" => $data['email'],
        //     "bio" => $data['bio'],
        //     "password" => Hash::make($data['password']), // Hash the password
        // ]);

        // dd($request);
        $user = User::create($request->all());
        Auth::login($user);

        return redirect()->route('home')->with('success', 'Registration successful');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
