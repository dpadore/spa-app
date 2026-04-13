<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:categories,name',
        ], [
            'name.required' => 'Поле "Название категории" обязательно для заполнения',
            'name.max' => 'Поле "Название категории" не может превышать 255 символов',
            'name.unique' => 'Категория с таким названием уже существует',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Категория успешно создана!');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:255|unique:categories,name,' . $category->category_id . ',category_id',
        ], [
            'name.required' => 'Поле "Название категории" обязательно для заполнения',
            'name.max' => 'Поле "Название категории" не может превышать 255 символов',
            'name.unique' => 'Категория с таким названием уже существует',
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Категория успешно обновлена!');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Категория удалена');
    }
}