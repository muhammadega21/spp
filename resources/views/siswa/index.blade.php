@extends('layouts.main')
@section('container')
<div class="container-fluid">
    <div class="row justify-content-center" style="margin-top: 80px; margin-left: 5px">
        <div class="col-9 col-sm-10 col-lg-11">
            <div class="siswa">
            <div class="title">
                <h5 class="d-block my-auto">Data Siswa</h5>   
                <span class="text-secondary"><a href="/dashboard">Home</a> > Data Siswa > <a href="/petugas">Data Petugas</a></span>
            </div>
                <div class="table-siswa">
                  <div class="siswa-action mb-3 d-flex justify-content-between align-items-center">
                    <div class="button">
                      <a href="{{ url('/siswa/create') }}" class="btn btn-primary"><i class="fa-solid fa-user-plus"></i><span class="ms-1">Tambah Siswa</span></a>
                      <a href="" class="btn btn-danger"><i class="fa-solid fa-file-pdf"></i><span class="ms-2">Print PDF</span></a>
                    </div>
                    <div class="search-box">
                      <form action="">
                        <input type="text" name="search" id="search" placeholder="Search...">
                        <button><i class="fa-solid fa-magnifying-glass"></i></button>
                      </form>
                    </div>
                  </div>
                  @if (session('success'))
                    <div id="flash-message" class="alert alert-success">
                      {{ session('success') }}
                      <i id="close" class="fa-solid fa-xmark text-danger" data-bs-dismiss="alert" style="position: absolute; right: 15px; top: 15px; cursor: pointer; font-size: 20px"></i>
                    </div>
                  @endif
                    <table class="table table-bordered">
                        <thead class="table-secondary">
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">NISN</th>
                            <th scope="col">NIS</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($siswa as $siswa)    
                          <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $siswa->nisn }}</td>
                            <td>{{ $siswa->nis }}</td>
                            <td>{{ $siswa->name }}</td>
                            <td>{{ $siswa->user->email }}</td>
                            <td>
                                <a href="" class="badge bg-primary btn-sm"><i class="fa-solid fa-eye text-light"></i></a>
                                <a href="{{ url('/siswa/'. $siswa->id.'/edit') }}" class="badge bg-warning btn-sm"><i class="fa-solid fa-pen-to-square text-light"></i></a>
                                <form action="{{ url('/siswa/'. $siswa->id) }}" method="POST" class="d-inline">
                                  @method('delete')
                                  @csrf
                                    <button class="badge bg-danger border-0" onclick="return confirm('Hapus Data?')"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection