<?php

namespace App\Http\Controllers\paket;

use App\Http\Controllers\Controller;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SaPaketController extends Controller
{
    public function index()
    {
        $paket = Paket::all();
        
        return view('super-admin.paket.kelola-paket', compact('paket'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), 
            [
                'nama_paket' => 'required',
                'harga' => 'required|numeric',
            ],
            [
                'nama_paket.required' => 'Nama Paket wajib diisi',
                'harga.required' => 'Harga wajib diisi',
                'harga.numeric' => 'Harga Harus berupa angka',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $paket = new Paket();
        $paket->nama_paket = $request->nama_paket;
        $paket->harga = $request->harga;
        $paket->user_id = Auth::user()->id;
        $paket->save();

        return redirect()->back()->with('success', 'Paket berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), 
            [
                'nama_paket' => 'required',
                'harga' => 'required|numeric',
            ],
            [
                'nama_paket.required' => 'Nama Paket wajib diisi',
                'harga.required' => 'Harga wajib diisi',
                'harga.numeric' => 'Harga Harus berupa angka',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $paket = Paket::find($id);
        $paket->nama_paket = $request->nama_paket;
        $paket->harga = $request->harga;
        $paket->save();

        return redirect()->back()->with('success', 'Paket berhasil diperbarui');
    }

    public function delete($id)
    {
        $paket = Paket::find($id);
        $paket->delete();

        return redirect()->back()->with('success', 'Paket berhasil dihapus');
    }
}