@extends('layouts.app-bootstrap')

@section('title', 'Profil')

@section('content')
<div class="row g-4">
    <div class="col-12 col-lg-7">
        <div class="card card-soft border-0">
            <div class="card-body">
                <h5 class="card-title mb-3">Profil Akun</h5>
                <p class="text-muted small mb-4">
                    Perbarui informasi profil dan alamat email Anda.
                </p>

                <form method="POST" action="{{ route('profile.update') }}" class="small" novalidate>
                    @csrf
                    @method('PATCH')

                    {{-- Nama --}}
                    <div class="mb-3">
                        <label class="form-label small mb-1">Nama Lengkap</label>
                        <input
                            type="text"
                            name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $user->name) }}"
                            required
                        >
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Username (readonly untuk tes, bisa kamu buat editable kalau mau) --}}
                    <div class="mb-3">
                        <label class="form-label small mb-1">ID / Username</label>
                        <input
                            type="text"
                            class="form-control"
                            value="{{ $user->username }}"
                            disabled
                        >
                        <div class="form-text text-muted">
                            Username digunakan untuk login dan tidak dapat diubah pada demo ini.
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label class="form-label small mb-1">Email</label>
                        <input
                            type="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $user->email) }}"
                        >
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-text text-muted">
                            Opsional, dapat diisi untuk notifikasi sistem.
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-success btn-sm">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Ubah Password --}}
    <div class="col-12 col-lg-5">
        <div class="card card-soft border-0">
            <div class="card-body">
                <h6 class="card-title mb-3">Ubah Password</h6>

                <form method="POST" action="{{ route('password.update') }}" class="small" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label small mb-1">Password Saat Ini</label>
                        <input
                            type="password"
                            name="current_password"
                            class="form-control @error('current_password') is-invalid @enderror"
                            autocomplete="current-password"
                        >
                        @error('current_password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label small mb-1">Password Baru</label>
                        <input
                            type="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            autocomplete="new-password"
                        >
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label small mb-1">Konfirmasi Password Baru</label>
                        <input
                            type="password"
                            name="password_confirmation"
                            class="form-control"
                            autocomplete="new-password"
                        >
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-outline-secondary btn-sm">
                            Ubah Password
                        </button>
                    </div>
                </form>

                <p class="text-muted small mt-3 mb-0">
                    Disarankan menggunakan password yang kuat dan unik untuk keamanan akun Anda.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('toast')
    @if (session('status') === 'profile-updated')
        <div class="toast align-items-center text-bg-success border-0 auto-show"
             role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3500">
            <div class="d-flex">
                <div class="toast-body">
                    Profil berhasil diperbarui.
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    @endif
@endsection
        