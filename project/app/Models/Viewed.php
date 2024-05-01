<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viewed extends Model
{
    protected $table = 'viewed';

    // public function courses()
    // {
    //     return $this->hasMany(Course::class, 'university_id');
    // }
    
    public function view_by()
    {
        return $this->belongsTo(User::class,'view_by')->select('id','name','display_name','image');
    }
    // public function friend()
    // {
    //     return $this->belongsTo(User::class,'friend_id')->select('id','name','display_name','image');
    // }
    protected $fillable = ['user_id','view_by'];

}

