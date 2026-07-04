@extends('layouts.auth')

@section('title', 'Register - Klinik Digital')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-100 via-white to-green-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-2xl p-8 border border-gray-100">

        <div class="text-center">
            <div class="flex justify-center mb-4">
                <i class="fas fa-hospital-user text-5xl text-green-500"></i>
            </div>

            <h2 class="text-3xl font-bold text-gray-800">
                Daftar Akun Baru
            </h2>

            <p class="mt-2 text-sm text-gray-600">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-semibold">
                    Login di sini
                </a>
            </p>
        </div>

        <form class="mt-8 space-y-5" action="{{ route('register.post') }}" method="POST">
            @csrf
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Nama --}}
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">
                    Nama Lengkap
                </label>

                <input
                    id="nama"
                    name="nama"
                    type="text"
                    value="{{ old('nama') }}"
                    required
                    class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-green-500 focus:ring-green-500"
                    placeholder="Masukkan nama lengkap">
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">
                    Email
                </label>

                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    required
                    class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-green-500 focus:ring-green-500"
                    placeholder="Masukkan email">
            </div>

            {{-- Nomor HP --}}
            <div>
                <label for="nomor_hp" class="block text-sm font-medium text-gray-700">
                    Nomor HP
                </label>

                <input
                    id="nomor_hp"
                    name="nomor_hp"
                    type="text"
                    value="{{ old('nomor_hp') }}"
                    required
                    class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-green-500 focus:ring-green-500"
                    placeholder="08xxxxxxxxxx">
            </div>

            {{-- Jenis Kelamin --}}
            <div>
                <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">
                    Jenis Kelamin
                </label>

                <select
                    id="jenis_kelamin"
                    name="jenis_kelamin"
                    required
                    class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-green-500 focus:ring-green-500">

                    <option value="">-- Pilih Jenis Kelamin --</option>

                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>
                        Laki-laki
                    </option>

                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>
                        Perempuan
                    </option>
                </select>
            </div>

            {{-- Tanggal Lahir --}}
            <div>
                <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">
                    Tanggal Lahir
                </label>

                <input
                    id="tanggal_lahir"
                    name="tanggal_lahir"
                    type="date"
                    value="{{ old('tanggal_lahir') }}"
                    required
                    class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-green-500 focus:ring-green-500">
            </div>

            {{-- Alamat --}}
            <div>
                <label for="alamat" class="block text-sm font-medium text-gray-700">
                    Alamat
                </label>

                <textarea
                    id="alamat"
                    name="alamat"
                    rows="3"
                    required
                    class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-green-500 focus:ring-green-500"
                    placeholder="Masukkan alamat">{{ old('alamat') }}</textarea>
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">
                    Password
                </label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    required
                    class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-green-500 focus:ring-green-500"
                    placeholder="Minimal 6 karakter">
            </div>

            {{-- Konfirmasi Password --}}
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                    Konfirmasi Password
                </label>

                <input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    required
                    class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-green-500 focus:ring-green-500"
                    placeholder="Ulangi password">
            </div>

            {{-- Syarat --}}
            <div class="flex items-center">
                <input
                    id="terms"
                    name="terms"
                    type="checkbox"
                    required
                    class="h-4 w-4 rounded border-gray-300 text-green-600">

                <label for="terms" class="ml-2 text-sm text-gray-700">
                    Saya menyetujui syarat dan ketentuan.
                </label>
            </div>

            {{-- Tombol --}}
            <button
                type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold transition duration-300">

                <i class="fas fa-user-plus mr-2"></i>
                Daftar Sekarang
            </button>

        </form>

    </div>
</div>
@endsection