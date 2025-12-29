@extends('layouts.main')

@section('content')
    <div class="content">
        <h2 class="text-xl font-bold mb-4">
            Daftar Siswa — {{ \Carbon\Carbon::create(null, $month)->locale('id_ID')->monthName }}
        </h2>
        <div class="break-line"></div>

        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($students as $student)
                        @php
                            $bill = $bills->get($student->id);
                        @endphp

                        <tr>
                            <td>{{ $loop->iteration + $students->firstItem() - 1 }}</td>
                            <td>{{ $student->nis }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->class->name }}</td>
                            <td>
                                @if ($bill && $bill->status == 'paid')
                                    <span class="text-green-600 font-semibold">Sudah Bayar</span>
                                @else
                                    <span class="text-red-600 font-semibold">Belum Bayar</span>
                                @endif
                            </td>
                            <td class="flex items-center gap-x-1">
                                @if ($bill && $bill->status == 'paid')
                                    <button class="btn btn-sm btn-warning"
                                        onclick="modal_edit_detail_bill_month{{ $student->id }}.showModal()">Edit</button>
                                    <button class="btn btn-sm btn-info"
                                        onclick="modal_view_payment_{{ $student->id }}.showModal()">
                                        Lihat Pembayaran
                                    </button>
                                @else
                                    <button class="btn btn-sm btn-warning"
                                        onclick="modal_edit_detail_bill_month{{ $student->id }}.showModal()">Edit</button>
                                @endif
                            </td>
                        </tr>

                        <x-modals.modal id="modal_edit_detail_bill_month{{ $student->id }}" title="Edit Detail Pembayaran"
                            action="{{ route('dashboard.bill.detail.update', [$package->id, $month]) }}" method="PUT"
                            :inputs="[
                                [
                                    'id' => 'student_id',
                                    'label' => 'Siswa',
                                    'type' => 'hidden',
                                    'name' => 'student_id',
                                    'value' => $student->id,
                                    'isRequired' => true,
                                ],
                                [
                                    'id' => 'amount',
                                    'label' => 'Nominal',
                                    'type' => 'number',
                                    'name' => 'amount',
                                    'value' => old('amount', $package->amount),
                                    'isRequired' => true,
                                ],
                                [
                                    'id' => 'note',
                                    'label' => 'Catatan',
                                    'type' => 'text',
                                    'name' => 'note',
                                    'value' => old('note', $bill->payment->note ?? null),
                                    'isRequired' => false,
                                ],
                            ]" :selects="[
                                [
                                    'id' => 'status',
                                    'label' => 'Jenis Tagihan',
                                    'name' => 'status',
                                    'options' => [
                                        ['id' => 'unpaid', 'name' => 'Belum Bayar'],
                                        ['id' => 'paid', 'name' => 'Sudah Bayar'],
                                    ],
                                    'value' => old('status', $bill->status == 'paid' ? 'paid' : 'unpaid'),
                                    'isRequired' => true,
                                ],
                            ]" />

                        <x-alert />

                        @if ($bill && $bill->payment)
                            <x-modals.modal-view id="modal_view_payment_{{ $student->id }}" title="Detail Pembayaran">

                                <div class="grid grid-cols-2 gap-2">
                                    <span class="font-semibold">Nama Siswa</span>
                                    <span>{{ $student->name }}</span>

                                    <span class="font-semibold">Kelas</span>
                                    <span>{{ $student->class->name }}</span>

                                    <span class="font-semibold">Bulan</span>
                                    <span>{{ \Carbon\Carbon::create(null, $month)->locale('id_ID')->monthName }}</span>

                                    <span class="font-semibold">Nominal</span>
                                    <span>Rp {{ number_format($bill->payment->amount) }}</span>

                                    <span class="font-semibold">Tanggal Bayar</span>
                                    <span>{{ $bill->payment->created_at->format('d M Y') }}</span>

                                    <span class="font-semibold">Status</span>
                                    <span>
                                        @if ($bill->payment->status == 'approved')
                                            <span class="badge badge-success">Disetujui</span>
                                        @elseif ($bill->payment->status == 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @else
                                            <span class="badge badge-error">Ditolak</span>
                                        @endif
                                    </span>

                                    <span class="font-semibold">Catatan Admin</span>
                                    <span>{{ $bill->payment->note ?? '-' }}</span>
                                </div>

                                <div class="mt-4">
                                    <p class="font-semibold mb-2">Bukti Pembayaran</p>
                                    @if ($bill->payment->proof_image)
                                        <img src="{{ asset('storage/' . $bill->payment->proof_image) }}"
                                            alt="Bukti Pembayaran" class="rounded border max-h-64">
                                    @else
                                        <span class="text-gray-500">Belum ada bukti pembayaran</span>
                                    @endif
                                </div>

                            </x-modals.modal-view>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4">
        {{ $students->links() }}
    </div>
@endsection
