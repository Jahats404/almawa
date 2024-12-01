<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login ()
    {
        return view('.auth.login');
    }

    public function authenticate(Request $request)
    {
        // dd($request);
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        $messages = [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Menyimpan input email ke dalam sesi
        Session::flash('email', $request->input('email'));

        // Validasi input
        // $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ], [
        //     'email.required' => 'Masukkan email',
        //     'email.email' => 'Format email tidak valid',
        //     'password.required' => 'Masukkan password',
        // ]);

        // Mengambil data input
        $credentials = $request->only('email', 'password');

        // Mencoba otentikasi pengguna
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->role_id == '1') {
                return redirect()->route('sa.dashboard');
            }
            elseif ($user->role_id == '2') {
                return redirect()->route('founder.dashboard');
            }
            elseif ($user->role_id == '3') {
                return redirect()->route('keuangan.dashboard');
            }
            elseif ($user->role_id == '4') {
                return redirect()->route('marketing.dashboard');
            }
            elseif ($user->role_id == '5') {
                return redirect()->route('agen.dashboard');
            }
            elseif ($user->role_id == '6') {
                return redirect()->route('jamaah.dashboard');
            }
        }

        return redirect()->back()->with('error', 'Email atau password salah!');
    }

    public function register()
    {
        return view('auth.register');
    }
    public function action_register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email|max:255',
            'password'     => 'required|string|min:8',
            'role_id'      => 'required',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nama_lengkap.string'   => 'Nama lengkap harus berupa teks.',
            'nama_lengkap.max'      => 'Nama lengkap tidak boleh lebih dari 255 karakter.',
            'email.required'        => 'Email wajib diisi.',
            'email.email'           => 'Format email tidak valid.',
            'email.unique'          => 'Email sudah terdaftar.',
            'email.max'             => 'Email tidak boleh lebih dari 255 karakter.',
            'password.required'     => 'Password wajib diisi.',
            'password.min'          => 'Password minimal 8 karakter.',
            'role_id.required'     => 'Role wajib diisi.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Simpan data pengguna jika validasi berhasil
        $user = new User();
        $user->name = $request->nama_lengkap;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;
        $user->save();

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silahkan Login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('Anda berhasil logout');
    }
}