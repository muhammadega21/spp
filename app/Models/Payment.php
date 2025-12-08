<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'bill_id',
        'student_id',
        'amount',
        'proof_image',
        'status',
        'note',
    ];

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
