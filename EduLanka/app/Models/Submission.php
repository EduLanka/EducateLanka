<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'content', 'upload_date','total_marks','grade','feedback','course_id','link_id','student_id'];
}
