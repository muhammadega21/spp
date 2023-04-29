<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Bulan;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Pembayaran;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Petugas;
use App\Models\Spp;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'petugas_id' => '1',
            'email' => 'sppadmin@gmail.com',
            'password' => bcrypt('admin'),
            'level' => '1'
        ]);
        User::create([
            'siswa_id' => '1',
            'email' => 'dermawane988@gmail.com',
            'password' => bcrypt('password')
        ]);

        Petugas::create([
            'id' => 1,
            'name' => 'Administrator',
            'username' => 'Admin',
            'no_telp' => '082172391038',
            'alamat' => 'Padang Tinggi Piliang',
        ]);

        Siswa::create([
            'id' => 1,
            'kelas_id' => '3',
            'jurusan_id' => '3',
            'nisn' => '0048453299',
            'nis' => '20.01264',
            'name' => 'Muhammad Ega Dermawan',
            'username' => 'Ega',
            'no_telp' => '085763000486',
            'alamat' => 'Padang Tinggi Piliang'
        ]);

        Jurusan::create([
            'nama_jurusan' => 'Teknik Komputer dan Jaringan'
        ]);
        Jurusan::create([
            'nama_jurusan' => 'Multimedia'
        ]);
        Jurusan::create([
            'nama_jurusan' => 'Rekayasa Perangkat Lunak'
        ]);

        Kelas::create([
            'nama_kelas' => 'X'
        ]);
        Kelas::create([
            'nama_kelas' => 'XI'
        ]);
        Kelas::create([
            'nama_kelas' => 'XII'
        ]);

        Spp::create([
            'tahun' => '2021'
        ]);
        Spp::create([
            'tahun' => '2022'
        ]);
        Spp::create([
            'tahun' => '2023'
        ]);

        Bulan::create([
            'nama_bulan' => 'January'
        ]);
        Bulan::create([
            'nama_bulan' => 'February'
        ]);
        Bulan::create([
            'nama_bulan' => 'March'
        ]);
        Bulan::create([
            'nama_bulan' => 'April'
        ]);
        Bulan::create([
            'nama_bulan' => 'May'
        ]);
        Bulan::create([
            'nama_bulan' => 'June'
        ]);
        Bulan::create([
            'nama_bulan' => 'July'
        ]);
        Bulan::create([
            'nama_bulan' => 'August'
        ]);
        Bulan::create([
            'nama_bulan' => 'September'
        ]);
        Bulan::create([
            'nama_bulan' => 'October'
        ]);
        Bulan::create([
            'nama_bulan' => 'November'
        ]);
        Bulan::create([
            'nama_bulan' => 'December'
        ]);

        Pembayaran::create([
            'siswa_id' => '1',
            'petugas_id' => '1',
            'spp_id' => '1',
            'bulan_id' => '1',
            'tahun_ajaran' => '2023',
            'bayar' => 1,
            'tgl_bayar' => '2023-04-18',
            'jml_bayar' => '110000'
        ]);
        Pembayaran::create([
            'siswa_id' => '1',
            'petugas_id' => '1',
            'spp_id' => '1',
            'bulan_id' => '2',
            'tahun_ajaran' => '2023',
            'bayar' => 1,
            'tgl_bayar' => '2023-04-18',
            'jml_bayar' => '110000'
        ]);
        Pembayaran::create([
            'siswa_id' => '1',
            'petugas_id' => '1',
            'spp_id' => '1',
            'bulan_id' => '2',
            'tahun_ajaran' => '2022',
            'bayar' => 1,
            'tgl_bayar' => '2023-04-18',
            'jml_bayar' => '110000'
        ]);
        Pembayaran::create([
            'siswa_id' => '1',
            'petugas_id' => '1',
            'spp_id' => '1',
            'bulan_id' => '4',
            'tahun_ajaran' => '2023',
            'bayar' => 1,
            'tgl_bayar' => '2023-04-18',
            'jml_bayar' => '110000'
        ]);
    }
}
