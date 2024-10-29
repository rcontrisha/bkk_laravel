<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhotoToAlumnisAndLowonganTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alumnis', function (Blueprint $table) {
            $table->string('photo')->nullable()->after('email');
        });

        Schema::table('lowongan', function (Blueprint $table) {
            $table->string('photo')->nullable()->after('requirement');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alumnis', function (Blueprint $table) {
            $table->dropColumn('photo');
        });

        Schema::table('lowongan', function (Blueprint $table) {
            $table->dropColumn('photo');
        });
    }
}
