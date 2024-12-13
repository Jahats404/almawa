<?php

namespace App\Http\Controllers\pendaftaran;

use App\Http\Controllers\Controller;
use App\Models\DetailPembayaranJamaah;
use App\Models\Jadwal;
use App\Models\Jamaah;
use App\Models\Paket;
use App\Models\PembayaranJamaah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JamaahPendaftaranController extends Controller
{
    public function index()
    {
        $list = Jamaah::where('user_id', Auth::user()->id)->get();
        $paket = Paket::all();
        $jadwal = Jadwal::where('status', 'Disetujui')->get();
        // $pembayaran = PembayaranJamaah::where('jamaah_id', )
        
        return view('jamaah.pendaftaran.list-pendaftaran', compact('list','paket','jadwal'));
    }

    public function detail_pendaftaran($id)
    {
        $jamaah = Jamaah::find($id);
        $cekStatusJamaah = $jamaah->status;
        
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
        // dd($jamaah->pembayaran_jamaah->tanggal);
        
        return view('jamaah.pendaftaran.detail-pendaftaran',compact('jamaah','cekStatusJamaah'));
    }
}