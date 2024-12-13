@extends('layouts.master')

@section('content')

    <!-- Page Heading -->
    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between mb-4">
        <!-- Judul Halaman -->
        <h1 class="h3 mb-3 mb-md-0 text-gray-800">Detail</h1>
        <!-- Tombol -->
        <a href="{{ route('jamaah.list.pendaftaran') }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="row">
        @if ($cekStatusJamaah == 'Diterima')    
            <div class="col-xl-4 col-md-6 mb-4">
                <!-- Detail Jamaah -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="card-header py-3 d-flex flex-wrap align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary flex-grow-1">Pembayaran</h6>
                            @if ($jamaah->pembayaran_jamaah)
                                @if ($jamaah->pembayaran_jamaah->status == "Lunas")    
                                <a href="{{ route('jamaah.pembayaran.detail', ['id' => $jamaah->pembayaran_jamaah->id_pembayaran]) }}" class="btn btn-sm btn-primary shadow-sm mt-2 mt-md-0">
                                    <i class="fas fa-solid fa-dollar-sign fa-sm text-white-50"></i> Detail
                                </a>
                                @else
                                <a href="{{ route('jamaah.pembayaran.detail', ['id' => $jamaah->pembayaran_jamaah->id_pembayaran]) }}" class="btn btn-sm btn-primary shadow-sm mt-2 mt-md-0">
                                    <i class="fas fa-solid fa-dollar-sign fa-sm text-white-50"></i> Bayar
                                </a>
                                @endif
                            @endif
                        </div>
                    </div>
            
                    <div class="card-body">
                        @if ($jamaah->pembayaran_jamaah)
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        {{-- <tr>
                                            <th>ID Pembayaran</th>
                                            <td>{{ $jamaah->pembayaran_jamaah->id_pembayaran }}</td>
                                        </tr> --}}
                                        <tr>
                                            <th>Status Pembayaran</th>
                                            <td>
                                                @if ($jamaah->pembayaran_jamaah->status == 'Lunas')
                                                    <span class="badge badge-success">Lunas</span>
                                                @elseif ($jamaah->pembayaran_jamaah->status == 'DP')
                                                    <span class="badge badge-info">DP</span>
                                                @elseif ($jamaah->pembayaran_jamaah->status == 'Belum Bayar')
                                                    <span class="badge badge-danger">Belum Bayar</span>
                                                @elseif ($jamaah->pembayaran_jamaah->status == 'Belum Lunas')
                                                    <span class="badge badge-warning">Belum Lunas</span>
                                                @else
                                                    <span class="badge badge-secondary">Tidak Diketahui</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Nominal Pembayaran</th>
                                            <td>{{ 'Rp ' . number_format($jamaah->pembayaran_jamaah->jumlah_bayar, 0, ',', '.') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-center text-danger">Anda belum melakukan pembayaran.</p>
                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary shadow-sm mt-2 mt-md-0">
                                <i class="fas fa-solid fa-dollar-sign fa-sm text-white-50"></i> Bayar Sekarang
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endif
        

        @if ($cekStatusJamaah == 'Diterima')
            <div class="col-xl-8 col-md-6 mb-4">
        @else
            <div class="col-xl-12 col-md-6 mb-4">
        @endif
            <!-- Detail Jamaah -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="card-header py-3 d-flex flex-wrap align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary flex-grow-1">Detail Jamaah</h6>
                    </div>
                </div>
        
                <div class="card-body">
                    @if ($jamaah)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <!-- Data Pribadi -->
                                    <tr><th colspan="2" class="text-center bg-info text-white">Data Pribadi</th></tr>
                                    <tr>
                                        <th>KTP</th>
                                        <td>{{ $jamaah->ktp }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Lengkap</th>
                                        <td>{{ $jamaah->nama_lengkap }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Ayah Kandung</th>
                                        <td>{{ $jamaah->nama_ayah_kandung }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tempat Lahir</th>
                                        <td>{{ $jamaah->tempat_lahir }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Lahir</th>
                                        <td>{{ \Carbon\Carbon::parse($jamaah->tanggal_lahir)->locale('id')->isoFormat('D MMMM YYYY') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td>{{ $jamaah->jenis_kelamin }}</td>
                                    </tr>
                                    <tr>
                                        <th>Umur</th>
                                        <td>{{ $jamaah->umur }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pendidikan Terahir</th>
                                        <td>{{ $jamaah->pendidikan_terahir ?? '-' }}</td>
                                    </tr>
        
                                    <tr><th colspan="2" class="text-center bg-info text-white">Ciri Ciri Fisik</th></tr>
                                    <tr>
                                        <th>Muka</th>
                                        <td>{{ $jamaah->muka ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Hidung</th>
                                        <td>{{ $jamaah->hidung ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alis</th>
                                        <td>{{ $jamaah->alis ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Rambut</th>
                                        <td>{{ $jamaah->rambut ?? '-' }}</td>
                                    </tr>
        
                                    <!-- Alamat -->
                                    <tr><th colspan="2" class="text-center bg-info text-white">Alamat</th></tr>
                                    <tr>
                                        <th>Alamat Lengkap</th>
                                        <td>{{ $jamaah->nama_jalan }}, {{ $jamaah->desa }}, {{ $jamaah->kecamatan }}, {{ $jamaah->kabupaten }}, {{ $jamaah->provinsi }}, {{ $jamaah->kode_pos }}</td>
                                    </tr>
                                    <tr>
                                        <th>No Telepon</th>
                                        <td>{{ $jamaah->no_telp }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $jamaah->email ?? '-' }}</td>
                                    </tr>
        
                                    <!-- Data Kesehatan -->
                                    <tr><th colspan="2" class="text-center bg-info text-white">Data Kesehatan</th></tr>
                                    <tr>
                                        <th>Tinggi Badan</th>
                                        <td>{{ $jamaah->tinggi ?? '-' }} cm</td>
                                    </tr>
                                    <tr>
                                        <th>Berat Badan</th>
                                        <td>{{ $jamaah->berat ?? '-' }} kg</td>
                                    </tr>
                                    <tr>
                                        <th>Penyakit</th>
                                        <td>{{ $jamaah->penyakit }}</td>
                                    </tr>
                                    <tr>
                                        <th>Merokok</th>
                                        <td>{{ $jamaah->rokok }}</td>
                                    </tr>
        
                                    <!-- Pekerjaan -->
                                    <tr><th colspan="2" class="text-center bg-info text-white">Data Pekerjaan</th></tr>
                                    <tr>
                                        <th>Pekerjaan</th>
                                        <td>{{ $jamaah->pekerjaan ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Perusahaan</th>
                                        <td>{{ $jamaah->nama_perusahaan ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat Perusahaan</th>
                                        <td>{{ $jamaah->alamat_perusahaan ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>No Telepon Perusahaan</th>
                                        <td>{{ $jamaah->no_telp_perusahaan ?? '-' }}</td>
                                    </tr>
        
                                    <!-- Keberangkatan -->
                                    <tr><th colspan="2" class="text-center bg-info text-white">Data Keberangkatan</th></tr>
                                    <tr>
                                        <th>Paket</th>
                                        <td>{{ $jamaah->paket->nama_paket }}</td>
                                    </tr>
                                    <tr>
                                        <th>Paspor</th>
                                        <td>{{ $jamaah->paspor }}</td>
                                    </tr>
                                    <tr>
                                        <th>Rencana Keberangkatan</th>
                                        <td>
                                            @if ($jamaah->jadwal)
                                                {{ \Carbon\Carbon::parse($jamaah->jadwal->jadwal)->translatedFormat('d F Y, H:i') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Hotel Madinah</th>
                                        <td>{{ $jamaah->jadwal->madinah ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Hotel Makkah</th>
                                        <td>{{ $jamaah->jadwal->makkah ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pengalaman Umroh</th>
                                        <td>{{ $jamaah->pengalaman_umroh ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tahun Terakhir Umroh</th>
                                        <td>{{ $jamaah->terahir_tahun ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Paket Umroh</th>
                                        <td>{{ $jamaah->paket_umroh ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Program</th>
                                        <td>{{ $jamaah->program ?? '-' }}</td>
                                    </tr>
        
                                    <!-- Data Keluarga -->
                                    <tr><th colspan="2" class="text-center bg-info text-white">Data Keluarga</th></tr>
                                    <tr>
                                        <th>Nama Keluarga Ikut</th>
                                        <td>{{ $jamaah->nama_keluarga_ikut ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Hubungan Keluarga Ikut</th>
                                        <td>{{ $jamaah->hubungan_keluarga_ikut ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>No Telepon Keluarga Ikut</th>
                                        <td>{{ $jamaah->no_telp_keluarga_ikut ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat Keluarga Ikut</th>
                                        <td>{{ $jamaah->alamat_keluarga_ikut ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Keluarga Tinggal</th>
                                        <td>{{ $jamaah->nama_keluarga_tinggal }}</td>
                                    </tr>
                                    <tr>
                                        <th>Hubungan Keluarga Tinggal</th>
                                        <td>{{ $jamaah->hubungan_keluarga_tinggal }}</td>
                                    </tr>
                                    <tr>
                                        <th>No Telepon Keluarga Tinggal</th>
                                        <td>{{ $jamaah->no_telp_keluarga_tinggal }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat Keluarga Tinggal</th>
                                        <td>{{ $jamaah->alamat_keluarga_tinggal }}</td>
                                    </tr>
        
                                    <!-- Metadata -->
                                    <tr><th colspan="2" class="text-center bg-info text-white">Informasi Tambahan</th></tr>
                                    <tr>
                                        <th>Dibuat Pada</th>
                                        <td>{{ \Carbon\Carbon::parse($jamaah->created_at)->locale('id')->isoFormat('D MMMM YYYY HH:mm') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-danger">Data jamaah tidak ditemukan.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('validasi.notifikasi')
    @include('validasi.notifikasi-error')
@endsection
