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
        Schema::create('balitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('org_tua_id')->unsigned();
            $table->foreign('org_tua_id')->references('id')->on('orang_tuas');
            $table->string('nik', 16);
            $table->string('nama', 50);
            $table->string('tempat_lahir', 50);
            $table->date('tgl_lahir');
            $table->enum('jenkel', ['Laki-Laki','Perempuan']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balitas');
    }
};
