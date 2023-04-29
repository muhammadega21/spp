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
                      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create_siswa"><i class="fa-solid fa-user-plus"></i><span class="ms-1">Tambah Siswa</span></button>
                      <a href="" class="btn btn-danger"><i class="fa-solid fa-file-pdf"></i><span class="ms-2">Print PDF</span></a>
                    </div>
                    
                    <!-- Create Siswa -->
                    <div class="modal fade" id="create_siswa" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5">Tambah Siswa</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <form action="">
                            <div class="modal-body">
                              <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                              </div>
                              <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password">
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                              <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    {{-- end Create Siswa --}}

                    <div class="search-box">
                      <form action="">
                        <input type="text" name="search" id="search" placeholder="Search...">
                        <button><i class="fa-solid fa-magnifying-glass"></i></button>
                      </form>
                    </div>
                  </div>
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
                                <a href="" class="badge bg-warning btn-sm"><i class="fa-solid fa-pen-to-square text-light"></i></a>
                                <form action="" class="d-inline">
                                    <button class="badge bg-danger border-0"><i class="fa-solid fa-trash"></i></button>
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