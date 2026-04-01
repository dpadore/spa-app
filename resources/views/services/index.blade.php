@extends('layouts.app')

@section('title', 'Услуги')

@section('content')
    <h1 class="mb-4">Наши услуги</h1>

    <div class="row">
        @foreach($services as $service)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                    <span class="badge mb-2" style="background-color: #81D8D0;">
                    {{ $service->category->name ?? 'Без категории' }}
                </span>
                        <h5 class="card-title">{{ $service->title }}</h5>
                        <p class="card-text">{{ Str::limit($service->description, 100) }}</p>
                        <p><strong>{{ number_format($service->price, 0, ',', ' ') }} BYN</strong></p>
                        <a href="/services/{{ $service->service_id }}" class="btn btn-primary">Подробнее</a>
                    </div>
                </div>
            </div>  
        @endforeach
    </div>
@endsection