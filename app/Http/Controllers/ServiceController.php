<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request; 

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $query = Service::with('category');

        $query->when($request->search, function ($q, $search) {
            return $q->where('title', 'like', "%{$search}%");
        }
        );

        $query->when($request->category, function ($q, $categoryId) {
            return $q->where('category_id', $categoryId);
        });

        if ($request->sort == 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort == 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest();
        }


        $services = $query->paginate(12)->appends($request->all());

        return view('services.index', compact('services', 'categories'));
    }

    public function show($id)
    {
   
        $service = Service::with(['category', 'reviews.user'])->findOrFail($id);

        return view('services.show', compact('service'));
    }
}