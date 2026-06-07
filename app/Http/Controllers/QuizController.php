<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kanji;
use App\Models\Kotoba;

class QuizController extends Controller
{
    public function index(Request $request)
    {
        $level = $request->query('level', 'N4');
        
        // Fetch Kanji based on level
        $kanjis = Kanji::where('level', $level)->get();
        
        // Fetch Bunpo based on level
        $bunpos = \App\Models\Bunpo::where('level', $level)->get();
        
        // Fetch Kotoba based on level that have valid kanji entries
        $kotobas = Kotoba::where('level', $level)
            ->whereNotNull('kanji')
            ->where('kanji', '!=', '')
            ->where('kanji', '!=', '—')
            ->where('kanji', '!=', '-')
            ->where('kanji', '!=', '–')
            ->get();
            
        return view('quiz', compact('kanjis', 'bunpos', 'kotobas', 'level'));
    }
}
