<?php

namespace App\Http\Controllers\kelola_rekening;

use App\Http\Controllers\Controller;
use App\Models\Rekening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KeuanganRekeningController extends Controller
{
    public function index()
    {
        $rekening = Rekening::all();
        return view('keuangan.rekening.kelola-rekening',compact('rekening'));
    }

    public function store(Request $request)
    {
        $rules = [
            'nama_rekening' => 'required|string',
        ];
        $messages = [
            'nama_rekening.required' => 'Nama Rekening tidak boleh kosong!',
            'nama_rekening.string' => 'Nama Rekening harus berupa huruf!',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $rekening = new Rekening();
        $rekening->id_rekening = 'REK' . str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
        $rekening->nama_rekening = $request->nama_rekening;
        $rekening->save();

        return redirect()->back()->with('success', 'Rekening berhasil ditambahkan');
    }


    public function update(Request $request, $id)
    {
        $rules = [
            'nama_rekening' => 'required|string',
        ];
        $messages = [
            'nama_rekening.required' => 'Nama Rekening tidak boleh kosong!',
            'nama_rekening.string' => 'Nama Rekening harus berupa huruf!',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $rekening = Rekening::find($id);
        $rekening->nama_rekening = $request->nama_rekening;
        $rekening->save();

        return redirect()->back()->with('success', 'Rekening berhasil diperbarui');
    }

    public function destroy($id)
    {
        $rekening = Rekening::find($id);
        $rekening->delete();

        return redirect()->back()->with('success', 'Rekening berhasil dihapus');
    }
}