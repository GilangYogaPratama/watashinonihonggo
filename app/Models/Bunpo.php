<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bunpo extends Model
{
    use HasFactory;

    protected $fillable = ['level', 'pattern', 'meaning', 'category', 'example'];
}
