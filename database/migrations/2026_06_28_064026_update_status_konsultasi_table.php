<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('konsultasi', function (Blueprint $table) {
            // Hapus enum lama
            $table->dropColumn('status');
        });

        Schema::table('konsultasi', function (Blueprint $table) {
            // Buat enum baru dengan nilai tambahan
            $table->enum('status', [
                'menunggu_pembayaran',
                'menunggu',
                'dikonfirmasi',
                'berlangsung',
                'selesai',
                'dibatalkan'
            ])->default('menunggu_pembayaran')->after('keluhan');
        });
    }

    public function down(): void
    {
        Schema::table('konsultasi', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('konsultasi', function (Blueprint $table) {
            $table->enum('status', [
                'menunggu',
                'dikonfirmasi',
                'berlangsung',
                'selesai',
                'dibatalkan'
            ])->default('menunggu')->after('keluhan');
        });
    }
};