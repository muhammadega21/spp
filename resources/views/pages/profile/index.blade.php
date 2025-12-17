@extends('layouts.main')

@section('content')
    <div class="card bg-base-100 shadow">
        <div class="card-body">
            <form action="{{ route('dashboard.profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nama --}}
                <div class="flex flex-col gap-y-2 mb-3">
                    <label class="label">Nama Lengkap</label>
                    <input type="text" name="name" class="input input-bordered" value="{{ auth()->user()->name }}"
                        required>
                </div>

                {{-- Email --}}
                <div class="flex flex-col gap-y-2 mb-3">
                    <label class="label">Email</label>
                    <input type="email" name="email" class="input input-bordered" value="{{ auth()->user()->email }}"
                        required>
                </div>

                @can('wali')
                    <div class="divider">Data Anak</div>
                    <table class="text-left leading-7">
                        <tr>
                            <th class="pe-4">Nama</th>
                            <td>: {{ $student->name }}</td>
                        </tr>
                        <tr>
                            <th class="pe-4">Kelas</th>
                            <td>: {{ $student->class->name }}</td>
                        </tr>
                        <tr>
                            <th class="pe-4">Tahun Masuk</th>
                            <td>: {{ $student->year }}</td>
                        </tr>
                    </table>
                @endcan

                <div class="divider">Keamanan</div>

                <div class="flex flex-col gap-y-2 mb-3">
                    <label class="label">Password Baru</label>
                    <input type="password" name="password" class="input input-bordered">
                </div>

                <div class="flex flex-col gap-y-2 mb-4">
                    <label class="label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="input input-bordered">
                </div>

                <button class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>

    <x-alert />
@endsection
