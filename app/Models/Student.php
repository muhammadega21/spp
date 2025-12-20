<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'nis',
        'guardian_id',
        'name',
        'class_id',
        'year'
    ];

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($student) {
            $student->guardian()->delete();
        });
    }

    public function guardian()
    {
        return $this->belongsTo(User::class, 'guardian_id');
    }

    public function class()
    {
        return $this->belongsTo(StudentClass::class, 'class_id');
    }

    public function billMonths()
    {
        return $this->hasMany(BillMonth::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
