<?php

namespace App\Http\Controllers\kelola_jadwal;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Paket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SaJadwalController extends Controller
{
    public function index()
    {
        $jadwal = Jadwal::all();
        
        return view('super-admin.jadwal.kelola-jadwal', compact('jadwal'));
    }

    public function store(Request $request)
    {
        $rules = [
            'jadwal' => 'required',
            'pesawat' => 'required',
            'makkah' => 'required',
            'madinah' => 'required',
        ];
        $messages = [
            'jadwal.required' => 'Jadwal tidak boleh kosong!',
            'pesawat.required' => 'Jadwal tidak boleh kosong!',
            'makkah.required' => 'Jadwal tidak boleh kosong!',
            'madinah.required' => 'Jadwal tidak boleh kosong!',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $dateNow = Carbon::now();
        $jadwal = Carbon::parse($request->jadwal);
        if ($jadwal <= $dateNow) {
            return redirect()->back()->with('error', 'Tanggal tidak valid');
        }

        $jadwal = new Jadwal();
        $jadwal->jadwal = $request->jadwal;
        $jadwal->pesawat = $request->pesawat;
        $jadwal->makkah = $request->makkah;
        $jadwal->madinah = $request->madinah;
        $jadwal->status = 'Disetujui';
        $jadwal->save();

        return redirect()->back()->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'jadwal' => 'required',
            'pesawat' => 'required',
            'makkah' => 'required',
            'madinah' => 'required',
        ];
        $messages = [
            'jadwal.required' => 'Jadwal tidak boleh kosong!',
            'pesawat.required' => 'Jadwal tidak boleh kosong!',
            'makkah.required' => 'Jadwal tidak boleh kosong!',
            'madinah.required' => 'Jadwal tidak boleh kosong!',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $dateNow = Carbon::now();
        $jadwal = Carbon::parse($request->jadwal);
        if ($jadwal <= $dateNow) {
            return redirect()->back()->with('error', 'Tanggal tidak valid');
        }

        $jadwal = Jadwal::find($id);
        $jadwal->jadwal = $request->jadwal;
        $jadwal->pesawat = $request->pesawat;
        $jadwal->makkah = $request->makkah;
        $jadwal->madinah = $request->madinah;
        $jadwal->status = $request->status;
        $jadwal->save();

        return redirect()->back()->with('success', 'Jadwal berhasil diperbarui');
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::find($id);
        $jadwal->delete();

        return redirect()->back()->with('success', 'Jadwal berhasil dihapus');
    }
}