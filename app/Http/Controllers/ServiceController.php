<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Category;

class ServiceController extends Controller
{
   
    public function index()
    {
        $services = Service::with('category')->paginate(12);
        $categories = Category::all();
        
        return view('services.index', compact('services', 'categories'));
    }

    public function show($id)
    {
        $service = Service::with(['category', 'reviews.user'])->findOrFail($id);

        return view('services.show', compact('service'));
    }
   
}