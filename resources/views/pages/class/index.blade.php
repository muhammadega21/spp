@extends('layouts.main')
@section('content')
    <div class="content">
        <div class="flex justify-end">
            <button class="btn btn-primary" onclick="modal_add_class.showModal()">Tambah Kelas</button>
        </div>
        <div class="break-line"></div>
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kelas</th>
                        <th>Kompetensi Keahlian</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <th>{{ $loop->iteration + $data->firstItem() - 1 }}</th>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->competency }}</td>
                            <td class="flex gap-x-2">
                                <button onclick="modal_edit_class_{{ $item->id }}.showModal()"
                                    class="btn btn-sm btn-warning">Edit</button>
                                <form action="{{ route('dashboard.student-classes.destroy', $item->id) }}" method="POST"
                                    class="delete-form">
                                    @method('delete')
                                    @csrf
                                    <button class=" btn btn-sm btn-error">Hapus</button>
                                </form>
                            </td>
                        </tr>

                        <x-modals.modal id="modal_edit_class_{{ $item->id }}" title="Edit Kelas"
                            action="{{ route('dashboard.student-classes.update', $item->id) }}" method="PUT"
                            :inputs="[
                                [
                                    'id' => 'name',
                                    'label' => 'Nama Kelas',
                                    'type' => 'text',
                                    'name' => 'name',
                                    'value' => old('name', $item->name),
                                    'isRequired' => true,
                                ],
                                [
                                    'id' => 'competency',
                                    'label' => 'Kompetensi Keahlian',
                                    'type' => 'text',
                                    'name' => 'competency',
                                    'value' => old('competency', $item->competency),
                                    'isRequired' => true,
                                ],
                            ]" />
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

    <x-modals.modal id="modal_add_class" title="Tambah Kelas" action="{{ route('dashboard.student-classes.store') }}"
        method="POST" :inputs="[
            [
                'id' => 'name',
                'label' => 'Nama Kelas',
                'type' => 'text',
                'name' => 'name',
                'value' => old('name'),
                'isRequired' => true,
            ],
            [
                'id' => 'competency',
                'label' => 'Kompetensi Keahlian',
                'type' => 'text',
                'name' => 'competency',
                'value' => old('competency'),
                'isRequired' => true,
            ],
        ]" />

    <x-alert />
@endsection
