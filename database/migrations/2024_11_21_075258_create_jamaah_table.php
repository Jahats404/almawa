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
        Schema::create('jamaah', function (Blueprint $table) {
            $table->string('ktp')->primary();
            $table->string('nama_lengkap');
            $table->string('nama_ayah_kandung');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('umur');
            
            $table->string('tinggi')->nullable();
            $table->string('berat')->nullable();
            $table->string('muka')->nullable();
            $table->string('hidung')->nullable();
            $table->string('alis')->nullable();
            $table->string('rambut')->nullable();

            $table->string('penyakit');
            $table->enum('rokok', ['iya', 'Tidak']);
            
            $table->enum('kewarganegaraan', ['WNI', 'WNA']);
            
            
            $table->string('nama_jalan');
            $table->string('desa');
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->string('provinsi');
            $table->string('kode_pos');
            $table->string('no_telp');

            $table->string('email')->nullable();
            $table->string('pendidikan_terahir')->nullable();
            
            
            $table->string('pekerjaan')->nullable();
            $table->string('nama_perusahaan')->nullable();
            $table->string('alamat_perusahaan')->nullable();
            $table->string('no_telp_perusahaan')->nullable();
            
            // data keberangkatan
            $table->unsignedBigInteger('rencana_keberangkatan');
            $table->foreign('rencana_keberangkatan')->references('id_jadwal')->on('jadwal')->onDelete('cascade');
            // $table->string('pesawat');
            // $table->string('makkah');
            // $table->string('madinah');
            // $table->string('nama_hotel');
            $table->string('pengalaman_umroh');
            $table->string('terahir_tahun')->nullable();
            $table->string('paket_umroh');
            $table->string('program');

            // data keluarga
            $table->string('nama_keluarga_ikut')->nullable();
            $table->string('hubungan_keluarga_ikut')->nullable();
            $table->string('no_telp_keluarga_ikut')->nullable();
            $table->string('alamat_keluarga_ikut')->nullable();

            $table->string('nama_keluarga_tinggal');
            $table->string('hubungan_keluarga_tinggal');
            $table->string('no_telp_keluarga_tinggal');
            $table->string('alamat_keluarga_tinggal');
            
            $table->string('status')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('supervisor_id')->nullable();
            $table->foreign('supervisor_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jamaah');
    }
};