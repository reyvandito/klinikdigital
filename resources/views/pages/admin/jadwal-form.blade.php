@extends('layouts.admin')

@section('title', isset($jadwal) ? 'Edit Jadwal' : 'Tambah Jadwal')

@section('content')
<div class="p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">
            {{ isset($jadwal) ? 'Edit Jadwal Konsultasi' : 'Tambah Jadwal Konsultasi' }}
        </h1>

        <a href="{{ route('admin.jadwal.index') }}"
           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
            Kembali
        </a>
    </div>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white shadow rounded p-6">
        <form method="POST"
              action="{{ isset($jadwal)
                    ? route('admin.jadwal.update', $jadwal->id)
                    : route('admin.jadwal.store') }}">

            @csrf

            @if(isset($jadwal))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label>Dokter</label>
                <select name="dokter_id"
                        class="w-full border rounded px-3 py-2"
                        required>

                    <option value="">Pilih Dokter</option>

                    @foreach($dokters as $dokter)
                        <option value="{{ $dokter->id }}"
                            {{ old('dokter_id', $jadwal->dokter_id ?? '') == $dokter->id ? 'selected' : '' }}>
                            {{ $dokter->user->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label>Tanggal</label>
                <input type="date"
                       name="tanggal"
                       value="{{ old('tanggal', $jadwal->tanggal ?? '') }}"
                       class="w-full border rounded px-3 py-2"
                       required>
            </div>

            <div class="mb-4">
                <label>Jam Mulai</label>
                <input type="time"
                       name="jam_mulai"
                       value="{{ old('jam_mulai', $jadwal->jam_mulai ?? '') }}"
                       class="w-full border rounded px-3 py-2"
                       required>
            </div>

            <div class="mb-4">
                <label>Jam Selesai</label>
                <input type="time"
                       name="jam_selesai"
                       value="{{ old('jam_selesai', $jadwal->jam_selesai ?? '') }}"
                       class="w-full border rounded px-3 py-2"
                       required>
            </div>

            <div class="mb-4">
                <label>Kuota</label>
                <input type="number"
                       name="kuota"
                       value="{{ old('kuota', $jadwal->kuota ?? '') }}"
                       class="w-full border rounded px-3 py-2"
                       required>
            </div>

            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">

                {{ isset($jadwal)
                    ? 'Simpan Perubahan'
                    : 'Tambah Jadwal' }}

            </button>

        </form>
    </div>
</div>
@endsection