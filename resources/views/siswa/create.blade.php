@extends('layouts.main')

@section('container')
<div class="container-fluid">
    <div class="row justify-content-center" style="margin-top: 80px; margin-left: 5px">
        <div class="col-9 col-sm-10 col-lg-11">
            <div class="siswa">
            <div class="title">
                <h5 class="d-block my-auto">Tambah Siswa</h5>   
                <span class="text-secondary"><a href="/dashboard">Home</a> > <a href="/siswa">Data Siswa</a> > Tambah Siswa</span>
            </div>
                <div class="create-siswa">
                    <form action="/siswa/posts" method="POST">
                        @csrf
                        <input type="text" name="id" value="{{ $siswa + 1 }}" hidden>
                        <div class="form-input d-flex flex-wrap p-1">
                            <div class="mb-3 col-6 pe-2">
                                <label for="nisn" class="form-label">NISN</label>
                                <input type="nisn" name="nisn" class="form-control @error('nisn') is-invalid @enderror" id="nisn" value="{{ old('nisn') }}" placeholder="Masukkan NISN">
                                @error('nisn')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-6 ps-2">
                                <label for="nis" class="form-label">NIS</label>
                                <input type="nis" name="nis" class="form-control @error('nis') is-invalid @enderror" id="nis" value="{{ old('nis') }}" placeholder="Masukkan NIS">
                                @error('nis')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-input d-flex flex-wra p-1">
                            <div class="mb-3 col-6 pe-2">
                                <label for="name" class="form-label">Name</label>
                                <input type="name" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" placeholder="Masukkan Nama">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-6 ps-2">
                                <label for="username" class="form-label">Username</label>
                                <input type="username" name="username" class="form-control @error('username') is-invalid @enderror" id="username" value="{{ old('username') }}" placeholder="Masukkan Username">
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-input d-flex flex-wra p-1">
                            <div class="mb-3 col-6 pe-2">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" placeholder="Masukkan Email">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-6 ps-2">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" value="{{ old('password','password') }}" placeholder="Masukkan Password">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="button ps-1 pb-1 d-flex justify-content-end me-1">
                            <a href="/siswa" class="btn btn-danger">Batal</a>
                            <button type="submit" class="btn btn-primary ms-1">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection