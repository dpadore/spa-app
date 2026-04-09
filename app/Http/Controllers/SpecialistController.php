<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Specialist;

class SpecialistController extends Controller
{
    public function index()
    {
        $specialists = \App\Models\Specialist::all();
        return view('specialists.index', compact('specialists'));
    }

   
}