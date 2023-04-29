<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class petugas extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'username', 'no_telp', 'alamat', 'image'];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
