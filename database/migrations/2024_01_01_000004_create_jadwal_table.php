<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dokter_id')->constrained('dokter')->onDelete('cascade');
            $table->date('tanggal');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->integer('kuota')->default(10);
            $table->integer('sisa_kuota')->default(10);  // ← PENTING: dipakai di ReservasiController
            $table->enum('status', ['tersedia', 'penuh', 'tutup'])->default('tersedia'); // ← PENTING
            $table->timestamps();
        });
    }
 
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};