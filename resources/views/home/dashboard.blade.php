@extends('layouts.main')

@section('container')
    <div class="container-fluid">
        <div class="row justify-content-center" style="margin-top: 80px; margin-left: 5px">
            <div class="col-9 col-sm-10 col-lg-11">
                <div class="dashboard">
                <div class="title">
                    <h5 class="d-block my-auto">Dashboard</h5>   
                    <span class="text-secondary">Home > <a href="/siswa">Data Siswa</a></span>
                </div>
                    <div class="card-main">
                        <div class="card-head d-flex justify-content-sm-between justify-content-xl-evenly flex-wrap bg-light">
                            <div class="card col-sm-3 mb-3 bg-success" style="width: 280px">
                                    <a href="{{ url('/siswa') }}">
                                        <span class="fs-4">{{ $jml_siswa }}</span>
                                        <span>Jumlah Siswa</span>
                                        <i class="fa-solid fa-user-group"></i>
                                    </a>
                            </div>
                            <div class="card col-sm-3 mb-3 bg-secondary" style="width: 280px">
                                    <a href="{{ url('/kelas') }}">
                                        <span class="fs-4">{{ $jml_kelas }}</span>
                                        <span>Jumlah Kelas</span>
                                        <i class="fa-solid fa-landmark"></i>
                                    </a>
                            </div>
                            <div class="card col-sm-3 mb-3" style="width: 280px; background-color: #10a9bd">
                                    <a href="{{ url('/jurusan') }}">
                                        <span class="fs-4">{{ $jml_jurusan }}</span>
                                        <span>Jumlah Jurusan</span>
                                        <i class="fa-solid fa-calendar-lines"></i>
                                    </a>
                            </div>
                            <div class="card col-sm-3 mb-3" style="width: 280px; background-color: #135c31">
                                <a href="{{ url('/petugas') }}">
                                    <span class="fs-4">{{ $jml_petugas }}</span>
                                    <span>Jumlah Petugas</span>
                                    <i class="fa-solid fa-user-tie"></i>
                                </a>
                            </div>
                            <div class="card col-sm-3 mb-3" style="width: 280px; background-color: #b3b623">
                                <a href="">
                                    <span class="fs-4">Rp {{ number_format($total_bulanan, 0, ',', '.') }}</span>
                                    <span>Transaksi Bulan {{ $tgl }}</span>
                                    <i class="fa-solid fa-circle-dollar"></i>
                                </a>
                            </div>
                            <div class="card col-sm-3 mb-3" style="width: 280px; background-color: #9b8a2a">
                                <a href="">
                                    <span class="fs-4">Rp {{ number_format($total_tahunan, 0, ',', '.') }}</span>
                                    <span>Transaksi Tahun 2023</span>
                                    <i class="fa-solid fa-circle-dollar"></i>
                                </a>
                            </div>
                            <div class="card col-sm-3 mb-3" style="width: 280px; background-color: #808719">
                                <a href="">
                                    <span class="fs-4">Rp {{ number_format($jml_saldo, 0, ',', '.') }}</span>
                                    <span>Jumlah Saldo</span>
                                    <i class="fa-solid fa-circle-dollar"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection