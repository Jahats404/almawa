<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Validasi extends Model
{
    use HasFactory;

    public static $rules = [
        'no_registrasi'       => 'required|numeric|unique:agen,no_registrasi',
        'ktp'                 => 'required|string|size:16|unique:agen,ktp',
        'nama_lengkap'        => 'required|string|max:255',
        'nama_ayah_kandung'   => 'required|string|max:255',
        'tempat_lahir'        => 'required|string|max:255',
        'tanggal_lahir'       => 'required|date',
        'jenis_kelamin'       => 'required|in:Pria,Wanita',
        'umur'                => 'required|numeric|min:0|max:150',
        'alamat'              => 'required|string|max:500',
        'desa'                => 'required|string|max:255',
        'kecamatan'           => 'required|string|max:255',
        'kabupaten'           => 'required|string|max:255',
        'provinsi'            => 'required|string|max:255',
        'no_telp'             => 'required|string|max:15|regex:/^[0-9]+$/',
        'file_ktp'            => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        'file_pembayaran'     => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        'pekerjaan'           => 'required',
        'pekerjaan_lainnya'   => 'required_if:pekerjaan,Lainnya|string|max:255',
        'nama_perusahaan'     => 'nullable|string|max:255',
        'bidang_perusahaan'   => 'nullable|string|max:255',
        'alamat_perusahaan'   => 'nullable|string|max:500',
        'no_telp_perusahaan'  => 'nullable|string|max:15|regex:/^[0-9]+$/',
        'jabatan'             => 'nullable|string|max:255',
    ];
    
    public static $messages = [
        'no_registrasi.required' => 'Nomor registrasi wajib diisi.',
        'no_registrasi.numeric' => 'Nomor registrasi harus berupa angka.',
        'no_registrasi.unique' => 'Nomor registrasi sudah terdaftar.',
    
        'ktp.required' => 'Nomor KTP wajib diisi.',
        'ktp.string' => 'Nomor KTP harus berupa teks.',
        'ktp.size' => 'Nomor KTP harus terdiri dari 16 karakter.',
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
        'jenis_kelamin.in' => 'Jenis kelamin harus berupa Pria atau Wanita.',
    
        'umur.required' => 'Umur wajib diisi.',
        'umur.numeric' => 'Umur harus berupa angka.',
        'umur.min' => 'Umur tidak boleh kurang dari 0 tahun.',
        'umur.max' => 'Umur tidak boleh lebih dari 150 tahun.',
    
        'alamat.required' => 'Alamat wajib diisi.',
        'alamat.string' => 'Alamat harus berupa teks.',
        'alamat.max' => 'Alamat tidak boleh lebih dari 500 karakter.',
    
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
    
        'no_telp.required' => 'Nomor telepon wajib diisi.',
        'no_telp.string' => 'Nomor telepon harus berupa teks.',
        'no_telp.max' => 'Nomor telepon tidak boleh lebih dari 15 karakter.',
        'no_telp.regex' => 'Nomor telepon hanya boleh berisi angka.',
    
        'file_ktp.file' => 'File KTP harus berupa file yang valid.',
        'file_ktp.mimes' => 'File KTP harus berupa file dengan format: jpg, jpeg, png, atau pdf.',
        'file_ktp.max' => 'Ukuran file KTP tidak boleh lebih dari 2MB.',
    
        'file_pembayaran.file' => 'File pembayaran harus berupa file yang valid.',
        'file_pembayaran.mimes' => 'File pembayaran harus berupa file dengan format: jpg, jpeg, png, atau pdf.',
        'file_pembayaran.max' => 'Ukuran file pembayaran tidak boleh lebih dari 2MB.',
        
        'pekerjaan.required' => 'Pekerjaan wajib dipilih.',
        'pekerjaan_lainnya.required' => 'Pekerjaan lainnya wajib diisi jika Anda memilih "Lainnya".',
        'pekerjaan_lainnya.string' => 'Pekerjaan lainnya harus berupa teks.',
        'pekerjaan_lainnya.max' => 'Pekerjaan lainnya tidak boleh lebih dari 255 karakter.',
        
        'nama_perusahaan.string' => 'Nama perusahaan harus berupa teks.',
        'nama_perusahaan.max' => 'Nama perusahaan tidak boleh lebih dari 255 karakter.',
    
        'bidang_perusahaan.string' => 'Bidang perusahaan harus berupa teks.',
        'bidang_perusahaan.max' => 'Bidang perusahaan tidak boleh lebih dari 255 karakter.',
    
        'alamat_perusahaan.string' => 'Alamat perusahaan harus berupa teks.',
        'alamat_perusahaan.max' => 'Alamat perusahaan tidak boleh lebih dari 500 karakter.',
    
        'no_telp_perusahaan.string' => 'Nomor telepon perusahaan harus berupa teks.',
        'no_telp_perusahaan.max' => 'Nomor telepon perusahaan tidak boleh lebih dari 15 karakter.',
        'no_telp_perusahaan.regex' => 'Nomor telepon perusahaan hanya boleh berisi angka.',
    
        'jabatan.string' => 'Jabatan harus berupa teks.',
        'jabatan.max' => 'Jabatan tidak boleh lebih dari 255 karakter.',
    ];

    
}