<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use App\Models\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('siswa.index', [
            'title' => 'Daftar Siswa',
            'siswa' => Siswa::orderBy('name', 'asc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('siswa.create', [
            'title' => 'Tambah Siswa',
            'siswa' => Siswa::pluck('id')->last()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|numeric|unique:siswas,nisn|digits:10',
            'nis' => 'required|numeric|unique:siswas,nis|digits:8',
            'email' => 'required|email:dns|unique:users,email',
            'name' => 'required|max:30',
            'username' => 'required|max:8',
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

        return redirect('/siswa')->with('success', 'Berhasil Menambah Siswa');
    }

    /**
     * Display the specified resource.
     */
    public function show(siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(siswa $siswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, siswa $siswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(siswa $siswa)
    {
        //
    }
}
