<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'first_name', 'last_name','email','birthday','level','guardian_id','role','password'];

    public function courses()
    {
        return $this->hasMany(StudentCourse::class);
    }
}
