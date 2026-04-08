<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request; // Не забудьте импортировать этот класс

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        // 1. Получаем все категории для выпадающего списка
        $categories = Category::all();

        // 2. Создаем базовый запрос с загрузкой категории
        $query = Service::with('category');

        // 3. Поиск по названию (search)
        $query->when($request->search, function ($q, $search) {
            return $q->where('title', 'like', "%{$search}%");
        });

        // 4. Фильтрация по категории (category)
        $query->when($request->category, function ($q, $categoryId) {
            return $q->where('category_id', $categoryId);
        });

        // 5. Сортировка по цене (sort)
        if ($request->sort == 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort == 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            // Сортировка по умолчанию (например, новые услуги выше)
            $query->latest();
        }

        // 6. Получаем результат с пагинацией
        // Важно: appends сохраняет параметры фильтрации в ссылках пагинации
        $services = $query->paginate(12)->appends($request->all());

        return view('services.index', compact('services', 'categories'));
    }

    public function show($id)
    {
        // Используем service_id, так как в вашей базе нестандартный ПК
        $service = Service::with(['category', 'reviews.user'])->findOrFail($id);

        return view('services.show', compact('service'));
    }
}