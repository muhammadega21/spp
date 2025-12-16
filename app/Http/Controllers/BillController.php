<?php

namespace App\Http\Controllers;

use App\Models\BillMonth;
use App\Models\BillPackage;
use App\Models\Payment;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    public function index()
    {
        $data = [
            [
                [
                    'id' => "monthly",
                    'name' => 'Bulanan'
                ],
                [
                    'id' => "once",
                    'name' => 'Sekali Bayar'
                ]
            ]
        ];

        return view('pages.bill.index', [
            'title' => 'Data Tagihan',
            'data' => BillPackage::orderBy('title', 'asc')->paginate(10),
            'types' => $data[0]
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'year' => 'numeric',
            'amount' => 'required|numeric',
            'type' => 'required'
        ], [
            'title.required' => 'Nama tagihan harus diisi',
            'amount.required' => 'Jumlah harus diisi',
            'amount.numeric' => 'Jumlah harus berupa angka',
            'year.numeric' => 'Tahun harus berupa angka',
            'type.required' => 'Jenis tagihan harus diisi'
        ]);

        $package = BillPackage::create([
            'title' => $request->title,
            'year' => (int)$request->year,
            'amount' => (int)$request->amount,
            'type' => $request->type
        ]);

        $students = Student::where('year', $request->year)->get();

        foreach ($students as $student) {
            for ($month = 1; $month <= 12; $month++) {
                BillMonth::create([
                    'bill_package_id' => $package->id,
                    'student_id' => $student->id,
                    'month' => $month,
                    'status' => 'unpaid'
                ]);
            }
        }


        return redirect()->route('dashboard.bill.index')->with('success', 'Tagihan berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'year' => 'numeric',
            'amount' => 'required|numeric',
            'type' => 'required'
        ], [
            'title.required' => 'Nama tagihan harus diisi',
            'amount.required' => 'Jumlah harus diisi',
            'amount.numeric' => 'Jumlah harus berupa angka',
            'year.numeric' => 'Tahun harus berupa angka',
            'type.required' => 'Jenis tagihan harus diisi'
        ]);

        $package = BillPackage::findOrFail($id);
        $package->update([
            'title' => $request->title,
            'year' => (int)$request->year,
            'amount' => (int)$request->amount,
            'type' => $request->type
        ]);

        return redirect()->route('dashboard.bill.index')->with('success', 'Tagihan berhasil diubah.');
    }

    public function show($id)
    {
        $package = BillPackage::findOrFail($id);

        if (Auth::user()->role !== 'admin') {
            $students = Student::with('class')->where('guardian_id', Auth::user()->id)->where('year', $package->year)
                ->when($package->type === 'monthly', function ($query) use ($id) {
                    $query->with(['billMonths' => function ($q) use ($id) {
                        $q->where('bill_package_id', $id)
                            ->orderBy('month');
                    }]);
                })
                ->get();
        } else {
            $students = Student::with('class')->where('year', $package->year)
                ->when($package->type === 'monthly', function ($query) use ($id) {
                    $query->with(['billMonths' => function ($q) use ($id) {
                        $q->where('bill_package_id', $id)
                            ->orderBy('month');
                    }]);
                })
                ->get();
        }

        return view('pages.bill.show', [
            'title'   => 'Detail Tagihan',
            'package' => $package,
            'data'    => $students,
        ]);
    }

    public function detail($id, $month)
    {
        $package = BillPackage::findOrFail($id);

        $students = Student::with('class')->where('year', $package->year)->paginate(10);

        $billMonths = BillMonth::with('payment')->where('bill_package_id', $id)
            ->where('month', $month)
            ->get()
            ->keyBy('student_id');

        return view('pages.bill.detail', [
            'title' => "Daftar Siswa Bulan " . Carbon::create(null, $month)->locale('id_ID')->monthName,
            'package' => $package,
            'students' => $students,
            'bills' => $billMonths,
            'month' => $month,
        ]);
    }

    public function detailUpdate(Request $request, $id, $month)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'status' => 'required|in:unpaid,paid'
        ], [
            'amount.required' => 'Jumlah harus diisi',
            'amount.numeric' => 'Jumlah harus berupa angka',
            'status.required' => 'Status harus diisi',
            'status.in' => 'Status harus unpaid atau paid'
        ]);

        $bill = BillMonth::where('bill_package_id', $id)->where('month', $month)->firstOrFail();

        if ($request->status === 'paid') {
            $bill->update(['status' => $request->status]);

            if (!Payment::where('bill_month_id', $month)->where('bill_package_id', $id)->where('student_id', $request->student_id)->exists()) {
                Payment::create([
                    'bill_month_id' => $month,
                    'bill_package_id' => $id,
                    'student_id' => $request->student_id,
                    'amount' => $request->amount,
                    'status' => 'approved',
                    'note' => $request->note
                ]);
            } else {
                Payment::where('bill_month_id', $month)->where('bill_package_id', $id)->where('student_id', $request->student_id)->update([
                    'amount' => $request->amount,
                    'status' => 'approved',
                    'note' => $request->note
                ]);
            }
        } else {
            $bill->update(['status' => $request->status]);

            if (Payment::where('bill_month_id', $month)->where('bill_package_id', $id)->where('student_id', $request->student_id)->exists()) {
                Payment::where('bill_month_id', $month)->where('bill_package_id', $id)->where('student_id', $request->student_id)->delete();
            }
        }

        return redirect()->route('dashboard.bill.detail', [$id, $month])->with('success', 'Tagihan berhasil diubah.');
    }

    public function detailOnceUpdate(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'status' => 'required|in:unpaid,paid'
        ], [
            'amount.required' => 'Jumlah harus diisi',
            'amount.numeric' => 'Jumlah harus berupa angka',
            'status.required' => 'Status harus diisi',
            'status.in' => 'Status harus unpaid atau paid'
        ]);

        if ($request->status === 'paid') {
            if (!Payment::where('bill_package_id', $id)->where('student_id', $request->student_id)->exists()) {
                Payment::create([
                    'bill_month_id' => null,
                    'bill_package_id' => $id,
                    'student_id' => $request->student_id,
                    'amount' => $request->amount,
                    'status' => 'approved',
                    'note' => $request->note
                ]);
            } else {
                Payment::where('bill_package_id', $id)->where('student_id', $request->student_id)->update([
                    'amount' => $request->amount,
                    'status' => 'approved',
                    'note' => $request->note
                ]);
            }
        } else {
            if (Payment::where('bill_package_id', $id)->where('student_id', $request->student_id)->exists()) {
                Payment::where('bill_package_id', $id)->where('student_id', $request->student_id)->delete();
            }
        }

        return redirect()->route('dashboard.bill.show', [$id])->with('success', 'Tagihan berhasil diubah.');
    }


    public function destroy($id)
    {
        $bill = BillPackage::findOrFail($id);
        $bill->delete();
        return redirect()->route('dashboard.bill.index')->with('success', 'Tagihan berhasil dihapus.');
    }
}
