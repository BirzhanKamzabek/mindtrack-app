<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flame extends Model
{
    protected $table = 'flames';

    // public function courses()
    // {
    //     return $this->hasMany(Course::class, 'university_id');
    // }
    
    // public function user()
    // {
    //     return $this->belongsTo(User::class)->select('id','name','display_name','image');
    // }
    public function friend()
    {
        return $this->belongsTo(User::class,'friend_id')->select('id','name','display_name','image');
    }
    protected $fillable = ['user_id','friend_id'];

}

