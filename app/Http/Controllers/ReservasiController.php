<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Jadwal;
use App\Models\Konsultasi;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservasiController extends Controller
{
    // ==================== FORM BUAT RESERVASI ====================
    public function create()
    {
        $dokters = Dokter::with('user')
            ->where('status', 'aktif')
            ->get();

        return view('pages.pasien.reservasi', compact('dokters'));
    }

    // ==================== SIMPAN RESERVASI ====================
    public function store(Request $request)
    {
        $request->validate([
            'dokter_id'  => 'required|exists:dokter,id',
            'jadwal_id'  => 'required|exists:jadwal,id',
            'keluhan'    => 'required|string|min:10|max:500',
        ]);

        $pasien = Pasien::where('user_id', Auth::id())->firstOrFail();

        $jadwal = Jadwal::where('id', $request->jadwal_id)
            ->where('dokter_id', $request->dokter_id)
            ->where('status', 'tersedia')
            ->where('sisa_kuota', '>', 0)
            ->firstOrFail();

        $existing = Konsultasi::where('pasien_id', $pasien->id)
            ->where('jadwal_id', $jadwal->id)
            ->whereIn('status', ['menunggu', 'dikonfirmasi', 'berlangsung'])
            ->first();

        if ($existing) {
            return redirect()->back()
                ->with('error', 'Anda sudah memiliki reservasi untuk jadwal ini.')
                ->withInput();
        }

        $konsultasi = Konsultasi::create([
            'pasien_id'  => $pasien->id,
            'dokter_id'  => $request->dokter_id,
            'jadwal_id'  => $jadwal->id,
            'keluhan'    => $request->keluhan,
            'status'     => 'menunggu',
        ]);

        $jadwal->decrement('sisa_kuota');

        if ($jadwal->fresh()->sisa_kuota <= 0) {
            $jadwal->update(['status' => 'penuh']);
        }

        return redirect()->route('pasien.reservasi.success')
            ->with('success', 'Reservasi berhasil dibuat!')
            ->with('konsultasi_id', $konsultasi->id);
    }

    // ==================== HALAMAN SUKSES ====================
    public function success()
    {
        return view('pages.pasien.reservasi-success');
    }

    // ==================== BATALKAN RESERVASI ====================
    public function batal($id)
    {
        $pasien = Pasien::where('user_id', Auth::id())->firstOrFail();
        $konsultasi = Konsultasi::where('id', $id)
            ->where('pasien_id', $pasien->id)
            ->whereIn('status', ['menunggu', 'dikonfirmasi'])
            ->firstOrFail();

        $jadwal = $konsultasi->jadwal;
        if ($jadwal) {
            $jadwal->increment('sisa_kuota');
            if ($jadwal->status === 'penuh') {
                $jadwal->update(['status' => 'tersedia']);
            }
        }

        $konsultasi->update(['status' => 'dibatalkan']);

        return redirect()->route('pasien.riwayat')
            ->with('success', 'Reservasi berhasil dibatalkan.');
    }

    // ==================== RIWAYAT RESERVASI ====================
    public function riwayat(Request $request)
    {
        $pasien = Pasien::where('user_id', Auth::id())->firstOrFail();

        $query = Konsultasi::with(['dokter.user', 'jadwal', 'rekamMedis'])
            ->where('pasien_id', $pasien->id);

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $konsultasis = $query->latest()->paginate(10);

        // Debug: cek apakah ada data
        // dd($konsultasis);

        return view('pages.pasien.riwayat-reservasi', compact('konsultasis'));
    }

    // ==================== DETAIL RIWAYAT ====================
    public function detailRiwayat($id)
    {
        $pasien = Pasien::where('user_id', Auth::id())->firstOrFail();
        $konsultasi = Konsultasi::with(['dokter.user', 'jadwal', 'rekamMedis'])
            ->where('id', $id)
            ->where('pasien_id', $pasien->id)
            ->firstOrFail();

        return view('pages.pasien.riwayat-detail', compact('konsultasi'));
    }

    // ==================== AJAX: JADWAL BY DOKTER ====================
    public function getJadwalByDokter(Request $request)
    {
        $request->validate([
            'dokter_id' => 'required|exists:dokter,id'
        ]);

        $jadwals = Jadwal::where('dokter_id', $request->dokter_id)
            ->where('status', 'tersedia')
            ->where('sisa_kuota', '>', 0)
            ->whereDate('tanggal', '>=', today())
            ->orderBy('tanggal')
            ->orderBy('jam_mulai')
            ->get(['id', 'tanggal', 'jam_mulai', 'jam_selesai', 'sisa_kuota']);

        return response()->json($jadwals);
    }
}