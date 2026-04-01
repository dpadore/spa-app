@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Наши специалисты</h1>

    <div class="row">
        @foreach($specialists as $specialist)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($specialist->photo_path)
                        <img src="{{ asset('img/' . $specialist->photo_path) }}" 
                             class="card-img-top" 
                             alt="{{ $specialist->name }}"
                             style="height: 250px; object-fit: cover; border-radius: 10px 10px 0 0;">
                    @else
                        <div class="text-center p-5 bg-light" style="height: 250px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-person-circle" style="font-size: 5rem; color: #81D8D0;"></i>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $specialist->name }}</h5>
                        <p class="card-text">{{ $specialist->bio }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection