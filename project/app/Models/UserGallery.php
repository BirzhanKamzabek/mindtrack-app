<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGallery extends Model
{
    protected $table = 'user_gallery';

    // public function courses()
    // {
    //     return $this->hasMany(Course::class, 'university_id');
    // }
    
    // public function posts()
    // {
    //     return $this->belongsToMany(Posts::class, 'post_category', 'category_id', 'post_id');
    // }

    protected $fillable = ['user_id','image'];
}

