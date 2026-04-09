@extends('layouts.app')

@section('content')
<div class="container py-4">
 
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2">Управление специалистами</h1>
        <div>
            <a href="{{ route('admin.index') }}" class="btn btn-outline-secondary btn-sm me-2 text-decoration-none">
                <i class="bi bi-arrow-left"></i> Назад в меню
            </a>
            <a href="{{ route('admin.specialists.create') }}" class="btn btn-primary btn-sm text-decoration-none">
                <i class="bi bi-plus-lg"></i> Добавить мастера
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4" style="width: 10%">ID</th>
                            <th style="width: 25%">Имя</th>
                            <th style="width: 45%">Описание</th>
                            <th class="text-end pe-4" style="width: 20%">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($specialists as $master)
                            <tr>
                                <td class="ps-4 text-muted">{{ $master->specialist_id }}</td>
                                <td><strong>{{ $master->name }}</strong></td>
                                <td>
                                    <div class="text-muted small">
                                        {{ Str::limit($master->bio, 70) }}
                                    </div>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-flex justify-content-end align-items-center">
                                        <a href="{{ route('admin.specialists.edit', $master->specialist_id) }}" 
                                           class="btn btn-sm btn-outline-primary me-2">
                                            Изменить
                                        </a>
                                        
                                        <form action="{{ route('admin.specialists.destroy', $master->specialist_id) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Удалить специалиста?')"
                                              class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Удалить</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">Список специалистов пуст</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection