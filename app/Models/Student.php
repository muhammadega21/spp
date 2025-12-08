<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'guardian_id',
        'nis',
        'name',
        'class',
    ];

    public function guardian()
    {
        return $this->belongsTo(User::class, 'guardian_id');
    }

    public function class()
    {
        return $this->belongsTo(StudentClass::class);
    }
}
