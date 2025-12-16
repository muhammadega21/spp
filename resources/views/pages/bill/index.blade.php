@extends('layouts.main')
@section('content')
    <div class="content">
        @can('admin')
            <div class="flex justify-end">
                <button class="btn btn-primary" onclick="modal_add_bill.showModal()">Tambah Tagihan</button>
            </div>
            <div class="break-line"></div>
        @endcan
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Tagihan</th>
                        <th>Tahun</th>
                        <th>Jumlah</th>
                        <th>Jenis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <th>{{ $loop->iteration + $data->firstItem() - 1 }}</th>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->year }}</td>
                            <td>Rp {{ number_format($item->amount, 0, ',', '.') }}</td>
                            <td>{{ $item->type == 'monthly' ? 'Bulanan' : 'Sekali Bayar' }}</td>
                            <td class="flex gap-x-2">
                                @can('admin')
                                    <button onclick="modal_edit_bill_{{ $item->id }}.showModal()"
                                        class="btn btn-sm btn-warning">Edit</button>
                                    <form action="{{ route('dashboard.bill.destroy', $item->id) }}" method="POST"
                                        class="delete-form">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-sm btn-error">Hapus</button>
                                    </form>
                                @endcan
                                <a href="{{ route('dashboard.bill.show', $item->id) }}"
                                    class="btn btn-sm btn-info">Detail</a>

                            </td>
                        </tr>
                        @can('admin')
                            <x-modals.modal id="modal_edit_bill_{{ $item->id }}" title="Edit Tagihan"
                                action="{{ route('dashboard.bill.update', $item->id) }}" method="PUT" :inputs="[
                                    [
                                        'id' => 'title',
                                        'label' => 'Nama Tagihan',
                                        'type' => 'text',
                                        'name' => 'title',
                                        'value' => old('title', $item->title),
                                        'isRequired' => true,
                                    ],
                                    [
                                        'id' => 'year',
                                        'label' => 'Tahun',
                                        'type' => 'text',
                                        'name' => 'year',
                                        'value' => old('year', $item->year, date('Y')),
                                        'isRequired' => false,
                                    ],
                                    [
                                        'id' => 'amount',
                                        'label' => 'Jumlah',
                                        'type' => 'number',
                                        'name' => 'amount',
                                        'value' => old('amount', $item->amount),
                                        'isRequired' => true,
                                    ],
                                ]" />
                        @endcan
                    @empty
                        <td colspan="9" class="text-center text-slate-600">Data Kosong</td>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $data->links() }}
    </div>
    @can('admin')
        <x-modals.modal id="modal_add_bill" title="Tambah Tagihan" action="{{ route('dashboard.bill.store') }}" method="POST"
            :inputs="[
                [
                    'id' => 'title',
                    'label' => 'Nama Tagihan',
                    'type' => 'text',
                    'name' => 'title',
                    'value' => old('title'),
                    'isRequired' => true,
                ],
                [
                    'id' => 'year',
                    'label' => 'Tahun',
                    'type' => 'text',
                    'name' => 'year',
                    'value' => old('year', date('Y')),
                    'isRequired' => false,
                ],
                [
                    'id' => 'amount',
                    'label' => 'Jumlah',
                    'type' => 'number',
                    'name' => 'amount',
                    'value' => old('amount'),
                    'isRequired' => true,
                ],
            ]" :selects="[
                [
                    'id' => 'type',
                    'label' => 'Jenis Tagihan',
                    'name' => 'type',
                    'options' => $types,
                    'value' => old('type'),
                    'isRequired' => true,
                ],
            ]" />
    @endcan
    <x-alert />
@endsection
