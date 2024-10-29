<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLowonganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lowongan', function (Blueprint $table) {
            $table->id();
            $table->string('judul'); // UI/UX Designer
            $table->string('perusahaan'); // PT. UTY Yogyakarta
            $table->string('lokasi'); // Jakarta
            $table->string('kategori'); // Desain Web & Interaksi
            $table->string('tipe'); // Kontrak
            $table->decimal('gaji', 10, 2)->nullable(); // Gaji (opsional bisa nullable)
            $table->text('deskripsi')->nullable(); // Deskripsi pekerjaan
            $table->string('posted')->nullable(); // Waktu posting, misal "6 hari yang lalu"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lowongan');
    }
}
