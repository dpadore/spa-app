@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1 class="mb-4">Панель управления</h1>

        <div class="row">
            <div class="col-md-4">
                <div class="list-group shadow-sm">
                    <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action">
                        Управление пользователями
                    </a>
                    <a href="{{ route('admin.services.index') }}" class="list-group-item list-group-item-action">
                        Управление услугами
                    </a>
                    <a href="/admin/categories"
                        class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        Управление категориями
                    </a>
                    <a href="{{ route('admin.specialists.index') }}" class="list-group-item list-group-item-action">
                        Управление специалистами
                    </a>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card bg-light border-0 shadow-sm">
                    <div class="card-body p-5 text-center">
                        <h3 class="text-muted">Добро пожаловать в админ-панель!</h3>
                        <p>Выберите нужный раздел в меню слева для начала работы.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection