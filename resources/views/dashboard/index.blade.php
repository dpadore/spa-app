@extends('layouts.app')

@section('title', 'Личный кабинет')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Меню</h5>
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action active">
                            <i class="bi bi-person"></i> Профиль
                        </a>
                        <a href="{{ route('dashboard.edit') }}" class="list-group-item list-group-item-action">
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
                        <h3>Личный кабинет</h3>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-8">
                                <h4>Добро пожаловать, {{ $user->name }}!</h4>                                
                            </div>
                        </div>

                        <h5 class="mt-4">Мои активные записи</h5>
                        @if($activeReservations->isEmpty())
                            <p class="text-muted">У вас нет активных записей</p>
                        @else
                            <div class="row">
                                @foreach($activeReservations as $reservation)
                                    <div class="col-md-6 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h6>{{ $reservation->service->title }}</h6>
                                                <p>Специалист: {{ $reservation->specialist->name }}</p>
                                                <p>Дата: {{ $reservation->reservation_date }} в {{ $reservation->reservation_time }}
                                                </p>
                                                <span class="badge bg-success">Активна</span>

                                                <form action="{{ route('reservations.cancel', $reservation->reservation_id) }}"
                                                    method="POST" class="mt-2">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-sm btn-danger">Отменить</button>
                                                </form>
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