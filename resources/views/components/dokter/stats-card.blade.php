<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-blue-500">
        <p class="text-gray-500 text-sm">Konsultasi Hari Ini</p>
        <p class="text-2xl font-bold text-blue-600">{{ $stats['hari_ini'] ?? 0 }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-green-500">
        <p class="text-gray-500 text-sm">Konsultasi Bulan Ini</p>
        <p class="text-2xl font-bold text-green-600">{{ $stats['bulan_ini'] ?? 0 }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-purple-500">
        <p class="text-gray-500 text-sm">Total Pasien</p>
        <p class="text-2xl font-bold text-purple-600">{{ $stats['total_pasien'] ?? 0 }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-gray-500">
        <p class="text-gray-500 text-sm">Konsultasi Selesai</p>
        <p class="text-2xl font-bold text-gray-600">{{ $stats['selesai'] ?? 0 }}</p>
    </div>
</div>