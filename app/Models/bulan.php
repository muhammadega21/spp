<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bulan extends Model
{
    use HasFactory;

    public function pembayaran()
    {
        return $this->hasMany(pembayaran::class);
    }
}
