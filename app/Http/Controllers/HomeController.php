<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Klinik Digital',
            'greeting' => 'Selamat Datang di',
            'clinic_name' => 'Klinik Digital Sehat',
            'description' => 'Layanan kesehatan modern dengan teknologi terkini untuk kenyamanan Anda'
        ];

        return view('index', $data);
    }
}
