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
        Schema::create('detail_pembayaran_jamaah', function (Blueprint $table) {
            $table->id('id_detail_pembayaran_jamaah');
            $table->integer('jumlah');
            $table->date('tanggal');
            $table->unsignedBigInteger('pembayaran_id');
            $table->foreign('pembayaran_id')->references('id_pembayaran')->on('pembayaran_jamaah');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pembayaran_jamaah');
    }
};