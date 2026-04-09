@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white"><h5>Добавить услугу</h5></div>
        <div class="card-body">
            <form action="{{ route('admin.services.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Название услуги</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Описание услуги</label>
                    <input type="text" name="description" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label>Категория</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">-- Выберите категорию --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->category_id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Цена (руб)</label>
                        <input type="number" name="price" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Длительность (мин)</label>
                        <input type="number" name="duration" class="form-control" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-success w-100">Создать услугу</button>
            </form>
        </div>
    </div>
</div>
@endsection