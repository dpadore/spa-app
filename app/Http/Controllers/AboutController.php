<?php

namespace App\Http\Controllers;

use App\Models\Specialist;

class AboutController extends Controller
{
    public function index()
    {
        $specialists = Specialist::all();
        return view('about', compact('specialists'));
    }
}