<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    protected $fillable = [
        'name',
        'competency'
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
