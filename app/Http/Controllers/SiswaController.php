<?php

namespace App\Http\Controllers;

use App\Models\jurusan;
use App\Models\kelas;
use App\Models\siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'siswa' => Siswa::pluck('id')->last(),
            'kelas' => kelas::all(),
            'jurusan' => jurusan::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|numeric|unique:siswas,nisn|digits:10',
            'nis' => 'required|numeric|unique:siswas,nis',
            'email' => 'required|email:dns|unique:users,email',
            'name' => 'required|max:30',
            'username' => 'required|max:8',
            'password' => 'required|min:4',
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
            'username' => $request['username'],
            'kelas_id' => $request['kelas_id'],
            'jurusan_id' => $request['jurusan_id'],
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
        return view('siswa.edit', [
            'title' => 'Edit Siswa',
            'siswa' => $siswa,
            'kelas' => kelas::all(),
            'jurusan' => jurusan::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $siswa)
    {
        $siswas = siswa::find($siswa);
        $validasi = [
            'name' => 'required|max:30',
            'username' => 'required|max:8',
            'password' => 'min:4',
            'image' => 'image|file|max:5120'
        ];

        if ($request->nisn != $siswas->nisn) {
            $validasi['nisn'] = 'required|numeric|unique:siswas,nisn|digits:10';
        }
        if ($request->nis != $siswas->nis) {
            $validasi['nis'] = 'required|numeric|unique:siswas,nis|digits:8';
        }
        if ($request->email != $siswas->user->email) {
            $validasi['email'] = 'required|email|unique:users,email';
        }

        if ($siswas == 'user.png') {

            if ($request->file('image')) {
                if ($request->oldImage) {
                    Storage::delete($request->oldImage);
                }
                $image = $validatedData['image'] = $request->file('image')->store('images');
            } else {
                $image = 'user.png';
            }
        } else {
            if ($request->file('image')) {
                if ($request->oldImage) {
                    Storage::delete($request->oldImage);
                }
                $image = $validatedData['image'] = $request->file('image')->store('images');
            } else {
                $image = $siswas->image;
            }
        }

        $validatedData = $request->validate(
            $validasi,
            [
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

                'image.image' => 'File Harus Berupa Gambar!',
                'image.max' => 'Size Gambar Tidak Boleh Lebih Dari 5mb!'
            ]
        );



        siswa::where('id', $siswas->id)
            ->update([
                'id' => $request['id'],
                'nisn' => $request['nisn'],
                'nis' => $request['nis'],
                'name' => $request['name'],
                'username' => $request['username'],
                'kelas_id' => $request['kelas_id'],
                'jurusan_id' => $request['jurusan_id'],
                'image' => $image
            ]);
        User::where('siswa_id', $siswas->id)
            ->update([
                'siswa_id' => $request['id'],
                'email' => $request['email'],
            ]);

        return redirect('/siswa')->with('success', 'Berhasil Update Data Profile');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(siswa $siswa)
    {
        if ($siswa->image) {
            Storage::delete($siswa->image);
        }
        siswa::destroy($siswa->id);
        User::destroy($siswa->user->id);
        return redirect('/siswa')->with('success', 'Berhasil Menghapus Data');
    }
}
