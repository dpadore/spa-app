<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'СПА Салон')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        .avatar-circle {
            width: 35px;
            height: 35px;
            background-color: #81D8D0;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .dropdown-toggle::after {
            display: none;
        }

        .nav-link i {
            font-size: 1.2rem;
        }

        .btn-custom-about {
            border: 2px solid #96440e;
            color: #96440e;
            background-color: transparent;
            transition: all 0.3s ease;
            /* Плавный переход */
            font-weight: 600;
        }

        .btn-custom-about:hover {
            background-color: #96440e;
            color: #ffffff !important;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">СПА Салон</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('services.index') }}">Услуги</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('specialists.index') }}">Специалисты</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">О нас</a>
                    </li>

                    @auth
                        @if(Auth::user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link text-danger fw-bold" href="{{ route('admin.index') }}">
                                 Админ-панель
                                </a>
                            </li>
                        @endif

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                </svg>
                                <span class="ms-1">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">
                                        <i class="bi bi-person"></i> Мой профиль
                                    </a></li>
                                <li><a class="dropdown-item" href="{{ route('dashboard.edit') }}">
                                        <i class="bi bi-pencil"></i> Редактировать профиль
                                    </a></li>
                                <li><a class="dropdown-item" href="{{ route('dashboard.favorites') }}">
                                        <i class="bi bi-heart"></i> Избранное
                                    </a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="bi bi-box-arrow-right"></i> Выйти
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right"></i> Вход
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="bi bi-person-plus"></i> Регистрация
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('info'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    {{ session('info') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>