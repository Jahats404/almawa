<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Agen;
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
        
        return view('dashboard.agen-dashboard', compact('cek'));
    }
}