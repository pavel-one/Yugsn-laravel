<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('templates.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6'
        ]);

        $credentials = $request->only('email', 'password');

        if (\Auth::attempt($credentials, true)) {
            return redirect()->route('index');
        }

        return back();
    }

    public function logout()
    {
        \Auth::logout();

        return back();
    }
}
