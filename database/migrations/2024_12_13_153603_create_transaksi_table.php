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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->integer('debit')->nullable();
            $table->integer('kredit')->nullable();
            $table->text('keterangan')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('rekening_id');
            $table->foreign('rekening_id')->references('id_rekening')->on('rekening');
            $table->unsignedBigInteger('detail_pembayaran_jamaah_id');
            $table->foreign('detail_pembayaran_jamaah_id')->references('id_detail_pembayaran_jamaah')->on('detail_pembayaran_jamaah')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};