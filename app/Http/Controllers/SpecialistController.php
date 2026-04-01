<?php

namespace App\Http\Controllers;

use App\Models\Specialist;

class SpecialistController extends Controller
{
    public function index()
    {
        $specialists = Specialist::all();
        return view('specialists.index', compact('specialists'));
    }
}