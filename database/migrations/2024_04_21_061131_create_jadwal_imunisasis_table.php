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
        Schema::create('jadwal_imunisasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('posyandus_id')->constrained('posyandus')->onDelete('cascade');
            $table->string('usia',50);
            $table->date('tanggal');
            $table->string('jenis_imunisasi',50);
            $table->longText('deskripsi');
            $table->string('penanggung_jawab', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_imunisasis');
    }
};
