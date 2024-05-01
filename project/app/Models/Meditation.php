<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meditation extends Model
{
    protected $table = 'meditations';

    public function steps()
    {
        return $this->hasMany(MeditationStep::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class)->select('id','name','image');
    }
    // public function friend()
    // {
    //     return $this->belongsTo(User::class,'friend_id')->select('id','name','display_name','image');
    // }
    protected $fillable = ['title','description','video'];

}

