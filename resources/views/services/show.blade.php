@extends('layouts.app')

@section('title', $service->title)

@section('content')
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">{{ $service->title }}</h1>
            <p class="card-text">{{ $service->description }}</p>
            <p><strong>Цена:</strong> {{ number_format($service->price, 0, ',', ' ') }} BYN</p>
            <p><strong>Длительность:</strong> {{ $service->duration }} мин</p>
            
            @auth
                <a href="/reservations/create?service_id={{ $service->service_id }}" class="btn btn-primary">
                    Записаться
                </a>
            @endauth
        </div>
    </div>
@endsection