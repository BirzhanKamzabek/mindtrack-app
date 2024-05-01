<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chats extends Model
{
    protected $table = 'chats';

    // public function courses()
    // {
    //     return $this->hasMany(Course::class, 'university_id');
    // }
    
    public function sender()
    {
        return $this->belongsTo(User::class,'sender_id')->select('id','name','image');
    }
    public function receiver()
    {
        return $this->belongsTo(User::class,'receiver_id')->select('id','name','image');
    }

    protected $fillable = ['text','file','sender_id','receiver_id'];
}

