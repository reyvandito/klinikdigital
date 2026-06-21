@extends('layouts.dokter')

@section('title', 'Buat Rekam Medis')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-5xl mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Buat Rekam Medis</h1>
            <p class="text-gray-500">Isi form berikut untuk mencatat rekam medis pasien</p>
        </div>
        
        {{-- Kirim variable ke component --}}
        <x-dokter.form-rekam-medis :konsultasis="$konsultasis" :konsultasiTerpilih="$konsultasiTerpilih ?? null" />
    </div>
</div>
@endsection