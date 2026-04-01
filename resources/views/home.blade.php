@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
                    <h2>Добро пожаловать в СПА Салон</h2>
                    @auth
                        <p>Здравствуйте, {{ Auth::user()->name }}!</p>
                    @endauth

                <div class="card-body">
                    <h3 class="mb-4">Популярные услуги</h3>
                    <div class="row">
                        @forelse($popularServices as $service)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $service->title }}</h5>
                                        <p class="card-text">{{ Str::limit($service->description, 100) }}</p>
                                        <p><strong>{{ number_format($service->price, 0, ',', ' ') }} BYN</strong></p>
                                        <a href="/services/{{ $service->service_id }}" class="btn btn-primary">Подробнее</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>Нет доступных услуг</p>
                        @endforelse
                    </div>
                    
                </div>
        </div>
    </div>
</div>
@endsection