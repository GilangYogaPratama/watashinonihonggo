<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kotoba extends Model
{
    use HasFactory;

    protected $fillable = [
        'bab',
        'japanese',
        'kanji',
        'arti_indonesia',
    ];
}
