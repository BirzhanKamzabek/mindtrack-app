<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
    // protected $fillable = ['user_id','friend_id'];

}

