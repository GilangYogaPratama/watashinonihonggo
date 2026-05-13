<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Kanji;

class KanjiController extends Controller
{
    public function index()
    {
        $kanjis = Kanji::inRandomOrder()->get();
        return view('kanji', compact('kanjis'));
    }
}
