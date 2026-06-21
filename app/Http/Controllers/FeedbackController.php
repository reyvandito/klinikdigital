<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    // ==================== ADMIN ====================
    
    /**
     * Tampilkan semua feedback untuk admin
     */
    public function index(Request $request)
    {
        $query = Feedback::with('user')->latest();

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('subjek', 'like', '%' . $request->search . '%');
            });
        }

        $feedbacks = $query->paginate(15);
        $totalBaru = Feedback::where('status', 'baru')->count();
        $totalDiproses = Feedback::where('status', 'diproses')->count();
        $totalSelesai = Feedback::where('status', 'selesai')->count();

        return view('pages.admin.feedback', compact('feedbacks', 'totalBaru', 'totalDiproses', 'totalSelesai'));
    }

    /**
     * Detail feedback untuk admin
     */
    public function show($id)
    {
        $feedback = Feedback::with('user')->findOrFail($id);

        if ($feedback->status == 'baru') {
            $feedback->update(['status' => 'dibaca']);
        }

        return view('pages.admin.feedback-detail', compact('feedback'));
    }

    /**
     * Update status feedback (admin)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:baru,dibaca,diproses,selesai',
        ]);

        $feedback = Feedback::findOrFail($id);
        $feedback->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status feedback berhasil diperbarui.');
    }

    /**
     * Kirim respon ke feedback (admin)
     */
    public function sendResponse(Request $request, $id)
    {
        $request->validate([
            'respon' => 'required|string|min:5',
        ]);

        $feedback = Feedback::findOrFail($id);
        $feedback->update([
            'respon' => $request->respon,
            'respon_at' => now(),
            'status' => 'selesai',
        ]);

        return redirect()->back()->with('success', 'Respon berhasil dikirim.');
    }

    /**
     * Hapus feedback (admin)
     */
    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        return redirect()->route('admin.feedback.index')->with('success', 'Feedback berhasil dihapus.');
    }

    // ==================== DOKTER ====================
    
    /**
     * Tampilkan feedback untuk dokter (hanya kategori 'dokter')
     */
    public function indexDokter(Request $request)
    {
        $query = Feedback::with('user')
            ->where('kategori', 'dokter')
            ->latest();

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('subjek', 'like', '%' . $request->search . '%');
            });
        }

        $feedbacks = $query->paginate(15);
        $totalBaru = Feedback::where('kategori', 'dokter')->where('status', 'baru')->count();
        $totalDiproses = Feedback::where('kategori', 'dokter')->where('status', 'diproses')->count();
        $totalSelesai = Feedback::where('kategori', 'dokter')->where('status', 'selesai')->count();

        return view('pages.dokter.feedback', compact('feedbacks', 'totalBaru', 'totalDiproses', 'totalSelesai'));
    }

    /**
     * Detail feedback untuk dokter
     */
    public function showDokter($id)
    {
        $feedback = Feedback::with('user')
            ->where('kategori', 'dokter')
            ->findOrFail($id);

        if ($feedback->status == 'baru') {
            $feedback->update(['status' => 'dibaca']);
        }

        return view('pages.dokter.feedback-detail', compact('feedback'));
    }

    /**
     * Update status feedback (dokter)
     */
    public function updateStatusDokter(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:baru,dibaca,diproses,selesai',
        ]);

        $feedback = Feedback::where('kategori', 'dokter')->findOrFail($id);
        $feedback->update(['status' => $request->status]);

        return redirect()->route('dokter.feedback.index')->with('success', 'Status feedback berhasil diperbarui.');
    }

    // ==================== PASIEN ====================

    /**
     * Form kirim feedback (pasien)
     */
    public function create()
    {
        return view('pages.pasien.feedback');
    }

    /**
     * Simpan feedback dari pasien
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|in:umum,dokter,website,reservasi,lainnya',
            'subjek' => 'required|string|min:3|max:100',
            'pesan' => 'required|string|min:10|max:1000',
        ]);

        $user = Auth::user();

        Feedback::create([
            'user_id' => $user->id,
            'nama' => $user->nama,
            'email' => $user->email,
            'kategori' => $request->kategori,
            'subjek' => $request->subjek,
            'pesan' => $request->pesan,
            'status' => 'baru',
        ]);

        return redirect()->route('pasien.feedback.success')->with('success', 'Feedback berhasil dikirim! Terima kasih atas masukannya.');
    }

    /**
     * Halaman sukses kirim feedback
     */
    public function success()
    {
        return view('pages.pasien.feedback-success');
    }

    /**
     * Riwayat feedback pasien
     */
    public function history()
    {
        $feedbacks = Feedback::where('user_id', Auth::id())->latest()->paginate(10);
        return view('pages.pasien.feedback-history', compact('feedbacks'));
    }
}