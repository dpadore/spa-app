@extends('layouts.app')

@section('title', 'Услуги')

@section('content')
    <h1 class="mb-4">Наши услуги</h1>

    <div class="row mb-4">
        <div class="col-md-6">
            <form method="GET" action="{{ route('services.index') }}" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Поиск по названию..."
                    value="{{ request('search') }}">
                <button type="submit" class="btn" style="background-color:#81D8D0; color:#fff">Найти</button>
            </form>
        </div>

        <div class="col-md-6 text-end">
            <div class="btn-group">
                <a href="{{ route('services.index', ['sort' => 'price_asc', 'search' => request('search')]) }}"
                    class="btn btn-outline-secondary {{ request('sort') == 'price_asc' ? 'active' : '' }}">
                    Цена ↑
                </a>
                <a href="{{ route('services.index', ['sort' => 'price_desc', 'search' => request('search')]) }}"
                    class="btn btn-outline-secondary {{ request('sort') == 'price_desc' ? 'active' : '' }}">
                    Цена ↓
                </a>
            </div>
            <div class="btn-group ms-2">
                <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                    {{ $categories->find(request('category'))?->name ?? 'Все категории' }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item"
                            href="{{ route('services.index', array_merge(request()->all(), ['category' => null])) }}">
                            Все категории
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    @foreach($categories as $category)
                        <li>
                            <a class="dropdown-item {{ request('category') == $category->id ? 'active' : '' }}"
                                href="{{ route('services.index', array_merge(request()->all(), ['category' => $category->category_id])) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>
    <div class="row">
        @foreach($services as $service)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <span class="badge mb-2" style="background-color: #c38a62;">
                            {{ $service->category->name ?? 'Без категории' }}
                        </span>
                        <h5 class="card-title">{{ $service->title }}</h5>
                        <p class="card-text">{{ Str::limit($service->description, 100) }}</p>
                        <p><strong>{{ number_format($service->price, 0, ',', ' ') }} BYN</strong></p>
                        <a href="/services/{{ $service->service_id }}" style="color:#81D8D0;">Подробнее...</a>
                        <div class="mt-4">
                            <a href="{{ route('reservations.create') }}?service_id={{ $service->service_id }}" class="btn"
                                style="background-color: #96440e; border: none; color: #fff;">
                                Записаться
                            </a>

                            <form action="{{ route('favorites.add', $service->service_id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-custom-about">
                                    В избранное
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection