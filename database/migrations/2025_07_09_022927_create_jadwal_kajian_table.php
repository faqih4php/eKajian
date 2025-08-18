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
        Schema::create('jadwal_kajian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_kajian_id')->constrained('request_kajian')->onDelete('cascade');
            $table->string('name');
            $table->string('tema_kajian')->nullable();
            $table->string('lokasi');
            $table->foreignId('jenis_kajian_id')->constrained('jenis_kajians')->onDelete('cascade');
            $table->dateTime('waktu_kajian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_kajian');
    }
};
