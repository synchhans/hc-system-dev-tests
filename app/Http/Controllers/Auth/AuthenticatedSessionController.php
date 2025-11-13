<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request)
    {
        Log::info('Login attempt', [
            'email'      => $request->input('email'),
            'ip'         => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        try {
            $request->authenticate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            session()->flash('login_error', 'Login gagal! ID atau Password salah.');
            throw $e;
        }

        $request->session()->regenerate();

        $user = $request->user();

        Log::info('Login success', [
            'user_id'    => $user->id,
            'email'      => $user->email,
            'role'       => $user->role,
            'ip'         => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->intended(route('home'));
    }

    public function destroy(Request $request)
    {
        $user = $request->user();

        Log::info('Logout', [
            'user_id'    => $user?->id,
            'email'      => $user?->email,
            'ip'         => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

}
