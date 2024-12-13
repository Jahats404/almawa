<?php

namespace App\Http\Controllers\kelola_jamaah;

use App\Http\Controllers\Controller;
use App\Models\DetailPembayaranJamaah;
use App\Models\Jadwal;
use App\Models\Jamaah;
use App\Models\Paket;
use App\Models\PembayaranJamaah;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SaJamaahController extends Controller
{
    public function index()
    {
        // $jamaah = User::where('role_id', 6)
        // ->whereHas('jamaah', function ($query) {
        //     $query->where('status', 'Diterima');
        // })
        // ->with('jamaah')->get();
        $jamaah = Jamaah::where('status', 'Diterima')->get();
        $jadwal = Jadwal::all();
        $paket = Paket::all();
        // dd($jamaah);
        
        return view('super-admin.pengguna.kelola-jamaah.kelola-jamaah', compact('jamaah', 'jadwal','paket'));
    }

    public function store_jamaah(Request $request)
    {
        // dd($request);
        $rules = [
            // Data Jamaah
            'ktp' => 'required|string|max:255|unique:jamaah,ktp',
            'nama_lengkap' => 'required|string|max:255',
            'nama_ayah_kandung' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Pria,Wanita',
            'umur' => 'required|integer|min:0',
            
            // Data Fisik (Nullable)
            'tinggi' => 'nullable|string|max:255',
            'berat' => 'nullable|string|max:255',
            'muka' => 'nullable|string|max:255',
            'hidung' => 'nullable|string|max:255',
            'alis' => 'nullable|string|max:255',
            'rambut' => 'nullable|string|max:255',
    
            // Kesehatan
            'penyakit' => 'required|string|max:255',
            'rokok' => 'required|in:Iya,Tidak',
    
            // Kewarganegaraan
            'kewarganegaraan' => 'required|in:WNI,WNA',
    
            // Alamat
            'nama_jalan' => 'required|string|max:255',
            'desa' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:10',
            'no_telp' => 'required|string|max:15',
    
            // Kontak
            'email' => 'nullable|email|max:255',
            'pendidikan_terahir' => 'nullable|string|max:255',
    
            // Pekerjaan
            'pekerjaan' => 'nullable|string|max:255',
            'nama_perusahaan' => 'nullable|string|max:255',
            'alamat_perusahaan' => 'nullable|string|max:255',
            'no_telp_perusahaan' => 'nullable|string|max:15',
    
            // Data Keberangkatan
            'paket_id' => 'required|exists:paket,id_paket',
            'paspor' => 'required',
            'rencana_keberangkatan' => 'nullable|exists:jadwal,id_jadwal',
            // 'pesawat' => 'required|string|max:255',
            // 'nama_hotel' => 'required|string|max:255',
            'pengalaman_umroh' => 'nullable|string|max:255',
            'terahir_tahun' => 'nullable_if:pengalaman_umroh, Sudah|string|max:4',
            'paket_umroh' => 'nullable|string|max:255',
            'program' => 'nullable|string|max:255',
    
            // Data Keluarga
            'nama_keluarga_ikut' => 'nullable|string|max:255',
            'hubungan_keluarga_ikut' => 'nullable|string|max:255',
            'no_telp_keluarga_ikut' => 'nullable|string|max:15',
            'alamat_keluarga_ikut' => 'nullable|string|max:255',
            
            'nama_keluarga_tinggal' => 'required|string|max:255',
            'hubungan_keluarga_tinggal' => 'required|string|max:255',
            'no_telp_keluarga_tinggal' => 'required|string|max:15',
            'alamat_keluarga_tinggal' => 'required|string|max:255',
    
            // Status
            'status' => 'nullable|string|max:255',
    
            // Relasi
            'supervisor_id' => 'nullable|exists:users,id',
        ];
        
        if ($request->pengalaman_umroh === 'Belum Pernah') {
            $rules['pengalaman_umroh'] = 'nullable';
        }
        
        $validator = Validator::make($request->all(), $rules, Jamaah::$messages);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Membuat user baru
        $user = new User();
        $user->name = $request->nama_lengkap;
        $user->email = $request->email;
        $user->role_id = 6;
        $user->password = Hash::make('12345678'); // Default password
        $user->save();

        $jam = new Jamaah();
        $jam->id_pendaftaran = random_int(1000000, 9999999);
        $jam->ktp = $request->ktp;
        $jam->nama_lengkap = $request->nama_lengkap;
        $jam->nama_ayah_kandung = $request->nama_ayah_kandung;
        $jam->tempat_lahir = $request->tempat_lahir;
        $jam->tanggal_lahir = $request->tanggal_lahir;
        $jam->jenis_kelamin = $request->jenis_kelamin;
        $jam->umur = $request->umur;

        $jam->tinggi = $request->tinggi;
        $jam->berat = $request->berat;
        $jam->muka = $request->muka;
        $jam->hidung = $request->hidung;
        $jam->alis = $request->alis;
        $jam->rambut = $request->rambut;

        $jam->penyakit = $request->penyakit;
        $jam->rokok = $request->rokok;
        
        $jam->kewarganegaraan = $request->kewarganegaraan;
        
        $jam->nama_jalan = $request->nama_jalan;
        $jam->desa = $request->desa;
        $jam->kecamatan = $request->kecamatan;
        $jam->kabupaten = $request->kabupaten;
        $jam->provinsi = $request->provinsi;
        $jam->kode_pos = $request->kode_pos;
        $jam->no_telp = $request->no_telp;
        
        $jam->email = $request->email;
        $jam->pendidikan_terahir = $request->pendidikan_terahir;
        
        $jam->pekerjaan = $request->pekerjaan;
        $jam->nama_perusahaan = $request->nama_perusahaan;
        $jam->alamat_perusahaan = $request->alamat_perusahaan;
        $jam->no_telp_perusahaan = $request->no_telp_perusahaan;
        
        $jam->paspor = $request->paspor;
        $jam->paket_id = $request->paket_id;
        $jam->rencana_keberangkatan = $request->rencana_keberangkatan;
        // $jam->pesawat = $request->pesawat;
        // $jam->nama_hotel = $request->nama_hotel;
        $jam->pengalaman_umroh = $request->pengalaman_umroh;
        $jam->terahir_tahun = $request->sudah_pengalaman;
        $jam->paket_umroh = $request->paket_umroh;
        $jam->program = $request->program;

        $jam->nama_keluarga_ikut = $request->nama_keluarga_ikut;
        $jam->hubungan_keluarga_ikut = $request->hubungan_keluarga_ikut;
        $jam->no_telp_keluarga_ikut = $request->no_telp_keluarga_ikut;
        $jam->alamat_keluarga_ikut = $request->alamat_keluarga_ikut;

        $jam->nama_keluarga_tinggal = $request->nama_keluarga_tinggal;
        $jam->hubungan_keluarga_tinggal = $request->hubungan_keluarga_tinggal;
        $jam->no_telp_keluarga_tinggal = $request->no_telp_keluarga_tinggal;
        $jam->alamat_keluarga_tinggal = $request->alamat_keluarga_tinggal;

        $jam->status = 'Diterima';
        $jam->user_id = $user->id;
        $jam->supervisor_id = Auth::user()->id;

        $jam->save();

        return redirect()->back()->with('success', 'Jamaah berhasil ditambahkan');
    }

    public function update_jamaah(Request $request, $id)
    {
        
        $rules = [
            // Data Jamaah
            'ktp' => 'required|string|max:255|unique:jamaah,ktp',
            'nama_lengkap' => 'required|string|max:255',
            'nama_ayah_kandung' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Pria,Wanita',
            'umur' => 'required|integer|min:0',
            
            // Data Fisik (Nullable)
            'tinggi' => 'nullable|string|max:255',
            'berat' => 'nullable|string|max:255',
            'muka' => 'nullable|string|max:255',
            'hidung' => 'nullable|string|max:255',
            'alis' => 'nullable|string|max:255',
            'rambut' => 'nullable|string|max:255',
    
            // Kesehatan
            'penyakit' => 'required|string|max:255',
            'rokok' => 'required|in:Iya,Tidak',
    
            // Kewarganegaraan
            'kewarganegaraan' => 'required|in:WNI,WNA',
    
            // Alamat
            'nama_jalan' => 'required|string|max:255',
            'desa' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:10',
            'no_telp' => 'required|string|max:15',
    
            // Kontak
            'email' => 'nullable|email|max:255',
            'pendidikan_terahir' => 'nullable|string|max:255',
    
            // Pekerjaan
            'pekerjaan' => 'nullable|string|max:255',
            'nama_perusahaan' => 'nullable|string|max:255',
            'alamat_perusahaan' => 'nullable|string|max:255',
            'no_telp_perusahaan' => 'nullable|string|max:15',
    
            // Data Keberangkatan
            'paket_id' => 'required|exists:paket,id_paket',
            'paspor' => 'required',
            'rencana_keberangkatan' => 'nullable|exists:jadwal,id_jadwal',
            // 'pesawat' => 'required|string|max:255',
            // 'nama_hotel' => 'required|string|max:255',
            'pengalaman_umroh' => 'nullable|string|max:255',
            'terahir_tahun' => 'nullable_if:pengalaman_umroh, Sudah|string|max:4',
            'paket_umroh' => 'nullable|string|max:255',
            'program' => 'nullable|string|max:255',
    
            // Data Keluarga
            'nama_keluarga_ikut' => 'nullable|string|max:255',
            'hubungan_keluarga_ikut' => 'nullable|string|max:255',
            'no_telp_keluarga_ikut' => 'nullable|string|max:15',
            'alamat_keluarga_ikut' => 'nullable|string|max:255',
            
            'nama_keluarga_tinggal' => 'required|string|max:255',
            'hubungan_keluarga_tinggal' => 'required|string|max:255',
            'no_telp_keluarga_tinggal' => 'required|string|max:15',
            'alamat_keluarga_tinggal' => 'required|string|max:255',
    
            // Status
            'status' => 'nullable|string|max:255',
    
            // Relasi
            'supervisor_id' => 'nullable|exists:users,id',
        ];
        
        if ($request->pengalaman_umroh === 'Belum Pernah') {
            $rules['pengalaman_umroh'] = 'nullable';
        }
        $jam = Jamaah::find($id);
        if ($request->ktp == $jam->ktp) {
            $rules['ktp'] = 'nullable';
        }
        
        $validator = Validator::make($request->all(), $rules, Jamaah::$messages);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::find($jam->user_id);
        $user->id = $request->ktp;
        $user->name = $request->nama_lengkap;
        $user->email = $request->email;
        $user->save();
        
        // $jam->ktp = $request->ktp;
        $jam->nama_lengkap = $request->nama_lengkap;
        $jam->nama_ayah_kandung = $request->nama_ayah_kandung;
        $jam->tempat_lahir = $request->tempat_lahir;
        $jam->tanggal_lahir = $request->tanggal_lahir;
        $jam->jenis_kelamin = $request->jenis_kelamin;
        $jam->umur = $request->umur;

        $jam->tinggi = $request->tinggi;
        $jam->berat = $request->berat;
        $jam->muka = $request->muka;
        $jam->hidung = $request->hidung;
        $jam->alis = $request->alis;
        $jam->rambut = $request->rambut;

        $jam->penyakit = $request->penyakit;
        $jam->rokok = $request->rokok;
        
        $jam->kewarganegaraan = $request->kewarganegaraan;
        
        $jam->nama_jalan = $request->nama_jalan;
        $jam->desa = $request->desa;
        $jam->kecamatan = $request->kecamatan;
        $jam->kabupaten = $request->kabupaten;
        $jam->provinsi = $request->provinsi;
        $jam->kode_pos = $request->kode_pos;
        $jam->no_telp = $request->no_telp;
        
        $jam->email = $request->email;
        $jam->pendidikan_terahir = $request->pendidikan_terahir;
        // dd($request->pendidikan_terahir);
        
        $jam->pekerjaan = $request->pekerjaan;
        $jam->nama_perusahaan = $request->nama_perusahaan;
        $jam->alamat_perusahaan = $request->alamat_perusahaan;
        $jam->no_telp_perusahaan = $request->no_telp_perusahaan;
        
        $jam->paspor = $request->paspor;
        $jam->paket_id = $request->paket_id;
        $jam->rencana_keberangkatan = $request->rencana_keberangkatan;
        // $jam->pesawat = $request->pesawat;
        // $jam->nama_hotel = $request->nama_hotel;
        $jam->pengalaman_umroh = $request->pengalaman_umroh;
        $jam->terahir_tahun = $request->sudah_pengalaman;
        $jam->paket_umroh = $request->paket_umroh;
        $jam->program = $request->program;

        $jam->nama_keluarga_ikut = $request->nama_keluarga_ikut;
        $jam->hubungan_keluarga_ikut = $request->hubungan_keluarga_ikut;
        $jam->no_telp_keluarga_ikut = $request->no_telp_keluarga_ikut;
        $jam->alamat_keluarga_ikut = $request->alamat_keluarga_ikut;

        $jam->nama_keluarga_tinggal = $request->nama_keluarga_tinggal;
        $jam->hubungan_keluarga_tinggal = $request->hubungan_keluarga_tinggal;
        $jam->no_telp_keluarga_tinggal = $request->no_telp_keluarga_tinggal;
        $jam->alamat_keluarga_tinggal = $request->alamat_keluarga_tinggal;

        $jam->save();

        return redirect()->back()->with('success', 'Jamaah berhasil diperbarui');
    }

    public function detail($id)
    {
        $jamaah = Jamaah::find($id);
        
        $cekPembayaran = PembayaranJamaah::where('jamaah_id', $jamaah->id_pendaftaran)->first();
        if ($cekPembayaran == NULL) {
            $pembayaran = new PembayaranJamaah();
            $pembayaran->id_pembayaran = random_int(1000000, 9999999);
            $pembayaran->jumlah_bayar = $jamaah->paket->harga;
            $pembayaran->status = 'Belum Bayar';
            $pembayaran->jamaah_id = $jamaah->id_pendaftaran;
            $pembayaran->save();
        }
        elseif ($jamaah->pembayaran_jamaah) {
            
            $pembayaran = PembayaranJamaah::find($jamaah->pembayaran_jamaah->id_pembayaran);
            
            $totalJumlahDiterima = DetailPembayaranJamaah::where('pembayaran_id', $jamaah->pembayaran_jamaah->id_pembayaran)
                ->where('status', 'Diterima')
                ->sum('jumlah');

            // CEK SUDAH BAYAR
            $cekPembayaran = DetailPembayaranJamaah::where('pembayaran_id', $jamaah->pembayaran_jamaah->id_pembayaran)
                        ->where('status', 'Diterima')->first();
            
            // KONVERSI KE INT
            $totalJumlahDiterima = (int) $totalJumlahDiterima; 
            
            // CEK JIKA SUDAH LUNAS
            if ($jamaah->pembayaran_jamaah->jumlah_bayar <= $totalJumlahDiterima) {
                $pembayaran->status = 'Lunas';
                
            } elseif ($cekPembayaran) {
                $pembayaran->status = 'Belum Lunas';
                
            }
            $pembayaran->save();

        }

        return view('super-admin.pengguna.kelola-jamaah.detail-jamaah', compact('jamaah'));
    }

    public function delete($id)
    {
        $jamaah = Jamaah::find($id);
        $jamaah->delete();

        return redirect()->back()->with('success', 'Jamaah berhasil dihapus');
    }

    public function pengajuan_jamaah()
    {
        $jamaah = Jamaah::whereIn('status', ['Diajukan','Ditolak'])->get();
        
        return view('super-admin.pengguna.kelola-jamaah.pengajuan-jammah', compact('jamaah'));
    }

    public function ubah_status_jamaah(Request $request, $id)
    {
        $agen = Jamaah::findOrFail($id);
        $agen->status = $request->status;
        $agen->save();

        return redirect()->back()->with('success', 'Status berhasil diubah');
    }
}