<?php

namespace App\Http\Controllers;

use App\Models\Dokter;

class DokterController extends Controller
{
    public function index()
    {
        // Ambil semua dokter dari database dengan relasi user
        $dokters = Dokter::with('user')->where('status', 'aktif')->get();

        return view('Dokter', compact('dokters'));
    }
}