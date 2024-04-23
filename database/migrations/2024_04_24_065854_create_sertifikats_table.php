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
        Schema::create('sertifikats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('balita_id')->nullable();
            $table->string('nik', 17);
            $table->string('nomor', 30);
            $table->string('nama_balita', 50);
            $table->string('tempat_lahir', 50);
            $table->date('tgl_lahir');
            $table->enum('jenkel', ['Laki-Laki','Perempuan']);
            //
            $table->string('nama_orang_tua', 50);
            $table->string('alamat_orang_tua', 100);
            $table->string('no_telpon_orang_tua', 20);
            // File PDF
            $table->string('file', 100);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sertifikats');
    }
};
