<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillPackage extends Model
{
    protected $fillable = ['title', 'amount', 'type', 'year'];

    public function months()
    {
        return $this->hasMany(BillMonth::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
