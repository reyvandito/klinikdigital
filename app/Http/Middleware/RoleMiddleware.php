<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        // DEBUG: cek role user
        // dd('Role user: ' . $user->role . ', Roles yang diizinkan: ' . implode(',', $roles));

        if (!in_array($user->role, $roles)) {
            // Redirect berdasarkan role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            if ($user->role === 'dokter') {
                return redirect()->route('dokter.dashboard');
            }
            if ($user->role === 'pasien') {
                return redirect()->route('pasien.reservasi.create');
            }
            return redirect()->route('home');
        }

        return $next($request);
    }
}