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
        Schema::create('pembayaran_jamaah', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->integer('jumlah_bayar');
            $table->string('status');
            $table->date('tanggal');
            $table->unsignedBigInteger('jamaah_id');
            $table->foreign('jamaah_id')->references('id_pendaftaran')->on('jamaah');
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
        Schema::dropIfExists('pembayaran_jamaah');
    }
};