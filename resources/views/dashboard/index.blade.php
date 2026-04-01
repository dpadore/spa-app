@extends('layouts.app')

@section('title', 'Личный кабинет')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
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

                    <h4>Добро пожаловать, {{ $user->name }}!</h4>
                    <p>Email: {{ $user->email }}</p>

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
                                            <p>Дата: {{ $reservation->reservation_date }} в {{ $reservation->reservation_time }}</p>
                                            <span class="badge bg-success">Активна</span>
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