@extends('layouts.app')

@section('title', 'Избранное')

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
                    <a href="{{ route('dashboard.edit') }}" class="list-group-item list-group-item-action">
                        <i class="bi bi-pencil"></i> Редактировать профиль
                    </a>
                    <a href="{{ route('dashboard.favorites') }}" class="list-group-item list-group-item-action active">
                        <i class="bi bi-heart"></i> Избранное
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h4>Избранное</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    
                    @if($favorites->isEmpty())
                        <p class="text-muted">У вас нет избранных услуг</p>
                    @else
                        <div class="row">
                            @foreach($favorites as $favorite)
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h5>{{ $favorite->service->title }}</h5>
                                            <p class="text-muted">{{ Str::limit($favorite->service->description, 80) }}</p>
                                            <p><strong>{{ number_format($favorite->service->price, 0, ',', ' ') }} BYN</strong></p>
                                            <div class="d-flex justify-content-between">
                                                <a href="{{ route('services.show', $favorite->service->service_id) }}" class="btn btn-sm btn-primary">Подробнее</a>
                                                <form action="{{ route('favorites.remove', $favorite->service->service_id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Удалить</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection