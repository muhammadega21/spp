<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('pages.profile.index', [
            'title' => 'Profil',
            'student' => Auth::user()->students->first()
        ]);
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'nullable|confirmed|min:6'
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'password.confirmed' => 'Password tidak cocok',
            'password.min' => 'Password minimal 6 karakter'
        ]);

        $user = auth()->user();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->password) {
            $user->update([
                'password' => bcrypt($request->password)
            ]);
        }

        return back()->with('success', 'Profil berhasil diperbarui');
    }
}
