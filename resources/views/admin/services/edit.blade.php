@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5>Редактировать: {{ $service->title }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.services.update', $service->service_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label>Название услуги</label>
                        <input type="text" 
                               name="title" 
                               class="form-control @error('title') is-invalid @enderror" 
                               value="{{ old('title', $service->title) }}"
                               required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Описание услуги</label>
                        <textarea name="description" 
                                  id="description"
                                  class="form-control @error('description') is-invalid @enderror"
                                  rows="3">{{ old('description', $service->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label>Категория</label>
                        <select name="category_id" 
                                class="form-select @error('category_id') is-invalid @enderror" 
                                required>
                            @foreach($categories as $category)
                                <option value="{{ $category->category_id }}" 
                                    {{ old('category_id', $service->category_id) == $category->category_id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Цена (руб)</label>
                            <input type="number" 
                                   name="price" 
                                   class="form-control @error('price') is-invalid @enderror"
                                   value="{{ old('price', $service->price) }}" 
                                   required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Длительность (мин)</label>
                            <input type="number" 
                                   name="duration" 
                                   class="form-control @error('duration') is-invalid @enderror"
                                   value="{{ old('duration', $service->duration) }}" 
                                   required>
                            @error('duration')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">Отмена</a>
                        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection