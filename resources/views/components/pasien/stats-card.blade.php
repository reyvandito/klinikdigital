@props(['stats' => []])

<div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-8">
    <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-blue-500">
        <p class="text-gray-500 text-sm">Total Konsultasi</p>
        <p class="text-2xl font-bold text-blue-600">{{ $stats['total_konsultasi'] ?? 0 }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-blue-500">
        <p class="text-gray-500 text-sm">Konsultasi Aktif</p>
        <p class="text-2xl font-bold text-blue-600">{{ $stats['konsultasi_aktif'] ?? 0 }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-blue-500">
        <p class="text-gray-500 text-sm">Total Rekam Medis</p>
        <p class="text-2xl font-bold text-blue-600">{{ $stats['total_rekam_medis'] ?? 0 }}</p>
    </div>
</div>