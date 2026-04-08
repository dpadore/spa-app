@extends('layouts.app')

@section('title', $service->title)

@section('content')
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">{{ $service->title }}</h1>
            <p class="card-text">{{ $service->description }}</p>
            <p><strong>Цена:</strong> {{ number_format($service->price, 0, ',', ' ') }} BYN</p>
            <p><strong>Длительность:</strong> {{ $service->duration }} мин</p>
            <div class="mt-4">
                <a href="{{ route('reservations.create') }}?service_id={{ $service->service_id }}" class="btn"style="background-color: #96440e; border: none; color: #fff;">
                    Записаться
                </a>

                <form action="{{ route('favorites.add', $service->service_id) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-custom-about">
                        В избранное
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection