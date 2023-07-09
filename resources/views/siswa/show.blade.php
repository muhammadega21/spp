@extends('layouts.main')

@section('container')
<div class="container-fluid">
    <div class="row justify-content-center" style="margin-top: 80px; margin-left: 5px">
        <div class="col-9 col-sm-10 col-lg-11">
            <div class="siswa">
            <div class="title">
                <h5 class="d-block my-auto">Informasi Siswa</h5>   
                <span class="text-secondary"><a href="/dashboard">Home</a> > <a href="/siswa">Data Siswa</a> > Informasi Siswa </span>
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
                        @if ($siswa->image == 'user.png')
                        <img src="{{ url('img/' .$siswa->image) }}" class="img-fluid d-block">
                      @else
                        <img src="{{ url(asset('storage/' .$siswa->image)) }}" class="img-fluid d-block">
                      @endif
                      </div>
                    <div class="right my-auto ms-5">
                      <table>
                            <tr>
                              <td class="pe-4">NISN</td>
                              <td class="pe-4">:</td>
                              <td>{{ $siswa->nisn }}</td>              
                            </tr>
                            <tr>
                              <td class="pe-4">NIS</td>
                              <td class="pe-4">:</td> 
                              <td>{{ $siswa->nis }}</td>
                            </tr>
                            <tr>
                              <td class="pe-4">Nama Siswa</td>
                              <td class="pe-4">:</td> 
                              <td>{{ $siswa->name }}</td>
                            </tr>
                            <tr>
                              <td class="pe-4">Email</td>
                              <td class="pe-4">:</td> 
                              <td>{{ $siswa->user->email }}</td>
                            </tr>
                            <tr>
                              <td class="pe-4">Kelas</td>
                              <td class="pe-4">:</td> 
                              <td>{{ @$siswa->kelas->nama_kelas }}</td>
                            </tr>
                            <tr>
                              <td class="pe-4">Jurusan</td>
                              <td class="pe-4">:</td> 
                              <td>{{ @$siswa->jurusan->nama_jurusan }}</td>
                            </tr>
                            <tr>
                              <td class="pe-4">Alamat</td>
                              <td class="pe-4">:</td> 
                              <td>{{ $siswa->alamat }}</td>
                            </tr>
                            <tr>
                              <td class="pe-4">Nomor Telepon</td>
                              <td class="pe-4">:</td> 
                              <td>{{ $siswa->no_telp }}</td>
                            </tr>
                        </table>
                        <div class="siswa-action mt-3 d-flex justify-content-between align-items-center">
                          <div class="button">
                            <form action="{{ url('/siswa') }}" class="d-inline">
                              <button class="btn btn-primary border-0">Kembali</button>
                            </form>
                            <form action="{{ url('/siswa/'. $siswa->id.'/edit') }}" class="d-inline">
                              <button class="btn btn-warning border-0"><i class="fa-solid fa-pen-to-square text-light"></i></button>
                            </form>
                          </div>
                        </div>
                    </div>
                  </div>
                  <hr>
                  <div class="pembayaran">
                    <div class="tahun">
                      <h5>Pembayaran tahun : 2023</h5>
                      <table class="table table-bordered">
                        <thead class="table-secondary">
                            <tr>
                              <th scope="col">No</th>
                              <th scope="col">Bulan</th>
                              <th scope="col">Jumlah Bayar</th>
                              <th scope="col">Tanggal Bayar</th>
                              <th scope="col">Status</th>
                              <th scope="col">Petugas</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($siswa->pembayaran as $pembayaran)
                            @php
                                if ($pembayaran->bayar) {
                                  $bayar = 'Lunas';
                                }else{
                                  $bayar = 'Belum Bayar';
                                }
                            @endphp
                            <tr>
                              <th scope="row">{{ $loop->iteration }}</th>
                              <td>{{ $pembayaran->bulan->nama_bulan }}</td>
                              <td>{{ $pembayaran->jml_bayar }}</td>
                              <td>{{ $pembayaran->tgl_bayar }}</td>
                              <td>{{ $bayar }}</td>
                              <td>{{ @$pembayaran->petugas->username }}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection