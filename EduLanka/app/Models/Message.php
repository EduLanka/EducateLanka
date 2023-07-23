<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';

    protected $fillable = ['topic', 'description', 'sender','reply'];


    public function senderUser(){
        return $this->belongsTo(User::class,'sender','id');
    }
}
