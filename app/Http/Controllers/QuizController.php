<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kanji;
use App\Models\Kotoba;

class QuizController extends Controller
{
    public function index()
    {
        // Fetch all Kanji
        $kanjis = Kanji::all();
        
        // Fetch all Kotoba that have valid kanji entries (exclude empty, hyphens)
        $kotobas = Kotoba::whereNotNull('kanji')
            ->where('kanji', '!=', '')
            ->where('kanji', '!=', '—')
            ->where('kanji', '!=', '-')
            ->where('kanji', '!=', '–')
            ->get();
            
        return view('quiz', compact('kanjis', 'kotobas'));
    }
}
