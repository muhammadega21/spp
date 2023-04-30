<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'title' => 'Login'
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ], [
            'email.email' => 'Email Harus Berupa Email Yang Benar!'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->with('loginError', 'Email atau Password Anda Salah');
    }

    public function register()
    {
        return view('login.register', [
            'title' => 'Register',
            'siswa' => Siswa::pluck('id')->last()
        ]);
    }

    public function store_register(Request $request)
    {
        $request->validate([
            'nisn' => 'required|numeric|unique:siswas,nisn|digits:10',
            'nis' => 'required|numeric|unique:siswas,nis|digits:8',
            'name' => 'required|max:30',
            'username' => 'required|max:8',
            'email' => 'required|email:dns|unique:users,email',
            'password' => 'required|min:4'
        ], [
            'nisn.digits' => 'NISN Maximal 10 Angka',
            'nisn.required' => 'NISN Tidak Boleh Kosong!',
            'nisn.numeric' => 'NISN Harus Berupa Angka!',
            'nisn.unique' => 'NISN Sudah Ada!',

            'nis.digits' => 'NISN Maximal 8 Angka',
            'nis.required' => 'NIS Tidak Boleh Kosong!',
            'nis.numeric' => 'NIS Harus Berupa Angka!',
            'nis.unique' => 'NIS Sudah Ada!',

            'name.required' => 'Nama Tidak Boleh Kosong!',
            'name.max' => 'Max 30 Character!',

            'username.required' => 'Username Tidak Boleh Kosong!',
            'username.max' => 'Max 8 Character!',

            'email.required' => 'Email Tidak Boleh Kosong!',
            'email.email' => 'Email Harus Berupa Email Yang Benar!',
            'email.unique' => 'Email Sudah Ada!',

            'password.required' => 'Password Tidak Boleh Kosong!',
            'password.min' => 'Password Harus Minimal 4 Huruf/Angka!',
        ]);

        User::create([
            'siswa_id' => $request['id'],
            'email' => $request['email'],
            'password' => bcrypt($request['password'])
        ]);

        Siswa::create([
            'id' => $request['id'],
            'nisn' => $request['nisn'],
            'nis' => $request['nis'],
            'name' => $request['name'],
            'username' => $request['username']
        ]);

        return redirect('/login')->with('success', 'Berhasil Registrasi! Silahkan Login');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }
}
