<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Petugas;
use App\Models\Siswa;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        $tgl = date('Y-m-d');

        for ($i = 1; $i <= 12; $i++) {
            $angka[] = $i;
        }
        return view('home.dashboard', [
            'title' => 'Dashboard',
            'jml_siswa' => Siswa::count(),
            'jml_kelas' => Kelas::count(),
            'jml_jurusan' => Jurusan::count(),
            'jml_petugas' => Petugas::count(),
            'total_bulanan' => DB::table('pembayarans')
                ->where('bulan_id', date('n'))
                ->where('tahun', date('Y'))
                ->sum('jml_bayar'),
            'total_tahunan' => DB::table('pembayarans')
                ->where('tahun', date('Y'))
                ->sum('jml_bayar'),
            'jml_saldo' => DB::table('pembayarans')->sum('jml_bayar'),
            'tgl' => Carbon::parse($tgl)->locale('id')->isoFormat('MMMM'),
        ]);
    }
}
