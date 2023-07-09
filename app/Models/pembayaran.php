<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembayaran extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    public function siswa()
    {
        return $this->hasOne(Siswa::class);
    }
    public function petugas()
    {
        return $this->belongsTo(petugas::class);
    }
    public function bulan()
    {
        return $this->belongsTo(bulan::class);
    }
}
