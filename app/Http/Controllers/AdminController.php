<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.dashboard', [
            'user'       => $request->user(),
            'nowJakarta' => Carbon::now('Asia/Jakarta'),
            'stats' => [
                'total_users'   => User::count(),
                'total_admin'   => User::where('role', 'admin')->count(),
                'total_regular' => User::where('role', 'user')->count(),
            ],
        ]);
    }
}
