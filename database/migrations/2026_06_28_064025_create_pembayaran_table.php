<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
           $table->foreignId('konsultasi_id')->constrained('konsultasi')->onDelete('cascade');
            $table->string('order_id')->unique();
            $table->string('metode')->default('qris');
            $table->bigInteger('jumlah')->default(50000);
            $table->enum('status', ['pending', 'lunas', 'gagal', 'expired'])->default('pending');
            $table->string('snap_token')->nullable();
            $table->string('payment_url')->nullable();
            $table->string('qr_code')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->json('response')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};