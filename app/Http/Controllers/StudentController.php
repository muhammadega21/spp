<?php

namespace App\Http\Controllers;

use App\Models\BillMonth;
use App\Models\BillPackage;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return view('pages.student.index', [
            'title' => 'Data Siswa',
            'data' => Student::orderBy('name', 'asc')->paginate(10),
            'classes' => StudentClass::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_name' => 'required',
            'class_id' => 'required',
            'guardian_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4',
            'year' => 'numeric'
        ], [
            'student_name.required' => 'Nama siswa harus diisi.',
            'class_id.required' => 'Kelas harus diisi.',
            'guardian_name.required' => 'Nama wali harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email sudah ada.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 4 karakter.',
            'year.numeric' => 'Tahun masuk harus berupa angka'
        ]);

        $guardian = User::create([
            'name' => $request->guardian_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $student = Student::create([
            'name' => $request->student_name,
            'class_id' => $request->class_id,
            'guardian_id' => $guardian->id,
            'year' => (int)$request->year
        ]);

        // Ambil semua tagihan bulanan untuk tahun siswa
        $packages = BillPackage::where('type', 'monthly')
            ->where('year', $student->year)
            ->get();

        // Generate bill_months otomatis
        foreach ($packages as $package) {
            for ($month = 1; $month <= 12; $month++) {
                BillMonth::firstOrCreate([
                    'bill_package_id' => $package->id,
                    'student_id' => $student->id,
                    'month' => $month
                ], [
                    'status' => 'unpaid'
                ]);
            }
        }

        return redirect()->route('dashboard.student.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'student_name' => 'required',
            'guardian_name' => 'required',
            'class_id' => 'required',
        ], [
            'student_name.required' => 'Nama siswa harus diisi.',
            'guardian_name.required' => 'Nama wali harus diisi.',
            'class_id.required' => 'Kelas harus diisi.',
        ]);
        $student = Student::findOrFail($id);
        $guardian = User::where('id', $student->guardian_id)->first();
        $guardian->update([
            'name' => $request->guardian_name,
        ]);
        $student->update([
            'name' => $request->student_name,
            'class_id' => $request->class_id,
        ]);
        return redirect()->route('dashboard.student.index')->with('success', 'Kelas berhasil diubah.');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route('dashboard.student.index')->with('success', 'Kelas berhasil dihapus.');
    }
}
