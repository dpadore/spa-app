@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">О нас</div>
                <div class="card-body">
                    <h3>Наш СПА-салон</h3>
                    <p>«Наши мастера — это команда с опытом работы от 5 до 15 лет. 
                    Мы не стоим на месте: ежегодно каждый специалист проходит повышение квалификации, чтобы предложить вам лучшие мировые техники массажа и ухода. 
                    За 2023 год мы обучились 10 новым методикам и внедрили 3 эксклюзивных спа-программы».</p>
                    
                    <h4 class="mt-4">Наши специалисты</h4>
                    <div class="row">
                        @foreach($specialists as $specialist)
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5>{{ $specialist->name }}</h5>
                                    <p>{{ $specialist->bio }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection