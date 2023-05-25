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
        Schema::create('data_penganggurs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kota');
            $table->string('tahun_2020');
            $table->string('tahun_2021');
            $table->string('tahun_2022');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_penganggurs');
    }
};
