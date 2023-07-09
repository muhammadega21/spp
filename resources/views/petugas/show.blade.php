@extends('layouts.main')

@section('container')
<div class="container-fluid">
    <div class="row justify-content-center" style="margin-top: 80px; margin-left: 5px">
        <div class="col-9 col-sm-10 col-lg-11">
            <div class="siswa">
            <div class="title">
                <h5 class="d-block my-auto">Informasi Petugas</h5>   
                <span class="text-secondary"><a href="/dashboard">Home</a> > <a href="/petugas">Data Petugas</a> > Informasi Siswa </span>
            </div>
                <div class="table-siswa">
                  @if (session('success'))
                    <div id="flash-message" class="alert alert-success">
                      {{ session('success') }}
                      <i id="close" class="fa-solid fa-xmark text-danger" data-bs-dismiss="alert" style="position: absolute; right: 15px; top: 15px; cursor: pointer; font-size: 20px"></i>
                    </div>
                  @endif
                  <div class="data-user d-flex mx-3 my-3">
                      <div class="left">
                        @if ($petugas->image == 'user.png')
                        <img src="{{ url('img/' .$petugas->image) }}" class="img-fluid d-block">
                      @else
                        <img src="{{ url(asset('storage/' .$petugas->image)) }}" class="img-fluid d-block">
                      @endif
                      </div>
                    <div class="right my-auto ms-5">
                      <table>
                            <tr>
                              <td class="pe-4">Nama Petugas</td>
                              <td class="pe-4">:</td> 
                              <td>{{ $petugas->name }}</td>
                            </tr>
                            <tr>
                              <td class="pe-4">Nomor Telepon</td>
                              <td class="pe-4">:</td> 
                              <td>{{ $petugas->no_telp }}</td>
                            </tr>
                            <tr>
                              <td class="pe-4">Alamat</td>
                              <td class="pe-4">:</td> 
                              <td>{{ $petugas->alamat }}</td>
                            </tr>
                        </table>
                        <div class="siswa-action mt-3 d-flex justify-content-between align-items-center">
                          <div class="button">
                            <form action="{{ url('/petugas') }}" class="d-inline">
                              <button class="btn btn-primary border-0">Kembali</button>
                            </form>
                            <form action="{{ url('/petugas/'. $petugas->id.'/edit') }}" class="d-inline">
                              <button class="btn btn-warning border-0"><i class="fa-solid fa-pen-to-square text-light"></i></button>
                            </form>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection