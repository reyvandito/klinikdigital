<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Halaman login
    public function showLogin()
    {
        return view('pages.auth.login');  // path ke auth/login
    }

    // Halaman register
    public function showRegister()
    {
        return view('pages.auth.register');  // path ke auth/register
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4'
        ]);

        $users = [
            'admin' => [
                'email' => 'admin@gmail.com',
                'password' => 'password',
                'role' => 'admin'
            ],
            'dokter' => [
                'email' => 'dokter@gmail.com',
                'password' => 'password',
                'role' => 'dokter'
            ],
            'pasien' => [
                'email' => 'pasien@gmail.com',
                'password' => 'password',
                'role' => 'pasien'
            ]
        ];

        foreach ($users as $user) {
            if ($request->email === $user['email'] && $request->password === $user['password']) {
                if ($user['role'] === 'admin') {
                    return redirect()->route('dashboard.admin')->with('success', 'Selamat datang Admin!');
                } elseif ($user['role'] === 'dokter') {
                    return redirect()->route('dashboard.dokter')->with('success', 'Selamat datang Dokter!');
                } elseif ($user['role'] === 'pasien') {
                    return redirect()->route('dashboard.pasien')->with('success', 'Selamat datang Pasien!');
                }
            }
        }

        return back()->with('error', 'Email atau password salah!')->withInput();
    }

    // Proses register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required|min:10',
            'password' => 'required|min:4|confirmed'
        ]);

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }

    // Logout
    public function logout()
    {
        return redirect()->route('home')->with('success', 'Anda telah logout.');
    }
}
