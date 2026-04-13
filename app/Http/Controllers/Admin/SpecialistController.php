<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Specialist; 
use Illuminate\Http\Request;

class SpecialistController extends Controller
{
    public function index()
    {
        $specialists = Specialist::select('specialist_id', 'name', 'bio', 'photo_path')->get();
        return view('admin.specialists.index', ['specialists' => $specialists]);
    }

    public function create()
    {
        return view('admin.specialists.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio'  => 'required|string|max:2000', 
        ], [
            'name.required' => 'Поле "ФИО мастера" обязательно для заполнения',
            'name.string' => 'Поле "ФИО мастера" должно быть строкой',
            'name.max' => 'Поле "ФИО мастера" не может превышать 255 символов',
            'bio.required' => 'Поле "Описание / Биография" обязательно для заполнения',
            'bio.string' => 'Поле "Описание / Биография" должно быть строкой',
            'bio.max' => 'Поле "Описание / Биография" не может превышать 2000 символов',
        ]);

        Specialist::create([
            'name' => $request->name,
            'bio'  => $request->bio,
            'photo_path' => null, 
        ]);

        return redirect()->route('admin.specialists.index')->with('success', 'Специалист успешно добавлен!');
    }

    public function edit($id)
    {
        $specialist = Specialist::where('specialist_id', $id)->firstOrFail();
        return view('admin.specialists.edit', compact('specialist'));
    }

    public function update(Request $request, $id)
    {
        $specialist = Specialist::where('specialist_id', $id)->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'bio'  => 'required|string|max:2000',
        ], [
            'name.required' => 'Поле "ФИО мастера" обязательно для заполнения',
            'name.max' => 'Поле "ФИО мастера" не может превышать 255 символов',
            'bio.required' => 'Поле "Описание / Биография" обязательно для заполнения',
            'bio.max' => 'Поле "Описание / Биография" не может превышать 2000 символов',
        ]);

        $specialist->update([
            'name' => $request->name,
            'bio'  => $request->bio,
        ]);

        return redirect()->route('admin.specialists.index')
                         ->with('success', 'Данные мастера обновлены');
    }

    public function destroy($id)
    {
        $specialist = Specialist::where('specialist_id', $id)->firstOrFail();
        $specialist->delete();

        return redirect()->route('admin.specialists.index')->with('success', 'Специалист удален');
    }
}