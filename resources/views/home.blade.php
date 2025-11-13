@extends('layouts.app-bootstrap')

@section('title', 'Dashboard')

@section('content')
<div class="row g-4">

    {{-- Greeting + waktu --}}
    <div class="col-12">
        <div class="card card-soft border-0">
            <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">

                <div>
                    <h5 class="card-title mb-1">
                        Selamat datang, {{ $user->name }}!
                    </h5>

                    <p class="card-text text-muted small mb-1">
                        Anda login sebagai <strong>{{ ucfirst($user->role) }}</strong>  
                        (ID / Username: <code>{{ $user->username }}</code>)
                    </p>

                    <p class="card-text text-muted small mb-0">
                        Terakhir login (server): {{ $nowJakarta->format('d M Y H:i') }} WIB
                    </p>
                </div>

                {{-- Jam WIB --}}
                <div class="text-md-end">
                    <div class="text-muted small mb-1">
                        Waktu saat ini (WIB)
                    </div>
                    <div class="fs-5 fw-semibold" id="clockWib"></div>
                    <div class="text-muted small">
                        Zona waktu: Asia/Jakarta
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Informasi Akun --}}
    <div class="col-12">
        <div class="card card-soft border-0">
            <div class="card-body">
                <h6 class="card-title mb-3">Informasi Akun</h6>

                <dl class="row small mb-0">
                    <dt class="col-4 text-muted">Nama</dt>
                    <dd class="col-8">{{ $user->name }}</dd>

                    <dt class="col-4 text-muted">Username</dt>
                    <dd class="col-8">{{ $user->username }}</dd>

                    <dt class="col-4 text-muted">Email</dt>
                    <dd class="col-8">{{ $user->email ?? '-' }}</dd>

                    <dt class="col-4 text-muted">Peran</dt>
                    <dd class="col-8">{{ ucfirst($user->role) }}</dd>

                    <dt class="col-4 text-muted">Terdaftar</dt>
                    <dd class="col-8">
                        {{ $user->created_at->timezone('Asia/Jakarta')->format('d M Y H:i') }} WIB
                    </dd>
                </dl>
            </div>
        </div>
    </div>

</div>
@endsection

@section('toast')
    @if (session('status'))
        <div class="toast align-items-center text-bg-success border-0 auto-show"
             role="alert" data-bs-delay="4000">
            <div class="d-flex">
                <div class="toast-body">{{ session('status') }}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast"></button>
            </div>
        </div>
    @endif
@endsection

@section('scripts')
<script>
    function updateClockWib() {
        const el = document.getElementById('clockWib');
        const now = new Date();
        const utc = now.getTime() + (now.getTimezoneOffset() * 60000);
        const wib = new Date(utc + 7 * 3600000);
        el.textContent = wib.toLocaleTimeString('id-ID', { hour12: false });
    }

    document.addEventListener('DOMContentLoaded', () => {
        updateClockWib();
        setInterval(updateClockWib, 1000);
    });
</script>
@endsection
