@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Управление услугами</h1>
        <div>
            <a href="{{ route('admin.index') }}" class="btn btn-secondary btn-sm me-2">Назад в меню</a>
            <a href="{{ route('admin.services.create') }}" class="btn btn-primary btn-sm">+ Добавить услугу</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>Описание</th>
                        <th>Категория</th>
                        <th>Цена</th>
                        <th>Длительность</th>
                        <th class="text-end">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                    <tr>
                        <td>{{ $service->service_id }}</td>
                        <td><strong>{{ $service->title }}</strong></td>
                        <td>{{ $service->description }}</td>
                        <td>
                            @if($service->category)
                                <span class="text">{{ $service->category->name }}</span>
                            @else
                                <span class="text-muted">Без категории</span>
                            @endif
                        </td>
                        <td>{{ $service->price }} руб.</td>
                        <td>{{ $service->duration }} мин.</td>
                        <td class="text-end">
                            <a href="{{ route('admin.services.edit', $service->service_id) }}" class="btn btn-sm me-2 mb-2 btn-outline-primary">Изменить</a>
                            
                            <form action="{{ route('admin.services.destroy', $service->service_id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm me-2 btn-outline-danger" onclick="return confirm('Удалить эту услугу?')">
                                    Удалить
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Услуг пока нет</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection