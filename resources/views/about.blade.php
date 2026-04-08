@extends('layouts.app')

@section('title', 'О нашем салоне')

@section('content')
<div class="container py-4">
    <div class="row align-items-center mb-5">
        <div class="col-lg-6">
            <h1 class="display-4 fw-bold mb-4" style="color: #96440e;">Искусство отдыха</h1>
            <p class="lead">Наш СПА-салон — это не просто набор процедур, а пространство, созданное для восстановления физического и душевного баланса.</p>
        </div>
        <div class="col-lg-6">
            <img src="https://thaihouseclub.ru/wp-content/uploads/2018/11/creative_opt1-1024x618.jpeg" class="img-fluid rounded-4 shadow-sm" alt="Атмосфера спа">
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm text-center p-3">
                <div class="card-body">
                    <div class="mb-3" style="font-size: 2.5rem; color: #81D8D0;">
                        <i class="bi bi-heart"></i>
                    </div>
                    <h5>Натуральность</h5>
                    <p class="text-muted">Используем только органическую косметику премиум-класса, безопасную для кожи и природы.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm text-center p-3">
                <div class="card-body">
                    <div class="mb-3" style="font-size: 2.5rem; color: #81D8D0;">
                        <i class="bi bi-house-heart"></i>
                    </div>
                    <h5>Атмосфера</h5>
                    <p class="text-muted">Приглушенный свет, ароматерапия и авторский плейлист для полного погружения в релакс.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm text-center p-3">
                <div class="card-body">
                    <div class="mb-3" style="font-size: 2.5rem; color: #81D8D0;">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h5>Стерильность</h5>
                    <p class="text-muted">Мы соблюдаем строжайшие стандарты гигиены: одноразовые материалы и глубокая дезинфекция.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-light p-5 rounded-4 mb-5 shadow-sm">
        <div class="row text-center">
            <div class="col-md-3">
                <h2 class="fw-bold" style="color: #81D8D0;">10+</h2>
                <p class="text-muted mb-0">Лет опыта</p>
            </div>
            <div class="col-md-3">
                <h2 class="fw-bold" style="color: #81D8D0;">50+</h2>
                <p class="text-muted mb-0">Видов услуг</p>
            </div>
            <div class="col-md-3">
                <h2 class="fw-bold" style="color: #81D8D0;">5000+</h2>
                <p class="text-muted mb-0">Счастливых клиентов</p>
            </div>
            <div class="col-md-3">
                <h2 class="fw-bold" style="color: #81D8D0;">100%</h2>
                <p class="text-muted mb-0">Релакс</p>
            </div>
        </div>
    </div>

    <div class="text-center py-4">
        <h3 class="mb-4">Готовы подарить себе отдых?</h3>
        <p class="mb-4 text-muted">Посмотрите нашу команду профессионалов и выберите своего мастера.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('specialists.index') }}" class="btn btn-lg px-4" style="background-color: #81D8D0; color: white; border: none;">Наши специалисты</a>
            <a href="{{ route('services.index') }}" class="btn btn-outline-secondary btn-lg px-4">Каталог услуг</a>
        </div>
    </div>
</div>
@endsection