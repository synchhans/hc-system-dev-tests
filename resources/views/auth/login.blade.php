@extends('layouts.guest-bootstrap')

@section('content')
<div class="mx-auto" style="max-width: 420px;">

    {{-- Logo / Branding --}}
    <div class="text-center mb-4">
        <div class="brand-icon mx-auto mb-3">
            HC
        </div>
        <h4 class="fw-semibold mb-0">{{ config('app.name', 'HC System') }}</h4>
        <p class="text-muted small mb-0">Silakan login ke akun Anda</p>
    </div>

    <div class="login-card p-4 p-md-5">

        <p class="small text-muted mb-4">
            Masukkan ID / Username dan password sesuai kredensial yang diberikan.
        </p>

        {{-- Form --}}
        <form method="POST" action="{{ route('login') }}" id="loginForm" novalidate>
            @csrf

            {{-- ID / Username --}}
            <div class="mb-3">
                <label class="form-label small mb-1">ID / Username</label>
                <input
                    type="text"
                    name="username"
                    value="{{ old('username') }}"
                    class="form-control"
                    placeholder="Masukkan ID / Username"
                    minlength="3"
                    required
                >
                <div class="invalid-feedback">
                    ID / Username minimal 3 karakter.
                </div>
            </div>

            {{-- Password --}}
            <div class="mb-3">
                <label class="form-label small mb-1">Password</label>
                <input
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="Masukkan password"
                    minlength="3"
                    required
                >
                <div class="invalid-feedback">
                    Password minimal 3 karakter.
                </div>
            </div>

            {{-- Tombol Login --}}
            <div class="d-grid mt-4">
                <button
                    type="submit"
                    id="btnLogin"
                    class="btn btn-success fw-semibold d-flex align-items-center justify-content-center gap-2"
                    disabled
                >
                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    <span class="btn-text">Login</span>
                </button>
            </div>
        </form>
    </div>

    <p class="text-center text-muted small mt-3 mb-0">
        © {{ date('Y') }} {{ config('app.name', 'HC System') }}
    </p>
</div>

{{-- SCRIPT: validasi front-end + loading --}}
<script>
(function () {
    const form     = document.getElementById('loginForm');
    const username = form.username;
    const password = form.password;
    const btn      = document.getElementById('btnLogin');
    const spinner  = btn.querySelector('.spinner-border');
    const btnText  = btn.querySelector('.btn-text');

    let submitted = false;

    function isFieldValid(field) {
        const value = field.value.trim();
        const min   = field.getAttribute('minlength') ? parseInt(field.getAttribute('minlength')) : 1;
        return value.length >= min;
    }

    function updateButtonState() {
        const validUsername = isFieldValid(username);
        const validPassword = isFieldValid(password);

        btn.disabled = !(validUsername && validPassword);
    }

    function showFieldErrorsOnSubmit() {
        if (!isFieldValid(username)) {
            username.classList.add('is-invalid');
        } else {
            username.classList.remove('is-invalid');
        }

        if (!isFieldValid(password)) {
            password.classList.add('is-invalid');
        } else {
            password.classList.remove('is-invalid');
        }
    }

    username.addEventListener('input', function () {
        if (submitted) {
            if (isFieldValid(username)) {
                username.classList.remove('is-invalid');
            }
        }
        updateButtonState();
    });

    password.addEventListener('input', function () {
        if (submitted) {
            if (isFieldValid(password)) {
                password.classList.remove('is-invalid');
            }
        }
        updateButtonState();
    });

    form.addEventListener('submit', function (e) {
        submitted = true;

        showFieldErrorsOnSubmit();
        updateButtonState();

        if (btn.disabled) {
            e.preventDefault();
            return;
        }

        // Loading state
        btn.disabled = true;
        spinner.classList.remove('d-none');
        btnText.textContent = 'Memproses...';
    });

    document.addEventListener('DOMContentLoaded', updateButtonState);
})();
</script>
@endsection

@section('toast')
    {{-- Error login kredensial salah --}}
    @if ($errors->has('credentials'))
        <div class="toast align-items-center text-bg-danger border-0 auto-show"
             role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="4000">
            <div class="d-flex">
                <div class="toast-body">
                    <strong>Login gagal!</strong><br>
                    {{ $errors->first('credentials') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    @endif

    {{-- Pesan sukses umum --}}
    @if (session('success'))
        <div class="toast align-items-center text-bg-success border-0 auto-show"
             role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="4000">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    @endif
@endsection
