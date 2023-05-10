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
                    <form action="{{ url('/siswa/posts/'.$siswa->id) }}" method="POST" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <input type="text" name="id" value="{{ $siswa->id }}" hidden>
                        <div class="form-input d-flex flex-wrap p-1">
                            <div class="mb-3 col-6 pe-2">
                                <label for="nisn" class="form-label">NISN</label>
                                <input type="nisn" name="nisn" class="form-control @error('nisn') is-invalid @enderror" id="nisn" value="{{ old('nisn',$siswa->nisn) }}" placeholder="Masukkan NISN">
                                @error('nisn')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-6 ps-2">
                                <label for="nis" class="form-label">NIS</label>
                                <input type="nis" name="nis" class="form-control @error('nis') is-invalid @enderror" id="nis" value="{{ old('nis',$siswa->nis) }}" placeholder="Masukkan NIS">
                                @error('nis')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-input d-flex flex-wrap p-1">
                            <div class="mb-3 col-6 pe-2">
                                <label class="form-label">Kelas</label>
                                <select class="form-select" name="kelas_id">
                                    <option selected>-- Pilih Kelas --</option>
                                    @foreach ($kelas as $kelas)
                                        @if (old('kelas_id', $siswa->kelas_id) == $kelas->id)
                                            <option value="{{ $kelas->id }}" selected>{{ $kelas->nama_kelas }}</option>
                                        @else
                                            <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                                        @endif     
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-6 ps-2">
                                <label class="form-label">Jurusan</label>
                                <select class="form-select" name="jurusan_id">
                                    <option selected>-- Pilih Jurusan --</option>
                                    @foreach ($jurusan as $jurusan)
                                    @if (old('jurusan_id', $siswa->jurusan_id) == $jurusan->id)
                                            <option value="{{ $jurusan->id }}" selected>{{ $jurusan->nama_jurusan }}</option>
                                        @else
                                            <option value="{{ $jurusan->id }}">{{ $jurusan->nama_jurusan }}</option>
                                        @endif     
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-input d-flex flex-wra p-1">
                            <div class="mb-3 col-6 pe-2">
                                <label for="name" class="form-label">Name</label>
                                <input type="name" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name',$siswa->name) }}" placeholder="Masukkan Nama">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-6 ps-2">
                                <label for="username" class="form-label">Username</label>
                                <input type="username" name="username" class="form-control @error('username') is-invalid @enderror" id="username" value="{{ old('username',$siswa->username) }}" placeholder="Masukkan Username">
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
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email',$siswa->user->email) }}" placeholder="Masukkan Email">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-6 ps-2">
                                <label for="password" class="form-label">Password</label>
                                <div class="input d-flex">
                                    <input type="text" name="password" class="form-control" id="password" value="Ganti Password" style="color: rgb(0, 0, 0,.3);" disabled>
                                    <a href="" class="btn btn-warning ms-2 text-light"><i class="fa-solid fa-pen-to-square"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="form-input d-flex flex-wra p-1">
                            <div class="mb-3 col-6 pe-2">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" value="{{ old('alamat',$siswa->alamat) }}" placeholder="Masukkan Alamat">
                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 col-6 ps-2">
                                <label for="no_telp" class="form-label">Nomor Telepon</label>
                                <input type="no_telp" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" value="{{ old('no_telp',$siswa->no_telp) }}" placeholder="Masukkan Nomor Telpon">
                                @error('no_telp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-input d-flex flex-wra p-1">
                            <div class="mb-3 col-6 pe-2">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Foto Profile</label>
                                    <input type="hidden" name="oldImage" value="{{ $siswa->image }}">
                                    @if ($siswa->image)
                                        @if ($siswa->image == 'user.png')
                                            <img src="{{ url('img/' .$siswa->image) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                                        @else
                                            <img src="{{ url(asset('storage/' .$siswa->image)) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                                        @endif
                                    @else
                                        <img class="img-preview img-fluid mb-3 col-sm-5">
                                    @endif
                                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
                                    @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="button ps-1 pb-1 d-flex justify-content-end me-1">
                            <a href="/siswa" class="btn btn-danger">Batal</a>
                            <button type="submit" class="btn btn-primary ms-1">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection