<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ==================== HALAMAN LOGIN ====================
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user()->role);
        }
        return view('pages.auth.login');
    }

    // ==================== PROSES LOGIN ====================
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:4',
        ]);

        $credentials = $request->only('email', 'password');
        $remember    = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            $user = Auth::user();

            return $this->redirectByRole($user->role)
                ->with('success', 'Selamat datang, ' . ($user->nama ?? $user->name) . '!');
        }

        return back()
            ->withErrors(['email' => 'Email atau password salah.'])
            ->withInput($request->only('email'));
    }

    // ==================== HALAMAN REGISTER ====================
    public function showRegister()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user()->role);
        }
        return view('pages.auth.register');
    }

    // ==================== PROSES REGISTER ====================
    public function register(Request $request)
    {
        $request->validate([
            'nama'                  => 'required|string|min:3|max:100',
            'email'                 => 'required|email|unique:users,email',
            'nomor_hp'              => 'required|string|min:10|max:15',
            'password'              => 'required|min:6|confirmed',
            'tanggal_lahir'         => 'nullable|date|before:today',
            'alamat'                => 'nullable|string|max:255',
            'jenis_kelamin'         => 'nullable|in:L,P',
        ]);

        $user = User::create([
            'nama'          => $request->nama,
            'email'         => $request->email,
            'nomor_hp'      => $request->nomor_hp,
            'password'      => Hash::make($request->password),
            'role'          => 'pasien',
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        Pasien::create([
            'user_id'       => $user->id,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat'        => $request->alamat,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        // FIX: redirect ke dashboard pasien, bukan reservasi
        return redirect()->route('pasien.dashboard')
            ->with('success', 'Pendaftaran berhasil! Selamat datang, ' . $user->nama . '!');
    }

    // ==================== LOGOUT ====================
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('success', 'Anda berhasil logout.');
    }

    // ==================== HELPER: REDIRECT BY ROLE ====================
    private function redirectByRole(string $role)
    {
        return match ($role) {
            'admin'  => redirect()->intended(route('admin.dashboard')),
            'dokter' => redirect()->intended(route('dokter.dashboard')),
            'pasien' => redirect()->intended(route('pasien.dashboard')), // ← dashboard pasien
            default  => redirect()->route('home'),
        };
    }
}
