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
            $table->integer('sisa_tagihan');
            $table->date('tanggal');
            $table->string('status');
            $table->string('bukti_pembayaran');
            
            // Foreign key pembayaran_id
            $table->unsignedBigInteger('pembayaran_id');
            $table->foreign('pembayaran_id')
                ->references('id_pembayaran')
                ->on('pembayaran_jamaah')
                ->onDelete('cascade'); // Tambahkan jika diperlukan
            
            // Foreign key user_id
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade'); // Tambahkan jika diperlukan
            
            // Foreign key validator_id
            $table->unsignedBigInteger('validator_id')->nullable();
            $table->foreign('validator_id')
                ->references('id')  
                ->on('users')
                ->onDelete('set null'); // Null jika validator dihapus
            
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