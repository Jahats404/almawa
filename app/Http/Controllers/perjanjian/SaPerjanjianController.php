<?php

namespace App\Http\Controllers\perjanjian;

use App\Http\Controllers\Controller;
use App\Models\Agen;
use App\Models\Perjanjian;
use Dompdf\Dompdf;
use Dompdf\Options;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaPerjanjianController extends Controller
{
    public function generatePDF()
    {       
        $agen = Agen::where('user_id', Auth::user()->id)->first();

        // Periksa apakah ada file tanda tangan
        $ttdPath = $agen->perjanjian->ttd ?? null;
        $signaturePath = null;
        if ($ttdPath && file_exists(storage_path('app/public/' . $ttdPath))) {
            $signaturePath = asset('storage/' . $ttdPath);
        }

        $data = [
            'nama_agen' => $agen->nama_lengkap,
            'ktp_agen' => $agen->ktp,
            'alamat_agen' => $agen->alamat,
            'agen' => $agen,
            'logoPath' => public_path('images/logo.png'), // Pastikan file logo ada di folder public/images/
            'signaturePath' => $signaturePath,
        ];
        // dd($signaturePath);

        $pdf = PDF::loadView('agen.perjanjian.surat-perjanjian', $data);
        return $pdf->stream('Surat_Perjanjian_Agen.pdf');
    }
}