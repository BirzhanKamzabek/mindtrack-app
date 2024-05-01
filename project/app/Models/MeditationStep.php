<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeditationStep extends Model
{
    protected $table = 'meditation_steps';

    // public function courses()
    // {
    //     return $this->hasMany(Course::class, 'university_id');
    // }
    
    public function user()
    {
        return $this->belongsTo(User::class)->select('id','name','image');
    }
 
    protected $fillable = ['meditation_id','title','status'];

}

