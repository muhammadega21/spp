@extends('layouts.main')
@section('content')
    <div class="content">
        <div class="flex justify-end">
            <button class="btn btn-primary" onclick="modal_add_student.showModal()">Tambah Siswa</button>
        </div>
        <div class="break-line"></div>
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Nama Wali Murid</th>
                        <th>Tahun Masuk</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <th>{{ $loop->iteration + $data->firstItem() - 1 }}</th>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->class->name }}</td>
                            <td>{{ $item->guardian->name }}</td>
                            <td>{{ $item->year }}</td>
                            <td class="flex gap-x-2">
                                <button onclick="modal_edit_student_{{ $item->id }}.showModal()"
                                    class="btn btn-sm btn-warning">Edit</button>
                                <form action="{{ route('dashboard.student.destroy', $item->id) }}" method="POST"
                                    class="delete-form">
                                    @method('delete')
                                    @csrf
                                    <button class=" btn btn-sm btn-error">Hapus</button>
                                </form>
                            </td>
                        </tr>

                        <x-modals.modal id="modal_edit_student_{{ $item->id }}" title="Edit Kelas"
                            action="{{ route('dashboard.student.update', $item->id) }}" method="PUT" :inputs="[
                                [
                                    'id' => 'student_name',
                                    'label' => 'Nama Siswa',
                                    'type' => 'text',
                                    'name' => 'student_name',
                                    'value' => old('student_name', $item->name),
                                    'isRequired' => true,
                                ],
                                [
                                    'id' => 'guardian_name',
                                    'label' => 'Nama Wali Murid',
                                    'type' => 'text',
                                    'name' => 'guardian_name',
                                    'value' => old('guardian_name', $item->guardian->name),
                                    'isRequired' => true,
                                ],
                                [
                                    'id' => 'year',
                                    'label' => 'Tahun Masuk',
                                    'type' => 'text',
                                    'name' => 'year',
                                    'value' => old('year', $item->year),
                                    'isRequired' => false,
                                ],
                            ]"
                            :selects="[
                                [
                                    'id' => 'class_id',
                                    'label' => 'Kelas',
                                    'name' => 'class_id',
                                    'options' => $classes,
                                    'value' => old('class_id', $item->class_id),
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

    <x-modals.modal id="modal_add_student" title="Tambah Siswa" action="{{ route('dashboard.student.store') }}"
        method="POST" :inputs="[
            [
                'id' => 'guardian_name',
                'label' => 'Nama Wali Murid',
                'type' => 'text',
                'name' => 'guardian_name',
                'value' => old('guardian_name'),
                'isRequired' => true,
            ],
            [
                'id' => 'email',
                'label' => 'Email Wali Murid',
                'type' => 'email',
                'name' => 'email',
                'value' => old('email'),
                'isRequired' => true,
            ],
            [
                'id' => 'password',
                'label' => 'Password Wali Murid',
                'type' => 'password',
                'name' => 'password',
                'value' => old('password'),
                'isRequired' => true,
            ],
            [
                'id' => 'student_name',
                'label' => 'Nama Siswa',
                'type' => 'text',
                'name' => 'student_name',
                'value' => old('student_name'),
                'isRequired' => true,
            ],
            [
                'id' => 'year',
                'label' => 'Tahun Masuk',
                'type' => 'text',
                'name' => 'year',
                'value' => old('year', date('Y')),
                'isRequired' => false,
            ],
        ]" :selects="[
            [
                'id' => 'class_id',
                'label' => 'Kelas',
                'name' => 'class_id',
                'options' => $classes,
                'value' => old('class_id'),
                'isRequired' => true,
            ],
        ]" />

    <x-alert />
@endsection
