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
        Schema::create('perjanjian', function (Blueprint $table) {
            $table->id('id_perjanjian');
            $table->string('ttd')->nullable();
            $table->string('perjanjian')->nullable();
            $table->unsignedBigInteger('agen_id');
            $table->foreign('agen_id')->references('no_registrasi')->on('agen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perjanjian');
    }
};