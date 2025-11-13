@extends('layouts.app-bootstrap')

@section('title', 'Dashboard Admin')

@section('content')
<div class="row g-4">

    {{-- Header --}}
    <div class="col-12">
        <div class="card card-soft border-0">
            <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">

                <div>
                    <h5 class="card-title mb-1">
                        Selamat datang, Administrator {{ $user->name }}!
                    </h5>

                    <p class="text-muted small mb-1">
                        Anda sedang berada di panel Admin HC System.
                    </p>

                    <p class="text-muted small mb-0">
                        Waktu server: {{ $nowJakarta->format('d M Y H:i') }} WIB
                    </p>
                </div>

                {{-- Jam WIB --}}
                <div class="text-md-end">
                    <div class="text-muted small mb-1">Waktu saat ini (WIB)</div>
                    <div class="fs-5 fw-semibold" id="clockWib"></div>
                </div>

            </div>
        </div>
    </div>

    {{-- Statistik --}}
    <div class="col-md-4">
        <div class="card card-soft border-0">
            <div class="card-body text-center">
                <h6 class="text-muted small">Total User</h6>
                <div class="fs-3 fw-semibold">{{ $stats['total_users'] }}</div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-soft border-0">
            <div class="card-body text-center">
                <h6 class="text-muted small">Total Admin</h6>
                <div class="fs-3 fw-semibold">{{ $stats['total_admin'] }}</div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-soft border-0">
            <div class="card-body text-center">
                <h6 class="text-muted small">Total User Biasa</h6>
                <div class="fs-3 fw-semibold">{{ $stats['total_regular'] }}</div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    function updateClockWib() {
        const el = document.getElementById('clockWib');
        const now = new Date();
        const utc = now.getTime() + now.getTimezoneOffset() * 60000;
        const wib = new Date(utc + 7 * 3600000);
        el.textContent = wib.toLocaleTimeString('id-ID', { hour12: false });
    }
    document.addEventListener('DOMContentLoaded', () => {
        updateClockWib();
        setInterval(updateClockWib, 1000);
    });
</script>
@endsection
