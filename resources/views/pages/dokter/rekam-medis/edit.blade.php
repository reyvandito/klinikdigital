@extends('layouts.dokter')

@section('title', 'Edit Rekam Medis')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-5xl mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Edit Rekam Medis</h1>
            <p class="text-gray-500">Edit data rekam medis pasien</p>
        </div>
        
        <x-dokter.form-edit-rekam-medis :rekamMedis="$rekamMedis" />
    </div>
</div>
@endsection