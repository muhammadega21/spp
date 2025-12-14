<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillMonth extends Model
{
    protected $fillable = ['bill_package_id', 'month', 'status', 'student_id'];

    public function package()
    {
        return $this->belongsTo(BillPackage::class, 'bill_package_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
