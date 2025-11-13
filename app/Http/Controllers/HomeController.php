<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Waktu Jakarta (WIB)
        $nowJakarta = Carbon::now('Asia/Jakarta');

        Log::info('User visited dashboard', [
            'user_id'    => $user->id,
            'email'      => $user->email,
            'username'   => $user->username,
            'role'       => $user->role,
            'ip'         => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return view('home', [
            'user'       => $user,
            'nowJakarta' => $nowJakarta,
        ]);
    }

    public function admin(Request $request)
    {
        $user = $request->user();

        $nowJakarta = Carbon::now('Asia/Jakarta');

        Log::info('Admin visited admin dashboard', [
            'user_id'    => $user->id,
            'email'      => $user->email,
            'username'   => $user->username,
            'role'       => $user->role,
            'ip'         => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return view('admin.dashboard', [
            'user'       => $user,
            'nowJakarta' => $nowJakarta,
        ]);
    }
}
