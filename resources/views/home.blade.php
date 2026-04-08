@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <div class="p-5 mb-4 bg-light rounded-3 shadow-sm"
        style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://www.anvar.kz/upload/iblock/fba/0e42dlmxddjumm6uxpucfwm4uwmsa1jk/Lake_George_Spa.jpg'); background-size: cover; background-position: center; min-height: 400px; display: flex; align-items: center;">
        <div class="container-fluid py-5 text-white">
            <h1 class="display-4 fw-bold">Погрузитесь в мир спокойствия</h1>
            <p class="col-md-8 fs-4">Профессиональный уход, расслабляющая атмосфера и лучшие мастера города. Мы создали
                идеальное место для вашего отдыха.</p>
            <a href="{{ url('/services') }}" class="btn btn-info btn-lg px-4"
                style="background-color: #96440e; border: none; color: #fff;">Выбрать процедуру</a>
        </div>
    </div>

    <div class="container">
        <div class="row align-items-center my-5">
            <div class="col-md-6">
                <h2 class="mb-4">Добро пожаловать в наш СПА-центр</h2>
                <p class="lead text-muted">Мы предлагаем комплексный подход к красоте и здоровью. В нашем арсенале
                    современные методики и натуральная косметика.</p>
                <ul class=" mt-3">
                    <li class="mb-2 round">Более 50 видов массажа и процедур</li>
                    <li class="mb-2">Сертифицированные мастера с опытом от 5 лет</li>
                    <li class="mb-2">Индивидуальный подбор программ ухода</li>
                    <li class="mb-2">Уютная атмосфера и фито-бар</li>
                </ul>
                <a href="{{ url('/about') }}" class="btn btn-custom-about mt-3">
                    Узнать больше о нас
                </a>
            </div>
            <div class="col-md-6">
                <img src="https://images.unsplash.com/photo-1600334129128-685c5582fd35?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                    class="img-fluid rounded shadow" alt="Интерьер спа">
            </div>
        </div>

        <hr class="my-5">

        <div class="row text-center">
            <h3 class="mb-5">Почему выбирают нас</h3>
            <div class="col-md-4">
                <div class="p-3">
                    <h5 style="color: #81D8D0">Релаксация</h5>
                    <p class="text-muted">Полное избавление от стресса и напряжения за один сеанс.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3">
                    <h5 style="color: #81D8D0">Красота</h5>
                    <p class="text-muted">Процедуры, которые возвращают коже сияние и здоровый вид.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3">
                    <h5 style="color: #81D8D0">Профессионализм</h5>
                    <p class="text-muted">Наши специалисты постоянно проходят повышение квалификации.</p>
                </div>
            </div>
        </div>
    </div>
@endsection