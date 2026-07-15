<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index(Request $request)
    {
        $query = Dokter::with('user')
            ->where('status', 'aktif');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($userQuery) use ($search) {
                    $userQuery->where('nama', 'like', '%' . $search . '%');
                })->orWhere('spesialis', 'like', '%' . $search . '%');
            });
        }

        // Filter Spesialis
        if ($request->filled('spesialis')) {
            $query->where('spesialis', $request->spesialis);
        }

        // Sort
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'nama_asc':
                    $query->join('users', 'dokter.user_id', '=', 'users.id')
                          ->orderBy('users.nama', 'asc')
                          ->select('dokter.*');
                    break;
                case 'nama_desc':
                    $query->join('users', 'dokter.user_id', '=', 'users.id')
                          ->orderBy('users.nama', 'desc')
                          ->select('dokter.*');
                    break;
                case 'spesialis':
                    $query->orderBy('spesialis', 'asc');
                    break;
                case 'tarif_asc':
                    $query->orderBy('tarif', 'asc');
                    break;
                case 'tarif_desc':
                    $query->orderBy('tarif', 'desc');
                    break;
                default:
                    $query->orderBy('id', 'desc');
            }
        } else {
            $query->orderBy('id', 'desc');
        }

        // Ambil data dokter (pakai get() karena masih Collection)
        $dokters = $query->get();

        // Ambil list spesialis untuk filter
        $spesialisList = Dokter::where('status', 'aktif')
            ->select('spesialis')
            ->distinct()
            ->pluck('spesialis');

        return view('dokter', compact('dokters', 'spesialisList'));
    }
}