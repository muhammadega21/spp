<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    protected $fillable = [
        'bill_month_id',
        'bill_package_id',
        'student_id',
        'amount',
        'proof_image',
        'status',
        'note'
    ];

    public function month()
    {
        return $this->belongsTo(BillMonth::class, 'bill_month_id');
    }

    public function package()
    {
        return $this->belongsTo(BillPackage::class, 'bill_package_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
