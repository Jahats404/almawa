<?php

namespace App\Http\Controllers\pembayaran;

use App\Http\Controllers\Controller;
use App\Models\DetailPembayaranJamaah;
use App\Models\Jamaah;
use App\Models\PembayaranJamaah;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AgenJamaahPembayaranController extends Controller
{
    public function index($id)
    {
        $detail = DetailPembayaranJamaah::where('pembayaran_id', $id)->get();
        $pembayaran = PembayaranJamaah::find($id);
        $idJamaah = Jamaah::find($pembayaran->jamaah_id);

        // cek sisa tagihan
        $totalJumlahDiterima = DetailPembayaranJamaah::where('pembayaran_id', $id)
                ->where('status', 'Diterima')
                ->sum('jumlah');
        $sisaTagihan = $pembayaran->jumlah_bayar - $totalJumlahDiterima;
        
        return view('agen.kelola-jamaah.detail-pembayaran-jamaah',compact('detail','id','idJamaah','sisaTagihan'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), 
            [
                'jumlah'     => 'required|numeric',
                'bukti_pembayaran'  => 'image|mimes:jpg,jpeg,png,pdf,gif|max:2048',
            ],
            [
                'jumlah.required' => 'Jumlah bayar Wajib diisi.',
                'bukti_pembayaran.required' => 'Bukti pembayaran Wajib diisi.',
                'bukti_pembayaran.file' => 'Bukti pembayaran harus berupa file yang valid.',
                'bukti_pembayaran.mimes' => 'Bukti pembayaran harus berupa file dengan format: jpg, jpeg, png, atau pdf.',
                'bukti_pembayaran.max' => 'Ukuran Bukti pembayaran tidak boleh lebih dari 2MB.',
                
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $dateNow = Carbon::now();

        $detail = new DetailPembayaranJamaah();
        $detail->jumlah = $request->jumlah;
        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $detail->bukti_pembayaran = $file->store('bukti_pembayaran/jamaah', 'public');
        }
        $detail->tanggal = $dateNow;
        $detail->status = 'Pending';
        $detail->pembayaran_id = $request->pembayaran_id;
        $detail->user_id = Auth::user()->id;

        $terakhir = DetailPembayaranJamaah::where('pembayaran_id', $request->pembayaran_id)
                ->latest('created_at') // Urutkan berdasarkan kolom created_at secara descending
                ->first(); // Ambil data pertama (terbaru)
                // dd($terakhir);
        if ($terakhir) {
            $detail->sisa_tagihan = $terakhir->sisa_tagihan;
        }else{
            $pembayaran = PembayaranJamaah::find($request->pembayaran_id);
            $detail->sisa_tagihan = $pembayaran->jumlah_bayar;
        }

        $detail->save();

        return redirect()->back()->with('success','Bukti Pembayaran berhasil ditambahkan');
    }
}