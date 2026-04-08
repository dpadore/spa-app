@extends('layouts.app')

@section('title', 'Записаться')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Запись на процедуру</h4>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('reservations.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Услуга</label>
                            <select name="service_id" class="form-select" required>
                                <option value="">Выберите услугу</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->service_id }}" 
                                        {{ $selectedServiceId == $service->service_id ? 'selected' : '' }}>
                                        {{ $service->title }} - {{ number_format($service->price, 0, ',', ' ') }} BYN
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Специалист</label>
                            <select name="specialist_id" class="form-select" required>
                                <option value="">Выберите специалиста</option>
                                @foreach($specialists as $specialist)
                                    <option value="{{ $specialist->specialist_id }}">
                                        {{ $specialist->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Дата</label>
                            <input type="date" name="reservation_date" class="form-control" 
                                   min="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Время</label>
                            <select name="reservation_time" class="form-select" required>
                                <option value="">Выберите время</option>
                                @for($hour = 9; $hour <= 19; $hour++)
                                    @for($minute = 0; $minute < 60; $minute += 60)
                                        @php
                                            $time = sprintf('%02d:%02d:00', $hour, $minute);
                                        @endphp
                                        <option value="{{ $time }}">{{ sprintf('%02d:%02d', $hour, $minute) }}</option>
                                    @endfor
                                @endfor
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Записаться</button>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Отмена</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection