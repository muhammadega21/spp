@extends('layouts.main')
@section('content')
    <div class="content">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">
                {{ $package->title }}
            </h2>
            @can('wali')
                <button class="btn btn-primary" onclick="modal_pay_month.showModal()">Bayar</button>
            @endcan
        </div>
        <div class="break-line"></div>
        <div class="overflow-x-auto">
            @can('admin')
                @include('pages.bill.show_admin')
            @endcan
            @can('wali')
                @include('pages.bill.show_wali')
            @endcan
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
                                    @can('admin')
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
                                    @endcan
                                    @can('wali')
                                        @if ($payment && $payment->status == 'approved')
                                            <button class="btn btn-sm btn-info"
                                                onclick="modal_view_payment_{{ $student->id }}.showModal()">
                                                Lihat Pembayaran
                                            </button>
                                        @else
                                            <button class="btn btn-sm btn-success"
                                                onclick="modal_pay_once_{{ $student->id }}.showModal()">Bayar</button>
                                        @endif
                                    @endcan
                                </td>
                            </tr>
                            @can('admin')
                                <x-modals.modal id="modal_edit_detail_bill_once_{{ $student->id }}"
                                    title="Edit Detail Pembayaran"
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
                            @endcan

                            @can('wali')
                                <x-modals.modal-pay id="modal_pay_once_{{ $student->id }}" title="Form Pembayaran"
                                    action="{{ route('dashboard.payment.pay.once', $package->id) }}" :studentId="$student->id"
                                    :amount="$package->amount" />
                            @endcan

                            @if ($payment)
                                <x-modals.modal-view id="modal_view_payment_{{ $student->id }}" title="Detail Pembayaran">

                                    <div class="grid grid-cols-2 gap-2">
                                        <span class="font-semibold">Nama Siswa</span>
                                        <span>{{ $student->name }}</span>

                                        <span class="font-semibold">Kelas</span>
                                        <span>{{ $student->class->name }}</span>

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

                                </x-modals.modal-view>
                            @endif
                        @endforeach
                    </tbody>

                </table>
            @endif
        </div>
    </div>

    <x-alert />
@endsection
