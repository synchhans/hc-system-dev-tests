<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'min:3'],
            'password' => ['required', 'string', 'min:3'],
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'ID / Username wajib diisi.',
            'username.string'   => 'ID / Username harus berupa teks.',
            'username.min'      => 'ID / Username minimal terdiri dari :min karakter.',
            'password.required' => 'Password wajib diisi.',
            'password.string'   => 'Password harus berupa teks.',
            'password.min'      => 'Password minimal terdiri dari :min karakter.',
        ];
    }

    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(
            ['username' => $this->get('username'), 'password' => $this->get('password')],
            $this->boolean('remember')
        )) {
            RateLimiter::hit($this->throttleKey());

            // ❗ Error kredensial SALAH kita taruh di key "credentials"
            throw ValidationException::withMessages([
                'credentials' => 'Login gagal! ID / Username atau Password tidak sesuai.',
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'credentials' => "Terlalu banyak percobaan login. Silakan coba lagi dalam {$seconds} detik.",
        ]);
    }

    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->get('username')).'|'.$this->ip());
    }
}
