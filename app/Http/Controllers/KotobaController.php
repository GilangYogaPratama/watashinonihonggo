<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Kotoba;

class KotobaController extends Controller
{
    public function index()
    {
        $kotobas = Kotoba::where('level', 'N4')->orWhereNull('level')->inRandomOrder()->get();
        return view('kotoba', compact('kotobas'));
    }

    public function indexN3()
    {
        $kotobas = Kotoba::where('level', 'N3')->inRandomOrder()->get();
        return view('n3.kotoba', compact('kotobas'));
    }
}
