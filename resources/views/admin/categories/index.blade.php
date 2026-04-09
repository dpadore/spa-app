@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Управление категориями</h1>
            <div>
                <a href="{{ route('admin.index') }}" class="btn btn-secondary btn-sm me-2">Назад в меню</a>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm">+ Добавить категорию</a>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Дата создания</th>
                            <th class="text-end">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>{{ $category->category_id }}</td>
                                <td><strong>{{ $category->name }}</strong></td>
                                <td>{{ $category->created_at->format('d.m.Y') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.categories.edit', $category->category_id) }}"
                                        class="btn btn-sm btn-outline-primary">Изменить</a>

                                    <form action="{{ route('admin.categories.destroy', $category->category_id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Вы уверены?')">
                                            Удалить
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">Категорий пока нет</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection