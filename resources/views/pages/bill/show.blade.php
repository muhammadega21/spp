@extends('layouts.main')
@section('content')
    <div class="content">
        <h2 class="text-xl font-bold mb-4">
            {{ $package->title }}
        </h2>


        <div class="break-line"></div>
        <div class="overflow-x-auto">
            @if ($package->type == 'monthly')
                <table class="table">
                    <thead>
                        <tr>
                            <th>Bulan</th>
                            <th>Nominal</th>
                            <th>Total Siswa</th>
                            <th>Sudah Bayar</th>
                            <th>Belum Bayar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($month = 1; $month <= 12; $month++)
                            @php
                                // Ambil semua billMonths untuk bulan ini
                                $monthData = collect();

                                foreach ($data as $student) {
                                    $filtered = $student->billMonths->where('month', $month);
                                    if ($filtered->count()) {
                                        $monthData = $monthData->merge($filtered);
                                    }
                                }

                                // Hitung total siswa, sudah bayar, belum bayar
                                $total = $monthData->count();
                                $paid = $monthData->where('status', 'paid')->count();
                                $unpaid = $monthData->where('status', 'unpaid')->count();
                            @endphp

                            <tr>
                                <td>{{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }}</td>
                                <td>Rp {{ number_format($package->amount) }}</td>
                                <td>{{ $total }}</td>
                                <td class="text-green-600 font-semibold">{{ $paid }}</td>
                                <td class="text-red-600 font-semibold">{{ $unpaid }}</td>
                                <td>
                                    <a href="{{ route('dashboard.bill.detail', [$package->id, $month]) }}"
                                        class="btn btn-sm btn-primary">Lihat
                                        Siswa</a>
                                </td>
                            </tr>
                        @endfor
                    </tbody>

                </table>
            @endif
            @if ($package->type == 'once')
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $student)
                            @php
                                // Ambil pembayaran untuk tagihan once
                                $payment = $student->payments->where('bill_package_id', $package->id)->first();
                            @endphp


                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $student->name }}</td>

                                <td>{{ $student->class->name }}</td>

                                <td>
                                    @if ($payment)
                                        @if ($payment->status == 'approved')
                                            <span class="text-green-600 font-semibold">Sudah Bayar</span>
                                        @elseif ($payment->status == 'pending')
                                            <span class="text-yellow-600 font-semibold">Menunggu Konfirmasi</span>
                                        @else
                                            <span class="text-red-600 font-semibold">Ditolak</span>
                                        @endif
                                    @else
                                        <span class="text-red-600 font-semibold">Belum Bayar</span>
                                    @endif
                                </td>

                                <td class="flex items-center gap-x-1">
                                    @if ($payment && $payment->status == 'approved')
                                        <button class="btn btn-sm btn-warning"
                                            onclick="modal_edit_detail_bill_once_{{ $student->id }}.showModal()">Edit</button>
                                        <button class="btn btn-sm btn-info"
                                            onclick="modal_view_payment_{{ $student->id }}.showModal()">
                                            Lihat Pembayaran
                                        </button>
                                    @else
                                        <button class="btn btn-sm btn-warning"
                                            onclick="modal_edit_detail_bill_once_{{ $student->id }}.showModal()">Edit</button>
                                    @endif
                                </td>
                            </tr>

                            <x-modal id="modal_edit_detail_bill_once_{{ $student->id }}" title="Edit Detail Pembayaran"
                                action="{{ route('dashboard.bill.detail.update.once', $package->id) }}" method="PUT"
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
                                        'value' => old('note', $payment->note ?? null),
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
                                        'value' => old(
                                            'status',
                                            $payment ?? null
                                                ? ($payment->status == 'approved'
                                                    ? 'paid'
                                                    : 'unpaid')
                                                : 'unpaid',
                                        ),
                                        'isRequired' => true,
                                    ],
                                ]" />

                            <x-alert />

                            @if ($payment)
                                <x-modal-view id="modal_view_payment_{{ $student->id }}" title="Detail Pembayaran">

                                    <div class="grid grid-cols-2 gap-2">
                                        <span class="font-semibold">Nama Siswa</span>
                                        <span>{{ $student->name }}</span>

                                        <span class="font-semibold">Nominal</span>
                                        <span>Rp {{ number_format($payment->amount) }}</span>

                                        <span class="font-semibold">Tanggal Bayar</span>
                                        <span>{{ $payment->created_at->format('d M Y') }}</span>

                                        <span class="font-semibold">Status</span>
                                        <span>
                                            @if ($payment->status == 'approved')
                                                <span class="badge badge-success">Disetujui</span>
                                            @elseif ($payment->status == 'pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @else
                                                <span class="badge badge-error">Ditolak</span>
                                            @endif
                                        </span>

                                        <span class="font-semibold">Catatan Admin</span>
                                        <span>{{ $payment->note ?? '-' }}</span>
                                    </div>

                                    <div class="mt-4">
                                        <p class="font-semibold mb-2">Bukti Pembayaran</p>
                                        @if ($payment->proof_image)
                                            <img src="{{ asset('storage/' . $payment->proof_image) }}"
                                                alt="Bukti Pembayaran" class="rounded border max-h-64">
                                        @else
                                            <span class="text-gray-500">Belum ada bukti pembayaran</span>
                                        @endif
                                    </div>

                                </x-modal-view>
                            @endif
                        @endforeach
                    </tbody>

                </table>
            @endif
        </div>
    </div>
@endsection
