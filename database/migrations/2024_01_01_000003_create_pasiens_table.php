<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pasien', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('tanggal_lahir')->nullable(); // nullable agar register tidak wajib isi
            $table->text('alamat')->nullable();        // nullable agar register tidak wajib isi
            $table->timestamps();
        });
    }
 
    public function down(): void
    {
        Schema::dropIfExists('pasien');
    }
};
 