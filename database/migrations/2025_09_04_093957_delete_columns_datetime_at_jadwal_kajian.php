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
        Schema::table('jadwal_kajian', function (Blueprint $table) {
            $table->dropColumn('waktu_kajian');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal_kajian', function (Blueprint $table) {
            $table->dateTime('waktu_kajian')->after('jenis_kajian_id');
        });
    }
};
