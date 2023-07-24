<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gurdian extends Model
{
    use HasFactory;

    public function student1()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
