@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Добавить нового специалиста</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.specialists.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">ФИ мастера</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Например: Анна Иванова" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="bio" class="form-label">Биография</label>
                            <textarea name="bio" id="bio" rows="5" class="form-control" placeholder="Расскажите об опыте и навыках мастера..."></textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.specialists.index') }}" class="btn btn-light">Отмена</a>
                            <button type="submit" class="btn btn-primary">Сохранить мастера</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection