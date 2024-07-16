<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('riwayat_imunisasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('posyandus_id')->constrained('posyandus')->onDelete('cascade');
            $table->foreignId('balita_id')->constrained('balitas');
            $table->json('data_imunisasi');
            $table->string('jenis_imunisasi', 50);
            $table->date('tanggal');
            $table->longText('catatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_imunisasis');
    }
};
