<?php

namespace App\Http\Controllers\pengguna;

use App\Http\Controllers\Controller;
use App\Models\Agen;
use App\Models\User;
use App\Models\Validasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AgenController extends Controller
{
    public function lengkapi_data()
    {
        $user = User::find(Auth::user()->id);
        
        return view('agen.data-diri', compact('user'));
    }
    
    public function action_lengkapi_data(Request $request)
    {
        // Validasi data input
        $rules = [
            // 'no_registrasi'       => 'required|numeric|unique:agen,no_registrasi',
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
            'file_ktp'            => 'required|mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'file_pembayaran'     => 'required|mimes:jpg,jpeg,png,gif,pdf|max:2048',
            'pekerjaan'           => 'required',
            'pekerjaan_lainnya'   => 'required_if:pekerjaan,Lainnya|string|max:255',
            'nama_perusahaan'     => 'nullable|string|max:255',
            'bidang_perusahaan'   => 'nullable|string|max:255',
            'alamat_perusahaan'   => 'nullable|string|max:500',
            'no_telp_perusahaan'  => 'nullable|string|max:15|regex:/^[0-9]+$/',
            'jabatan'             => 'nullable|string|max:255',
        ];
        // Jika "Lainnya" dipilih, validasi pekerjaan diganti dengan pekerjaan_lainnya
        if ($request->pekerjaan === 'Lainnya') {
            $rules['pekerjaan'] = 'nullable'; // Hilangkan validasi untuk pekerjaan
            $rules['pekerjaan_lainnya'] = 'required|string|max:255'; // Tambahkan validasi untuk pekerjaan_lainnya
        } else {
            $rules['pekerjaan_lainnya'] = 'nullable'; // Hilangkan validasi jika pekerjaan bukan "Lainnya"
        }
        $validator = Validator::make($request->all(), $rules, Validasi::$messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Membuat agen baru
        $agen = new Agen();
        $agen->no_registrasi = str_pad(rand(1, 9999999), 7, '0', STR_PAD_LEFT); // 7 digit angka
        $agen->ktp = $request->ktp;
        $agen->nama_lengkap = $request->nama_lengkap;
        $agen->nama_ayah_kandung = $request->nama_ayah_kandung;
        $agen->tempat_lahir = $request->tempat_lahir;
        $agen->tanggal_lahir = $request->tanggal_lahir;
        $agen->jenis_kelamin = $request->jenis_kelamin;
        $agen->umur = $request->umur;
        $agen->alamat = $request->alamat;
        $agen->desa = $request->desa;
        $agen->kecamatan = $request->kecamatan;
        $agen->kabupaten = $request->kabupaten;
        $agen->provinsi = $request->provinsi;
        $agen->no_telp = $request->no_telp;
        $agen->status = 'Diajukan';
        $agen->user_id = Auth::user()->id; // Menghubungkan agen ke user yang baru dibuat

        // Upload file KTP jika ada
        if ($request->hasFile('file_ktp')) {
            $file = $request->file('file_ktp');
            $agen->file_ktp = $file->store('ktp', 'public');
        }

        // Upload file pembayaran jika ada
        if ($request->hasFile('file_pembayaran')) {
            $file = $request->file('file_pembayaran');
            $agen->file_pembayaran = $file->store('pembayaran', 'public');
        }

        // Menyimpan pekerjaan
        $agen->pekerjaan = $request->pekerjaan === 'Lainnya' ? $request->pekerjaan_lainnya : $request->pekerjaan;

        // Menyimpan informasi tambahan terkait perusahaan
        $agen->nama_perusahaan = $request->nama_perusahaan;
        $agen->bidang_perusahaan = $request->bidang_perusahaan;
        $agen->alamat_perusahaan = $request->alamat_perusahaan;
        $agen->no_telp_perusahaan = $request->no_telp_perusahaan;
        $agen->jabatan = $request->jabatan;

        // Simpan data agen ke database
        $agen->save();

        // Redirect dengan pesan sukses
        return redirect()->route('agen.dashboard')->with('success', 'Data berhasil dilengkapi.');
    }

    public function detail()
    {
        $agen = Agen::where('user_id',Auth::user()->id)->first();

        return view('agen.detail-agen',compact('agen'));
    }
}