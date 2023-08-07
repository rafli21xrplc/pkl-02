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
        Schema::create('absens', function (Blueprint $table) {
            $table->id('id');
            $table->string('code', 100)->unique();
            $table->string('name', 100);
            // $table->foreignId('mahasiswa_id')->references('id')->on('mahasiswas')->onDelete('restrict');
            $table->foreignId('jadwal_id')->references('id')->on('jadwals')->onDelete('restrict');
            $table->date('date');
            $table->enum('status', ['Hadir', 'Izin', 'Alpha']);
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absens');
    }
};
