<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kanji;

class KanjiGameController extends Controller
{
    public function tebak($level, $type)
    {
        $levelUpper = strtoupper($level);

        if (!in_array($levelUpper, ['N3', 'N4']) || !in_array($type, ['onyomi', 'kunyomi'])) {
            abort(404);
        }

        $kanjis = Kanji::where('level', $levelUpper)
            ->whereNotNull($type)
            ->where($type, '!=', '—')
            ->get(['id', 'kanji', 'onyomi', 'kunyomi', 'arti']);

        return view('game.tebak', compact('kanjis', 'level', 'type'));
    }

    public function cocok($level, $type)
    {
        $levelUpper = strtoupper($level);

        if (!in_array($levelUpper, ['N3', 'N4']) || !in_array($type, ['onyomi', 'kunyomi'])) {
            abort(404);
        }

        $kanjis = Kanji::where('level', $levelUpper)
            ->whereNotNull($type)
            ->where($type, '!=', '—')
            ->get(['id', 'kanji', 'onyomi', 'kunyomi', 'arti']);

        return view('game.cocok', compact('kanjis', 'level', 'type'));
    }
}
