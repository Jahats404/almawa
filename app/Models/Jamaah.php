<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jamaah extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pendaftaran';
    protected $table = 'jamaah';
    protected $guarded = [];


    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'rencana_keberangkatan', 'id_jadwal');
    }
    public function paket()
    {
        return $this->belongsTo(Paket::class, 'paket_id', 'id_paket');
    }
    public function pembayaran_jamaah()
    {
        return $this->hasOne(PembayaranJamaah::class, 'jamaah_id', 'id_pendaftaran');
    }
    public function progress()
    {
        return $this->hasOne(Progress::class,'jamaah_id','id_pendaftaran');
    }




    public static $messages = [
        // Identitas Personal
    'ktp.required' => 'Nomor KTP wajib diisi.',
    'ktp.string' => 'Nomor KTP harus berupa teks.',
    'ktp.max' => 'Nomor KTP tidak boleh lebih dari 255 karakter.',
    'ktp.unique' => 'Nomor KTP sudah terdaftar.',
    
    'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
    'nama_lengkap.string' => 'Nama lengkap harus berupa teks.',
    'nama_lengkap.max' => 'Nama lengkap tidak boleh lebih dari 255 karakter.',
    
    'nama_ayah_kandung.required' => 'Nama ayah kandung wajib diisi.',
    'nama_ayah_kandung.string' => 'Nama ayah kandung harus berupa teks.',
    'nama_ayah_kandung.max' => 'Nama ayah kandung tidak boleh lebih dari 255 karakter.',
    
    'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
    'tempat_lahir.string' => 'Tempat lahir harus berupa teks.',
    'tempat_lahir.max' => 'Tempat lahir tidak boleh lebih dari 255 karakter.',
    
    'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
    'tanggal_lahir.date' => 'Tanggal lahir harus berupa tanggal yang valid.',
    
    'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
    'jenis_kelamin.in' => 'Jenis kelamin harus berupa Laki-laki atau Perempuan.',
    
    'umur.required' => 'Umur wajib diisi.',
    'umur.integer' => 'Umur harus berupa angka.',
    'umur.min' => 'Umur tidak boleh kurang dari 0.',

    // Data Fisik (Nullable)
    'tinggi.string' => 'Tinggi harus berupa teks.',
    'tinggi.max' => 'Tinggi tidak boleh lebih dari 255 karakter.',
    
    'berat.string' => 'Berat harus berupa teks.',
    'berat.max' => 'Berat tidak boleh lebih dari 255 karakter.',
    
    'muka.string' => 'Deskripsi muka harus berupa teks.',
    'muka.max' => 'Deskripsi muka tidak boleh lebih dari 255 karakter.',
    
    'hidung.string' => 'Deskripsi hidung harus berupa teks.',
    'hidung.max' => 'Deskripsi hidung tidak boleh lebih dari 255 karakter.',
    
    'alis.string' => 'Deskripsi alis harus berupa teks.',
    'alis.max' => 'Deskripsi alis tidak boleh lebih dari 255 karakter.',
    
    'rambut.string' => 'Deskripsi rambut harus berupa teks.',
    'rambut.max' => 'Deskripsi rambut tidak boleh lebih dari 255 karakter.',

    // Kesehatan
    'penyakit.required' => 'Penyakit wajib diisi.',
    'penyakit.string' => 'Penyakit harus berupa teks.',
    'penyakit.max' => 'Penyakit tidak boleh lebih dari 255 karakter.',
    
    'rokok.required' => 'Status merokok wajib diisi.',
    'rokok.boolean' => 'Status merokok harus berupa benar atau salah (boolean).',

    // Kewarganegaraan
    'kewarganegaraan.required' => 'Kewarganegaraan wajib diisi.',
    'kewarganegaraan.in' => 'Kewarganegaraan harus berupa WNI atau WNA.',

    // Alamat
    'nama_jalan.required' => 'Nama jalan wajib diisi.',
    'nama_jalan.string' => 'Nama jalan harus berupa teks.',
    'nama_jalan.max' => 'Nama jalan tidak boleh lebih dari 255 karakter.',

    'desa.required' => 'Desa wajib diisi.',
    'desa.string' => 'Desa harus berupa teks.',
    'desa.max' => 'Desa tidak boleh lebih dari 255 karakter.',

    'kecamatan.required' => 'Kecamatan wajib diisi.',
    'kecamatan.string' => 'Kecamatan harus berupa teks.',
    'kecamatan.max' => 'Kecamatan tidak boleh lebih dari 255 karakter.',

    'kabupaten.required' => 'Kabupaten wajib diisi.',
    'kabupaten.string' => 'Kabupaten harus berupa teks.',
    'kabupaten.max' => 'Kabupaten tidak boleh lebih dari 255 karakter.',

    'provinsi.required' => 'Provinsi wajib diisi.',
    'provinsi.string' => 'Provinsi harus berupa teks.',
    'provinsi.max' => 'Provinsi tidak boleh lebih dari 255 karakter.',

    'kode_pos.required' => 'Kode pos wajib diisi.',
    'kode_pos.string' => 'Kode pos harus berupa teks.',
    'kode_pos.max' => 'Kode pos tidak boleh lebih dari 10 karakter.',

    'no_telp.required' => 'Nomor telepon wajib diisi.',
    'no_telp.string' => 'Nomor telepon harus berupa teks.',
    'no_telp.max' => 'Nomor telepon tidak boleh lebih dari 15 karakter.',

    // Kontak
    'email.email' => 'Email harus berupa email yang valid.',
    'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
    
    'pendidikan_terahir.string' => 'Pendidikan terakhir harus berupa teks.',
    'pendidikan_terahir.max' => 'Pendidikan terakhir tidak boleh lebih dari 255 karakter.',

    // Pekerjaan
    'pekerjaan.string' => 'Pekerjaan harus berupa teks.',
    'pekerjaan.max' => 'Pekerjaan tidak boleh lebih dari 255 karakter.',

    'nama_perusahaan.string' => 'Nama perusahaan harus berupa teks.',
    'nama_perusahaan.max' => 'Nama perusahaan tidak boleh lebih dari 255 karakter.',

    'alamat_perusahaan.string' => 'Alamat perusahaan harus berupa teks.',
    'alamat_perusahaan.max' => 'Alamat perusahaan tidak boleh lebih dari 255 karakter.',

    'no_telp_perusahaan.string' => 'Nomor telepon perusahaan harus berupa teks.',
    'no_telp_perusahaan.max' => 'Nomor telepon perusahaan tidak boleh lebih dari 15 karakter.',

    // Data Keberangkatan
    'paket_id.required' => 'Paket wajib diisi.',
    'paket_id.exists' => 'Paket yang dipilih tidak valid atau tidak ditemukan.',
    'paspor.required' => 'Paspor wajib diisi.',
    'rencana_keberangkatan.required' => 'Rencana keberangkatan wajib diisi.',
    'rencana_keberangkatan.date' => 'Rencana keberangkatan harus berupa tanggal yang valid.',
    'rencana_keberangkatan.exists' => 'Rencana keberangkatan yang dipilih tidak valid atau tidak ditemukan.',

    'pesawat.required' => 'Nama pesawat wajib diisi.',
    'pesawat.string' => 'Nama pesawat harus berupa teks.',
    'pesawat.max' => 'Nama pesawat tidak boleh lebih dari 255 karakter.',

    'nama_hotel.required' => 'Nama hotel wajib diisi.',
    'nama_hotel.string' => 'Nama hotel harus berupa teks.',
    'nama_hotel.max' => 'Nama hotel tidak boleh lebih dari 255 karakter.',

    'pengalaman_umroh.required' => 'Pengalaman umroh wajib diisi.',
    'pengalaman_umroh.string' => 'Pengalaman umroh harus berupa teks.',
    'pengalaman_umroh.max' => 'Pengalaman umroh tidak boleh lebih dari 255 karakter.',

    'terahir_tahun.required' => 'Tahun terakhir umroh wajib diisi.',
    'terahir_tahun.string' => 'Tahun terakhir umroh harus berupa teks.',
    'terahir_tahun.max' => 'Tahun terakhir umroh tidak boleh lebih dari 4 karakter.',

    'paket_umroh.required' => 'Paket umroh wajib diisi.',
    'paket_umroh.string' => 'Paket umroh harus berupa teks.',
    'paket_umroh.max' => 'Paket umroh tidak boleh lebih dari 255 karakter.',

    'program.required' => 'Program umroh wajib diisi.',
    'program.string' => 'Program umroh harus berupa teks.',
    'program.max' => 'Program umroh tidak boleh lebih dari 255 karakter.',

    // Data Keluarga
    'nama_keluarga_ikut.string' => 'Nama keluarga yang ikut harus berupa teks.',
    'nama_keluarga_ikut.max' => 'Nama keluarga yang ikut tidak boleh lebih dari 255 karakter.',

    'hubungan_keluarga_ikut.string' => 'Hubungan keluarga yang ikut harus berupa teks.',
    'hubungan_keluarga_ikut.max' => 'Hubungan keluarga yang ikut tidak boleh lebih dari 255 karakter.',

    'no_telp_keluarga_ikut.string' => 'Nomor telepon keluarga yang ikut harus berupa teks.',
    'no_telp_keluarga_ikut.max' => 'Nomor telepon keluarga yang ikut tidak boleh lebih dari 15 karakter.',

    'alamat_keluarga_ikut.string' => 'Alamat keluarga yang ikut harus berupa teks.',
    'alamat_keluarga_ikut.max' => 'Alamat keluarga yang ikut tidak boleh lebih dari 255 karakter.',

    'nama_keluarga_tinggal.required' => 'Nama keluarga yang ditinggal wajib diisi.',
    'nama_keluarga_tinggal.string' => 'Nama keluarga yang ditinggal harus berupa teks.',
    'nama_keluarga_tinggal.max' => 'Nama keluarga yang ditinggal tidak boleh lebih dari 255 karakter.',

    'hubungan_keluarga_tinggal.required' => 'Hubungan keluarga yang ditinggal wajib diisi.',
    'hubungan_keluarga_tinggal.string' => 'Hubungan keluarga yang ditinggal harus berupa teks.',
    'hubungan_keluarga_tinggal.max' => 'Hubungan keluarga yang ditinggal tidak boleh lebih dari 255 karakter.',

    'no_telp_keluarga_tinggal.required' => 'Nomor telepon keluarga yang ditinggal wajib diisi.',
    'no_telp_keluarga_tinggal.string' => 'Nomor telepon keluarga yang ditinggal harus berupa teks.',
    'no_telp_keluarga_tinggal.max' => 'Nomor telepon keluarga yang ditinggal tidak boleh lebih dari 15 karakter.',

    'alamat_keluarga_tinggal.required' => 'Alamat keluarga yang ditinggal wajib diisi.',
    'alamat_keluarga_tinggal.string' => 'Alamat keluarga yang ditinggal harus berupa teks.',
    'alamat_keluarga_tinggal.max' => 'Alamat keluarga yang ditinggal tidak boleh lebih dari 255 karakter.',

    // Status
    'status.string' => 'Status harus berupa teks.',
    'status.max' => 'Status tidak boleh lebih dari 255 karakter.',

    // Relasi
    'user_id.required' => 'User ID wajib diisi.',
    'user_id.exists' => 'User ID tidak valid.',

    'supervisor_id.exists' => 'Supervisor ID tidak valid.',
    ];
}