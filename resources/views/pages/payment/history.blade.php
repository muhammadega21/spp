@extends('layouts.main')
@section('content')
    @push('style')
    @endpush
    <div class="content">
        <div class="flex justify-end">
            <form action="">
                <label class="input">
                    <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none"
                            stroke="currentColor">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.3-4.3"></path>
                        </g>
                    </svg>
                    <input type="search" required placeholder="Cari Siswa" />
                </label>
            </form>
        </div>
        <div class="break-line"></div>
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Siswa</th>
                        <th>Kelas</th>
                        <th>Tagihan</th>
                        <th>Bulan</th>
                        <th>Nominal</th>
                        <th>Tanggal Bayar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <th>{{ $loop->iteration + $data->firstItem() - 1 }}</th>
                            <td>{{ $item->student->nis }}</td>
                            <td>{{ $item->student->name }}</td>
                            <td>{{ $item->student->class->name }}</td>
                            <td>{{ $item->package->title }}</td>
                            <td>{{ $item->month ? \Carbon\Carbon::create(null, $item->month->month)->locale('id_ID')->monthName : '-' }}
                            </td>
                            <td>Rp {{ number_format($item->amount, 0, ',', '.') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}</td>
                            <td>
                                <span
                                    class="badge {{ $item->status == 'approved' ? 'badge-success' : ($item->status == 'pending' ? 'badge-warning' : 'badge-error') }}">
                                    {{ $item->status == 'approved' ? 'Diterima' : ($item->status == 'pending' ? 'Pending' : 'Ditolak') }}
                                </span>
                            </td>
                            <td class="flex gap-x-2">
                                <button class="btn btn-square btn-sm btn-info"
                                    onclick="modal_view_payment_{{ $item->id }}.showModal()">
                                    <i class="bx bx-eye text-base"></i>
                                </button>
                            </td>
                        </tr>
                        <x-modals.modal-view id="modal_view_payment_{{ $item->id }}" title="Detail Pembayaran">

                            <div class="grid grid-cols-2 gap-2">
                                <span class="font-semibold">Nama Siswa</span>
                                <span>{{ $item->student->name }}</span>

                                <span class="font-semibold">Kelas</span>
                                <span>{{ $item->student->class->name }}</span>

                                @if ($item->month)
                                    <span class="font-semibold">Bulan</span>
                                    <span>{{ \Carbon\Carbon::create(null, $item->month->month)->locale('id_ID')->monthName }}</span>
                                @endif

                                <span class="font-semibold">Nominal</span>
                                <span>Rp {{ number_format($item->amount, 0, ',', '.') }}</span>

                                <span class="font-semibold">Tanggal Bayar</span>
                                <span>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}</span>

                                <span class="font-semibold">Status</span>
                                <span>
                                    @if ($item->status == 'approved')
                                        <span class="badge badge-success">Disetujui</span>
                                    @elseif ($item->status == 'pending')
                                        <span class="badge badge-warning">Menunggu Konfirmasi</span>
                                    @else
                                        <span class="badge badge-error">Ditolak</span>
                                    @endif
                                </span>

                                <span class="font-semibold">Catatan Admin</span>
                                <span>{{ $item->note ?? '-' }}</span>
                            </div>

                            <div class="mt-4">
                                <p class="font-semibold mb-2">Bukti Pembayaran</p>
                                @if ($item->proof_image)
                                    <img src="{{ asset('storage/' . $item->proof_image) }}" alt="Bukti Pembayaran"
                                        class="rounded border max-h-64">
                                @else
                                    <span class="text-gray-500">Belum ada bukti pembayaran</span>
                                @endif
                            </div>

                        </x-modals.modal-view>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-slate-600">Data Kosong</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $data->links() }}
    </div>

    <x-alert />
@endsection
