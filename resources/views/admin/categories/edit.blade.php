@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Редактировать категорию: {{ $category->name }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                        @csrf
                        @method('PUT') 
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Название категории</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $category->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">Отмена</a>
                            <button type="submit" class="btn btn-primary">Обновить данные</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection