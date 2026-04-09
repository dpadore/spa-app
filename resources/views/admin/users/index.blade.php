@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm border-0">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Управление пользователями</h1>
            <div>
                <a href="{{ route('admin.index') }}" class="btn btn-secondary btn-sm me-2">Назад в меню</a>
            </div>
        </div>
            

            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Имя</th>
                            <th>Email</th>
                            <th>Роль</th>
                            <th class="text-end">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->user_id }}</td>
                                <td><strong>{{ $user->name }}</strong></td>
                                <td>{{ $user->email }}</td>
                                <td><span class="badge bg-secondary">{{ $user->role }}</span></td>
                                <td class="text-end">
                                    <form action="{{ route('admin.users.destroy', $user->user_id) }}" method="POST"
                                        onsubmit="return confirm('Вы уверены, что хотите удалить этого пользователя?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            Удалить
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($users->isEmpty())
                    <p class="text-center text-muted">Пользователей не найдено.</p>
                @endif
            </div>
        </div>
    </div>
@endsection