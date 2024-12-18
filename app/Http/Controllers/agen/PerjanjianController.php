<?php

namespace App\Http\Controllers\agen;

use App\Http\Controllers\Controller;
use App\Models\Agen;
use App\Models\Perjanjian;
use Dompdf\Dompdf;
use Dompdf\Options;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerjanjianController extends Controller
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

    public function saveSignature(Request $request)
    {
        try {
            // Ambil data base64 dari request
            $signature = $request->input('signature');
            $agen_id = Agen::where('user_id', Auth::user()->id)->first()->no_registrasi;

            // Proses tanda tangan
            $image = str_replace('data:image/png;base64,', '', $signature);
            $image = str_replace(' ', '+', $image);
            $imageName = 'signature_' . time() . '.png';
            $path = storage_path('app/public/signatures/' . $imageName);

            // Buat folder jika belum ada
            if (!file_exists(storage_path('app/public/signatures'))) {
                mkdir(storage_path('app/public/signatures'), 0777, true);
            }

            // Simpan file gambar ke server
            file_put_contents($path, base64_decode($image));

            // Lokasi tanda tangan relatif
            $relativePath = 'signatures/' . $imageName;

            // Periksa apakah ada perjanjian untuk agen ini
            $perjanjian = Perjanjian::firstOrCreate(
                ['agen_id' => $agen_id], // Cari berdasarkan agen_id
                ['created_at' => now(), 'updated_at' => now()] // Jika tidak ada, buat baru
            );

            // Hapus tanda tangan lama jika ada
            if ($perjanjian->ttd && file_exists(storage_path('app/public/' . $perjanjian->ttd))) {
                unlink(storage_path('app/public/' . $perjanjian->ttd));
            }

            // Simpan tanda tangan baru ke database
            $perjanjian->update([
                'ttd' => $relativePath, // Simpan path tanda tangan
            ]);

            return response()->json([
                'message' => 'Tanda tangan berhasil disimpan.',
                'ttd_path' => $relativePath
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan tanda tangan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function ttd()
    {
        $diterima = Agen::where('status', 'Diterima')->where('user_id', Auth::user()->id)->first();
        
        return view('agen.perjanjian.tanda-tangan',compact('diterima'));
    }

    
}