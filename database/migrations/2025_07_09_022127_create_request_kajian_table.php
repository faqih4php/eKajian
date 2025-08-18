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
        Schema::create('request_kajian', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tema_kajian')->nullable();
            $table->string('lokasi');
            $table->string('nomer');
            $table->foreignId('jabatan_id')->constrained('jabatans')->onDelete('cascade');
            $table->foreignId('jenis_kajian_id')->constrained('jenis_kajians')->onDelete('cascade');
            $table->dateTime('waktu_kajian');
            $table->enum('status', ['Menunggu', 'Diterima', 'Ditolak']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_kajian');
    }
};
