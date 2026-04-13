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
        $services = Service::with('category')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.services.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required|numeric',
            'duration' => 'required|integer',
            'category_id' => 'required|exists:categories,category_id',
        ], [
            'title.required' => 'Поле "Название услуги" обязательно для заполнения',
            'title.max' => 'Поле "Название услуги" не может превышать 255 символов',
            'description.required' => 'Поле "Описание услуги" обязательно для заполнения',
            'description.max' => 'Поле "Описание услуги" не может превышать 255 символов',
            'price.required' => 'Поле "Цена" обязательно для заполнения',
            'price.numeric' => 'Поле "Цена" должно быть числом',
            'duration.required' => 'Поле "Длительность" обязательно для заполнения',
            'duration.integer' => 'Поле "Длительность" должно быть целым числом',
            'category_id.required' => 'Поле "Категория" обязательно для выбора',
            'category_id.exists' => 'Выбранная категория не существует',
        ]);

        Service::create($request->all());

        return redirect()->route('admin.services.index')->with('success', 'Услуга добавлена!');
    }

    public function edit($id)
    {
        $service = Service::where('service_id', $id)->firstOrFail();
        $categories = Category::all();

        return view('admin.services.edit', compact('service', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::where('service_id', $id)->firstOrFail();

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required|numeric',
            'duration' => 'required|integer|min:1',
            'category_id' => 'required|exists:categories,category_id',
        ], [
            'title.required' => 'Поле "Название услуги" обязательно для заполнения',
            'title.max' => 'Поле "Название услуги" не может превышать 255 символов',
            'description.required' => 'Поле "Описание услуги" обязательно для заполнения',
            'description.max' => 'Поле "Описание услуги" не может превышать 255 символов',
            'price.required' => 'Поле "Цена" обязательно для заполнения',
            'price.numeric' => 'Поле "Цена" должно быть числом',
            'duration.required' => 'Поле "Длительность" обязательно для заполнения',
            'duration.integer' => 'Поле "Длительность" должно быть целым числом',
            'duration.min'=>'Поле "Длительность" должно быть больше 0',
            'category_id.required' => 'Поле "Категория" обязательно для выбора',
            'category_id.exists' => 'Выбранная категория не существует',
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