<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekam Medis</title>
    <style>
        body {
            font-family: 'DejaVu Sans', 'Arial', sans-serif;
            font-size: 12px;
            padding: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            border-bottom: 3px solid #2563eb;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 22px;
            font-weight: bold;
            color: #1e3a8a;
            margin: 0;
        }
        .header p {
            font-size: 12px;
            color: #666;
            margin: 5px 0 0;
        }
        .info-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .info-item {
            display: flex;
            flex-direction: column;
        }
        .info-item .label {
            font-size: 10px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .info-item .value {
            font-size: 13px;
            font-weight: 500;
            color: #1a1a1a;
        }
        .rekam-section {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
        }
        .rekam-section .title {
            font-size: 14px;
            font-weight: bold;
            color: #1e3a8a;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 8px;
            margin-bottom: 10px;
        }
        .rekam-section .content {
            font-size: 13px;
            line-height: 1.6;
            color: #333;
        }
        .rekam-section .content p {
            margin: 5px 0;
        }
        .footer {
            text-align: center;
            font-size: 10px;
            color: #888;
            border-top: 1px solid #ddd;
            padding-top: 15px;
            margin-top: 20px;
        }
        .badge {
            display: inline-block;
            padding: 2px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
        }
        .badge-selesai { background: #d1fae5; color: #065f46; }
        .badge-dibatalkan { background: #fee2e2; color: #991b1b; }
        .badge-berlangsung { background: #dbeafe; color: #1e40af; }
        .badge-menunggu { background: #fef3c7; color: #92400e; }
        .badge-dikonfirmasi { background: #e0e7ff; color: #3730a3; }
        .badge-menunggu_pembayaran { background: #fce7f3; color: #9d174d; }
    </style>
</head>
<body>

    {{-- Header --}}
    <div class="header">
        <h1>Rekam Medis</h1>
        <p>Klinik Digital - Layanan Kesehatan Polibatam</p>
        <p style="font-size: 10px; color: #999;">Dicetak: {{ $tanggal_cetak }}</p>
    </div>

    {{-- Informasi Pasien & Dokter --}}
    <div class="info-section">
        <div class="info-item">
            <span class="label">Nama Pasien</span>
            <span class="value">{{ $pasien->user->nama ?? '-' }}</span>
        </div>
        <div class="info-item">
            <span class="label">Usia</span>
            <span class="value">{{ $pasien->usia ?? '-' }} tahun</span>
        </div>
        <div class="info-item">
            <span class="label">Jenis Kelamin</span>
            <span class="value">{{ $pasien->user->jenis_kelamin ?? '-' }}</span>
        </div>
        <div class="info-item">
            <span class="label">Nomor HP</span>
            <span class="value">{{ $pasien->user->nomor_hp ?? '-' }}</span>
        </div>
        <div class="info-item">
            <span class="label">Dokter</span>
            <span class="value">{{ $dokter->user->nama ?? '-' }}</span>
        </div>
        <div class="info-item">
            <span class="label">Spesialis</span>
            <span class="value">{{ $dokter->spesialis ?? '-' }}</span>
        </div>
        <div class="info-item">
            <span class="label">Tanggal Konsultasi</span>
            <span class="value">{{ $jadwal ? \Carbon\Carbon::parse($jadwal->tanggal)->format('d/m/Y') : '-' }}</span>
        </div>
        <div class="info-item">
            <span class="label">Jam Konsultasi</span>
            <span class="value">{{ $jadwal ? $jadwal->jam_mulai . ' - ' . $jadwal->jam_selesai : '-' }}</span>
        </div>
        <div class="info-item" style="grid-column: span 2;">
            <span class="label">Status Konsultasi</span>
            <span class="badge badge-{{ $konsultasi->status }}">
                {{ strtoupper(str_replace('_', ' ', $konsultasi->status)) }}
            </span>
        </div>
    </div>

    {{-- Keluhan --}}
    <div class="rekam-section">
        <div class="title">Keluhan Pasien</div>
        <div class="content">
            <p>{{ $konsultasi->keluhan ?? '-' }}</p>
        </div>
    </div>

    {{-- Rekam Medis --}}
    <div class="rekam-section">
        <div class="title">Hasil Pemeriksaan</div>
        <div class="content">
            <p><strong>Diagnosa:</strong><br>{{ $rekamMedis->diagnosa ?? '-' }}</p>
            @if($rekamMedis->tindakan)
                <p><strong>Tindakan:</strong><br>{{ $rekamMedis->tindakan }}</p>
            @endif
            @if($rekamMedis->resep)
                <p><strong>Resep Obat:</strong><br>{{ $rekamMedis->resep }}</p>
            @endif
            @if($rekamMedis->catatan)
                <p><strong>Catatan Dokter:</strong><br>{{ $rekamMedis->catatan }}</p>
            @endif
        </div>
    </div>

    {{-- Footer --}}
    <div class="footer">
        <p>Dokumen ini adalah bukti rekam medis resmi dari Klinik Digital.</p>
        <p>© {{ date('Y') }} Klinik Digital. All rights reserved.</p>
    </div>

</body>
</html>