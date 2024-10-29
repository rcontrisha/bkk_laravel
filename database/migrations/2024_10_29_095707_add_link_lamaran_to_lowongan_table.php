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
    Schema::table('lowongan', function (Blueprint $table) {
        $table->string('link_lamaran')->nullable()->after('photo'); // Adds link_lamaran field after photo
    });
}

public function down()
{
    Schema::table('lowongan', function (Blueprint $table) {
        $table->dropColumn('link_lamaran'); // Removes link_lamaran field if the migration is rolled back
    });
}

};
