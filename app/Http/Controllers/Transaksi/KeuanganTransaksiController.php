<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\DetailPembayaranJamaah;
use App\Models\Rekening;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KeuanganTransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::all();

        return view('keuangan.transaksi.transaksi-jamaah',compact('transaksi'));
    }

    public function tentukan_rekening()
    {
        $detailPembayaran = DetailPembayaranJamaah::where('status','Diterima')->doesntHave('transaksi')->get();
        $rekening = Rekening::all();
        
        return view('keuangan.rekening.tentukan-rekening',compact('detailPembayaran','rekening'));
    }

    public function store(Request $request)
    {
        $rules = [
            'debit' => 'nullable|integer|min:0',
            'kredit' => 'nullable|integer|min:0',
            'keterangan' => 'nullable|string|max:500',
            // 'tanggal' => 'required|date',
            'rekening_id' => 'required|string|exists:rekening,id_rekening',
            // 'detail_pembayaran_jamaah_id' => 'required|exists:detail_pembayaran_jamaah,id_detail_pembayaran_jamaah',
        ];
        
        $messages = [
            'debit.integer' => 'Field debit harus berupa angka.',
            'debit.min' => 'Field debit tidak boleh bernilai negatif.',
            'kredit.integer' => 'Field kredit harus berupa angka.',
            'kredit.min' => 'Field kredit tidak boleh bernilai negatif.',
            'keterangan.string' => 'Field keterangan harus berupa teks.',
            'keterangan.max' => 'Field keterangan tidak boleh lebih dari 500 karakter.',
            // 'tanggal.required' => 'Field tanggal wajib diisi.',
            // 'tanggal.date' => 'Field tanggal harus berupa tanggal yang valid.',
            'rekening_id.required' => 'Field rekening_id wajib diisi.',
            'rekening_id.exists' => 'Field rekening_id tidak ditemukan dalam data rekening.',
            // 'detail_pembayaran_jamaah_id.required' => 'Field detail_pembayaran_jamaah_id wajib diisi.',
            // 'detail_pembayaran_jamaah_id.exists' => 'Field detail_pembayaran_jamaah_id tidak ditemukan dalam data detail pembayaran jamaah.',
        ];
        
        $validator = Validator::make($request->all(), $rules, $messages);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $transaksi = new Transaksi();
        $transaksi->id_transaksi = random_int(1000000, 9999999);
        $transaksi->debit = $request->debit;
        $transaksi->kredit = $request->kredit;
        $transaksi->keterangan = $request->keterangan;
        $transaksi->rekening_id = $request->rekening_id;
        $transaksi->detail_pembayaran_jamaah_id = $request->detail_pembayaran_jamaah_id;
        $transaksi->save();

        return redirect()->back()->with('success','Berhasil menentukan rekening');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->delete();

        return redirect()->back()->with('success','Transaksi berhasil dihapus');
    }
}