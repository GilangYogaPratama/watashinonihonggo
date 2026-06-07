<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Bunpo;

class BunpoController extends Controller
{
    public function index()
    {
        $bunpos = Bunpo::where('level', 'N4')->orWhereNull('level')->inRandomOrder()->get();
        return view('flashcard', compact('bunpos'));
    }

    public function indexN3()
    {
        $bunpos = Bunpo::where('level', 'N3')->inRandomOrder()->get();
        return view('n3.bunpo', compact('bunpos'));
    }
}
