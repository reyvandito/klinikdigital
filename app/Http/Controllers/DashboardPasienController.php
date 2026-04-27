<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardPasienController extends Controller
{
    public function index()
    {
        return view('pages.pasien.dashboard');
    }
}
