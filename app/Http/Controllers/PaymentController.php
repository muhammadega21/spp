<?php

namespace App\Http\Controllers;

use App\Models\BillMonth;
use App\Models\Payment;
use App\Models\PaymentHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        return view('pages.payment.index', [
            'title' => 'Data Pembayaran',
            'data' =>  Payment::with(['month', 'package', 'student.class'])->where('status', 'pending')->orderBy('created_at', 'desc')->paginate(10)
        ]);
    }

    public function history()
    {
        if (Auth::user()->role == 'admin') {
            $data = PaymentHistory::with(['month', 'package', 'student.class'])->orderBy('created_at', 'desc')->paginate(10);
        } else {
            $data = PaymentHistory::with(['month', 'package', 'student.class'])->where('student_id', Auth::user()->students->first()->id)->orderBy('created_at', 'desc')->paginate(10);
        }
        return view('pages.payment.history', [
            'title' => 'Riwayat Pembayaran',
            'data' => $data
        ]);
    }

    public function approve(Request $request, $id)
    {
        $request->validate([
            'note' => 'required|string'
        ]);

        $payment = Payment::findOrFail($id);

        $payment->update([
            'status' => 'approved',
            'note'   => $request->note
        ]);

        if ($payment->bill_month_id) {
            BillMonth::where('id', $payment->bill_month_id)
                ->update(['status' => 'paid']);
        }

        PaymentHistory::create([
            'bill_package_id' => $payment->bill_package_id,
            'student_id' => $payment->student_id,
            'status' => 'approved',
            'amount' => $payment->amount,
            'proof_image' => $payment->proof_image,
            'note' => $request->note
        ]);

        return back()->with('success', 'Pembayaran berhasil disetujui');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'note' => 'required|string'
        ]);

        $payment = Payment::findOrFail($id);

        $payment->update([
            'status' => 'rejected',
            'note'   => $request->note
        ]);

        if ($payment->bill_month_id) {
            BillMonth::where('id', $payment->bill_month_id)
                ->update(['status' => 'unpaid']);
        }

        PaymentHistory::create([
            'bill_package_id' => $payment->bill_package_id,
            'student_id' => $payment->student_id,
            'status' => 'rejected',
            'amount' => $payment->amount,
            'proof_image' => $payment->proof_image,
            'note' => $request->note
        ]);

        return back()->with('success', 'Pembayaran ditolak');
    }

    public function payOnce(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'image.required' => 'Bukti pembayaran harus diisi',
            'image.image' => 'Bukti pembayaran harus berupa gambar',
            'image.mimes' => 'Bukti pembayaran harus berupa jpeg, png, atau jpg',
            'image.max' => 'Bukti pembayaran tidak boleh lebih dari 2MB',
        ]);

        $image = $request->file('image')->store('payments', 'public');

        Payment::updateOrCreate(
            [
                'bill_package_id' => $id,
                'student_id' => $request->student_id,
            ],
            [
                'amount' => $request->amount,
                'status' => 'pending',
                'proof_image' => $image,
            ]
        );

        return back()->with('success', 'Pembayaran berhasil! Silahkan menunggu verifikasi');
    }
}
