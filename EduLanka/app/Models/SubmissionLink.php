<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionLink extends Model
{
    use HasFactory;
    protected $fillable = ['title','description', 'dueDate','marks_available','course_id'];
    public function submissions()
    {
        return $this->hasMany(Submission::class, 'link_id');
    }

}
