<?php

namespace App\Http\Controllers;

use App\Models\StudentClass;
use Illuminate\Http\Request;

class StudentClassController extends Controller
{
    public function index()
    {
        return view('pages.class.index', [
            'title' => 'Data Kelas',
            'data' => StudentClass::orderBy('name', 'asc')->paginate(5)
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:student_classes,name',
            'competency' => 'required'
        ], [
            'name.required' => 'Nama kelas harus diisi.',
            'name.unique' => 'Nama kelas sudah ada.',
            'competency.required' => 'Kompetensi keahlian harus diisi.'
        ]);

        StudentClass::create($request->all());
        return redirect()->route('dashboard.student-classes.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:student_classes,name,' . $id,
            'competency' => 'required'
        ], [
            'name.required' => 'Nama kelas harus diisi.',
            'name.unique' => 'Nama kelas sudah ada.',
            'competency.required' => 'Kompetensi keahlian harus diisi.'
        ]);

        $studentClass = StudentClass::findOrFail($id);
        $studentClass->update($request->all());
        return redirect()->route('dashboard.student-classes.index')->with('success', 'Kelas berhasil diubah.');
    }

    public function destroy($id)
    {
        $studentClass = StudentClass::findOrFail($id);
        $studentClass->delete();
        return redirect()->route('dashboard.student-classes.index')->with('success', 'Kelas berhasil dihapus.');
    }
}
