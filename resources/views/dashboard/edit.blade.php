@extends('layouts.app')

@section('title', 'Редактировать профиль')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Меню</h5>
                </div>
                <div class="list-group list-group-flush">
                    <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action">
                        <i class="bi bi-person"></i> Профиль
                    </a>
                    <a href="{{ route('dashboard.edit') }}" class="list-group-item list-group-item-action active">
                        <i class="bi bi-pencil"></i> Редактировать профиль
                    </a>
                    <a href="{{ route('dashboard.favorites') }}" class="list-group-item list-group-item-action">
                        <i class="bi bi-heart"></i> Избранное
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h4>Редактировать профиль</h4>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('dashboard.update') }}">
                        @csrf
                        @method('PUT')

                        <h5 class="mb-3">Основная информация</h5>
                        <hr>

                        <div class="mb-3">
                            <label class="form-label">Имя</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <h5 class="mb-3 mt-4">Смена пароля</h5>
                        <hr>

                        <div class="mb-3">
                            <label class="form-label">Новый пароль</label>
                            <input type="password" name="password" class="form-control">
                            <small class="text-muted">Оставьте пустым, если не хотите менять пароль</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Подтверждение пароля</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Отмена</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection