@extends('layouts.master')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">List Pendaftaran</h1>
    </div>

    <!-- Content Row -->
    <div class="row"> 
        @if (!$list)
            <div class="d-flex justify-content-center align-items-center" style="height: 200px; width: 100%;">
                <span class="text-center text-danger">Tidak ada data!</span>
            </div>
        @else
            @foreach ($list as $item)
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-300 py-2 hover-card">
                    <!-- Tambahkan link di sini -->
                    <a href="{{ route('jamaah.pendaftaran.detail', ['id' => $item->id_pendaftaran]) }}" class="stretched-link"></a>
                    <div class="card-header py-3 d-flex flex-wrap align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary flex-grow-1">
                            {{ $item->paket->nama_paket }} <i class="fas fa-solid fa-kaaba"></i>
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <td>{{ 'Rp ' . number_format($item->paket->harga, 0, ',', '.') }}</td>
                        </div>
                        {{-- <span class="badge badge-danger">Belum Bayar</span> --}}
                        @if ($item->pembayaran_jamaah)
                            @if ($item->pembayaran_jamaah->status == 'Lunas')
                                <span class="badge badge-success">Lunas</span>
                            @elseif ($item->pembayaran_jamaah->status == 'Belum Lunas')
                                <span class="badge badge-info">Belum Lunas</span>
                            @elseif ($item->pembayaran_jamaah->status == 'Belum Bayar')
                                <span class="badge badge-danger">Belum Bayar</span>
                            @else
                                <span class="badge badge-danger">Belum Bayar</span>
                            @endif
                        @endif
                        <span class="text-gray-800"></span>
                        <div class="row no-gutters align-items-center mt-2">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Kelengkapan Data</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
    
    <style>
        .hover-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        /* Style for centering the "Data tidak ditemukan" message */
        .d-flex {
            display: flex;
        }
    </style>

    @include('validasi.notifikasi')
    @include('validasi.notifikasi-error')
@endsection
