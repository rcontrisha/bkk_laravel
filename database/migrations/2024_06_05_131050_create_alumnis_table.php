<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('alumnis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nisn')->unique();
            $table->string('nama_siswa');
            $table->string('jenis_kelamin');
            $table->string('jurusan');
            $table->year('tahun_kelulusan');
            $table->string('sasaran');
            $table->string('tempat_sasaran')->nullable();
            $table->string('nomor_telepon');
            $table->string('email')->unique();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnis');
    }
};
