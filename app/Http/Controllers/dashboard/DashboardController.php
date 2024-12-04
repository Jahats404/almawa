<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Agen;
use App\Models\Jamaah;
use App\Models\Jadwal;
use App\Models\Paket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.dashboard');
    }
    public function dashboard_agen()
    {
        $cek = Agen::where('user_id', Auth::user()->id)->first();
        $diajukan = Agen::where('status', 'Diajukan')->where('user_id', Auth::user()->id)->first();
        $diterima = Agen::where('status', 'Diterima')->where('user_id', Auth::user()->id)->first();
        $ditolak = Agen::where('status', 'Ditolak')->where('user_id', Auth::user()->id)->first();
        
        return view('dashboard.agen-dashboard', compact('cek', 'diajukan','diterima','ditolak'));
    }
    public function dashboard_jamaah()
    {
        $cek = Jamaah::where('user_id', Auth::user()->id)->first();
        $jadwal = Jadwal::where('status', 'Disetujui')->get();
        $list = Jamaah::where('user_id', Auth::user()->id)->get();
        $paket = Paket::all();
        
        return view('dashboard.jamaah-dashboard', compact('cek', 'jadwal','list', 'paket'));
    }
}