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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id('id');
            $table->string('code', 100)->unique();
            $table->string('npm')->unique();
            $table->string('name');
            $table->date('birth_date');
            $table->integer('semester');
            $table->string('image')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
