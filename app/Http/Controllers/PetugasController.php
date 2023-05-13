<?php

namespace App\Http\Controllers;

use App\Models\petugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('petugas.index', [
            'title' => 'Daftar Petugas',
            'petugas' => petugas::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('petugas.create', [
            'title' => 'Tambah Petugas',
            'petugas' => petugas::pluck('id')->last()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:30',
            'username' => 'required|max:8',
            'email' => 'required|email:dns|unique:users,email',
            'password' => 'required|min:4',
        ], [
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
            'petugas_id' => $request['id'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'level' => $request['level'],
        ]);

        petugas::create([
            'id' => $request['id'],
            'name' => $request['name'],
            'username' => $request['username'],
        ]);

        return redirect('/petugas')->with('success', 'Berhasil Menambah Petugas');
    }

    /**
     * Display the specified resource.
     */
    public function show(petugas $petugas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($petugas)
    {
        $data_petugas = petugas::find($petugas);
        return view('petugas.edit', [
            'title' => 'Edit Petugas',
            'petugas' => $data_petugas
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $petugas)
    {

        $data_petugas = petugas::find($petugas);
        $validasi = [
            'name' => 'required|max:30',
            'username' => 'required|max:8',
            'password' => 'min:4',
            'image' => 'image|file|max:5120'
        ];

        if ($request->email != $data_petugas->user->email) {
            $validasi['email'] = 'required|email|unique:users,email';
        }

        if ($data_petugas == 'user.png') {

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
                $image = $data_petugas->image;
            }
        }

        $validatedData = $request->validate(
            $validasi,
            [
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



        petugas::where('id', $data_petugas->id)
            ->update([
                'id' => $request['id'],
                'name' => $request['name'],
                'username' => $request['username'],
                'image' => $image
            ]);
        User::where('petugas_id', $data_petugas->id)
            ->update([
                'petugas_id' => $request['id'],
                'email' => $request['email'],
                'level' => $request['level'],
            ]);

        return redirect('/petugas')->with('success', 'Berhasil Update Data Profile');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($petugas)
    {
        $data_petugas = petugas::find($petugas);
        if ($data_petugas->image) {
            Storage::delete($data_petugas->image);
        }
        petugas::destroy($data_petugas->id);
        User::destroy($data_petugas->user->id);
        return redirect('/petugas')->with('success', 'Berhasil Menghapus Data');
    }
}
