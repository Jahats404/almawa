<?php

namespace App\Http\Controllers\pengguna;

use App\Http\Controllers\Controller;
use App\Models\Agen;
use App\Models\Role;
use App\Models\User;
use App\Models\Validasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class PenggunaController extends Controller
{
    public function staff()
    {
        $role = Role::whereNot('id_role', 1)->get();
        $staff = User::whereIn('role_id', [2,3,4])->get();
        // dd($staff);
    
        return view('super-admin.pengguna.kelola-staff', compact('role','staff'));
    }

    public function store_staff(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:roles,id_role',
        ];

        $messages = [
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.string' => 'Nama tidak valid.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus minimal 8 karakter.',
            'role_id.required' => 'Role wajib dipilih.',
            'role_id.exists' => 'Role yang dipilih tidak valid.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Pengguna berhasil ditambahkan');
    }

    public function update_staff(Request $request, $id)
    {
        $rules = [
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($request->id),
            ],
            'name' => 'required|string|max:255',
            'role_id' => 'required|exists:roles,id_role',
        ];
        
        $messages = [
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.string' => 'Nama tidak valid.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'role_id.required' => 'Role wajib dipilih.',
            'role_id.exists' => 'Role yang dipilih tidak valid.',
        ];
        
        if ($request->password !== NULL) {
            $rules['password'] = 'required|string|min:8';
            $messages['password.required'] = 'Password wajib diisi.';
            $messages['password.min'] = 'Password harus minimal 8 karakter.';
        }

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        if ($request->password == !NULL) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    public function delete_staff($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    // ===================================== AGEN =================================================================================
    
    public function agen()
    {
        $role = Role::whereNot('id_role', 1)->get();
        $agen = User::where('role_id', 5)->with('agen')->get();
    
        return view('super-admin.pengguna.kelola-agen.kelola-agen', compact('role','agen'));
    }

    public function detail_agen($id)
    {
        $agen = Agen::find($id);
        // if (Auth()->user()->role->id_role == 1) {
        // }
            return view('super-admin.pengguna.kelola-agen.detail-agen', compact('agen'));
    }

    public function store_agen(Request $request)
    {
        // dd($request);
        // Validasi data input
        $rules = [
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

        // Membuat user baru
        $user = new User();
        $user->name = $request->nama_lengkap;
        $user->email = $request->email;
        $user->role_id = 5;
        $user->password = Hash::make('12345678'); // Default password
        $user->save();

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
        $agen->user_id = $user->id; // Menghubungkan agen ke user yang baru dibuat
        $agen->supervisor_id = Auth()->user()->id;

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
        return redirect()->back()->with('success', 'Agen berhasil ditambahkan.');
    }


    public function update_agen(Request $request, $id)
    {

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
            'file_ktp'            => 'image|nullable|mimes:jpg,jpeg,png,gif|max:2048',
            'file_pembayaran'     => 'image|nullable|mimes:jpg,jpeg,png,gif|max:2048',
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

        $agen = Agen::find($id);
        if ($request->ktp == $agen->ktp) {
            $rules['ktp'] = 'nullable';
        }
        $validator = Validator::make($request->all(), $rules, Validasi::$messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $user = User::find($agen->user_id);
        
        $user->name = $request->nama_lengkap;
        $user->email = $request->email;
        $user->save();

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
        $agen->user_id = $user->id; // Menghubungkan agen ke user yang baru dibuat

        // Upload file KTP jika ada
        if ($request->hasFile('file_ktp')) {
            // Hapus file lama jika ada
            if ($agen->file_ktp && Storage::disk('public')->exists($agen->file_ktp)) {
                Storage::disk('public')->delete($agen->file_ktp);
            }
        
            // Simpan file baru
            $file = $request->file('file_ktp');
            $agen->file_ktp = $file->store('ktp', 'public');
        }

        // Upload file pembayaran jika ada
        if ($request->hasFile('file_pembayaran')) {
            // Hapus file lama jika ada
            if ($agen->file_pembayaran && Storage::disk('public')->exists($agen->file_pembayaran)) {
                Storage::disk('public')->delete($agen->file_pembayaran);
            }
            
            // Simpan file baru
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

        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }

    public function delete_agen($id)
    {
        $agen = Agen::findOrFail($id);
        $user = User::findOrFail($agen->user_id);
        
        if ($agen->file_ktp) {
            Storage::disk('public')->delete($agen->file_ktp);
        }
        if ($agen->file_pembayaran) {
            Storage::disk('public')->delete($agen->file_pembayaran);
        }
        
        $agen->delete();
        $user->delete();
        

        return redirect()->back()->with('success', 'Agen berhasil dihapus');
        
    }

}