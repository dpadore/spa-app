<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service; 
use App\Models\Category;

class ServiceController extends Controller
{
    public function index()
    {
        $services = \App\Models\Service::with('category')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
{
    $categories = \App\Models\Category::all();
    return view('admin.services.create', compact('categories'));
}

public function store(Request $request)
{
    $request->validate([
        'title' => 'required|max:255',
        'description'=> 'required|max:255',
        'price' => 'required|numeric',
        'duration' => 'required|integer',
        'category_id' => 'required|exists:categories,category_id',
    ]);

    \App\Models\Service::create($request->all());

    return redirect()->route('admin.services.index')->with('success', 'Услуга добавлена!');
}

public function edit($id)
{
    // Ищем по service_id, так как это твой первичный ключ
    $service = Service::where('service_id', $id)->firstOrFail();
    $categories = \App\Models\Category::all();
    
    return view('admin.services.edit', compact('service', 'categories'));
}

public function update(Request $request, $id)
{
    $service = Service::where('service_id', $id)->firstOrFail();

    $request->validate([
        'title' => 'required|max:255',
        'description' => 'required|max:255',
        'price' => 'required|numeric',
        'duration' => 'required|integer',
        'category_id' => 'required|exists:categories,category_id',
    ]);

    $service->title = $request->title;
    $service->description = $request->description ?? '';
    $service->price = $request->price;
    $service->duration = $request->duration;
    $service->category_id = $request->category_id;

    $service->save();

    return redirect()->route('admin.services.index')->with('success', 'Услуга успешно обновлена!');
}

public function destroy($id)
{
    $service = Service::where('service_id', $id)->firstOrFail();
    $service->delete();

    return redirect()->route('admin.services.index')->with('success', 'Услуга удалена');
}
}