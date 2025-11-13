<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'HC System') }} - @yield('title', 'Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8fafc;
            min-height: 100vh;
            font-family: system-ui, -apple-system, "Segoe UI", sans-serif;
        }

        .app-navbar {
            background: #0f172a; /* dark navy */
        }

        .app-navbar .navbar-brand,
        .app-navbar .nav-link,
        .app-navbar .navbar-text {
            color: #f9fafb !important;
        }

        .app-navbar .nav-link.active {
            font-weight: 600;
            border-bottom: 2px solid #22c55e;
        }

        .card-soft {
            border-radius: .75rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.06);
        }
    </style>
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-md app-navbar">
        <div class="container">
            <a class="navbar-brand fw-semibold" href="{{ route('home') }}">
                HC System
            </a>

            <button class="navbar-toggler text-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        @if (Route::has('profile.edit'))
                            <a class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}" href="{{ route('profile.edit') }}">
                                Profil
                            </a>
                        @endif
                    </li>
                    @if(auth()->user()?->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                Admin
                            </a>
                        </li>
                    @endif
                </ul>

                <div class="d-flex align-items-center gap-3">
                    <span class="navbar-text small d-none d-md-inline">
                        {{ auth()->user()->name }} ({{ auth()->user()->role }})
                    </span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    {{-- Konten --}}
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    {{-- Toast container (pojok kanan atas) --}}
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1100;">
        @yield('toast')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Auto-show toast yang punya class .auto-show
        document.addEventListener('DOMContentLoaded', function () {
            const toastEls = document.querySelectorAll('.toast.auto-show');
            toastEls.forEach(function (toastEl) {
                const t = new bootstrap.Toast(toastEl);
                t.show();
            });
        });
    </script>

    @yield('scripts')
</body>
</html>
