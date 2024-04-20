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
        Schema::create('pegawai_posyandus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->enum('jabatan', ['Kepala', 'Sekretaris', 'Kader',]);
            $table->string('nama');
            $table->string('no_telpon');
            $table->string('alamat');
            $table->timestamps();


            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai_posyandus');
    }
};
