@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Добавить новую категорию</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf 
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Название категории</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">Отмена</a>
                            <button type="submit" class="btn btn-success">Сохранить категорию</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection