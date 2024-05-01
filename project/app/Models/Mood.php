<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mood extends Model
{
    protected $fillable = ['userid','date', 'mood'];
    public $timestamps=false;
    use HasFactory;
}
