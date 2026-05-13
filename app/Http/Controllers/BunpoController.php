<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Bunpo;

class BunpoController extends Controller
{
    public function index()
    {
        $bunpos = Bunpo::inRandomOrder()->get();
        return view('flashcard', compact('bunpos'));
    }
}
