<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login', [
            'title' => 'Login'
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email tidak valid.',
            'password.required' => 'Password harus diisi.',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard.index');
        }

        return back()->with('error', 'Email atau password salah.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('login');
    }
}
