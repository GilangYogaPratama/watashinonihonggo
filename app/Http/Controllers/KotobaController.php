<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Kotoba;

class KotobaController extends Controller
{
    public function index()
    {
        $kotobas = Kotoba::inRandomOrder()->get();
        return view('kotoba', compact('kotobas'));
    }
}
