<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'HC System') }} - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8fafc;
            min-height: 100vh;
            font-family: system-ui, -apple-system, "Segoe UI", sans-serif;
        }

        .login-card {
            background: #ffffff;
            border-radius: .75rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 8px 28px rgba(0,0,0,0.08);
        }

        .brand-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #22c55e;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: white;
            font-size: 1.1rem;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center">
    {{-- Container utama --}}
    <div class="container py-5">
        @yield('content')
    </div>

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
</body>
</html>
