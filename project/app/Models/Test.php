<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table = 'tests';

    // // public function courses()
    // // {
    // //     return $this->hasMany(Course::class, 'university_id');
    // // }
    
    public function user()
    {
        return $this->belongsTo(User::class)->select('id','name');
    }
    public function question()
    {
        return $this->belongsTo(Question::class)->select('id','question');
    }
    // protected $fillable = ['user_id','friend_id'];

}

