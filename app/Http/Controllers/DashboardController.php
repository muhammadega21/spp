<?php

namespace App\Http\Controllers;

use App\Models\BillPackage;
use App\Models\Payment;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $students = User::with('students')->where('role', 'wali')->first()->count();
        $bills = BillPackage::count();
        if (Auth::user()->role == 'admin') {
            $pendingPayment = Payment::where('status', 'pending')->count();
            $rejectedPayment = Payment::where('status', 'rejected')->count();
            $approvedPayment = Payment::where('status', 'approved')->count();
        } else {
            $pendingPayment = Payment::where('status', 'pending')->where('student_id', Auth::user()->students->first()->id)->count();
            $rejectedPayment = Payment::where('status', 'rejected')->where('student_id', Auth::user()->students->first()->id)->count();
            $approvedPayment = Payment::where('status', 'approved')->where('student_id', Auth::user()->students->first()->id)->count();
        }

        $year = now()->year;

        $payments = Payment::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw("SUM(status = 'approved') as approved"),
            DB::raw("SUM(status = 'pending') as pending"),
            DB::raw("SUM(status = 'rejected') as rejected")
        )
            ->whereYear('created_at', $year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month')
            ->get();

        $labels = [];
        $approved = array_fill(1, 12, 0);
        $pending  = array_fill(1, 12, 0);
        $rejected = array_fill(1, 12, 0);

        foreach ($payments as $row) {
            $approved[$row->month] = (int) $row->approved;
            $pending[$row->month]  = (int) $row->pending;
            $rejected[$row->month] = (int) $row->rejected;
        }

        for ($i = 1; $i <= 12; $i++) {
            $labels[] = Carbon::create()->month($i)->translatedFormat('F');
        }

        return view('pages.dashboard.index', [
            'title' => 'Dashboard',
            'students' => $students,
            'bills' => $bills,
            'pendingPayment' => $pendingPayment,
            'rejectedPayment' => $rejectedPayment,
            'approvedPayment' => $approvedPayment,
            'graphLabels' => $labels,
            'graphApproved' => $approved,
            'graphPending' => $pending,
            'graphRejected' => $rejected,
        ]);
    }
}
