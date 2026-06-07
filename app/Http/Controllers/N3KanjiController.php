<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kanji;

class N3KanjiController extends Controller
{
    public function index()
    {
        $kanjis = Kanji::where('level', 'N3')->inRandomOrder()->get();
        return view('n3.kanji', compact('kanjis'));
    }

    public function create()
    {
        return view('n3.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kanji' => 'required|string|max:10',
            'onyomi' => 'nullable|string|max:100',
            'kunyomi' => 'nullable|string|max:100',
            'arti' => 'nullable|string|max:255',
        ]);

        Kanji::create([
            'kanji' => $validated['kanji'],
            'onyomi' => $validated['onyomi'],
            'kunyomi' => $validated['kunyomi'],
            'arti' => $validated['arti'],
            'level' => 'N3',
        ]);

        return redirect()->route('n3.input')->with('success', 'Kanji N3 berhasil ditambahkan secara manual!');
    }

    public function quiz()
    {
        $kanjis = Kanji::where('level', 'N3')->get();
        // Also fetch N4 Kanjis to serve as potential distractors in case there are not enough N3 kanjis entered yet!
        $allKanjis = Kanji::all();
        
        return view('n3.quiz', compact('kanjis', 'allKanjis'));
    }
}
