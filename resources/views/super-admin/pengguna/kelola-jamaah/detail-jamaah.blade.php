@extends('layouts.master')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Jamaah</h1>
    </div>

    <!-- Detail Jamaah -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex">
                <h6 class="m-0 font-weight-bold text-primary">Detail Jamaah</h6>
                <a href="{{ route('sa.kelola.jamaah') }}" class="d-none ml-auto d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-solid fa-arrow-left fa-sm text-white-50"></i> Kembali
                </a>
            </div>
        </div>

        <div class="card-body">
            @if ($jamaah)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <!-- Data Pribadi -->
                            <tr><th colspan="2" class="text-center bg-primary text-white">Data Pribadi</th></tr>
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

                            <!-- Alamat -->
                            <tr><th colspan="2" class="text-center bg-primary text-white">Alamat</th></tr>
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
                            <tr><th colspan="2" class="text-center bg-primary text-white">Data Kesehatan</th></tr>
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
                            <tr><th colspan="2" class="text-center bg-primary text-white">Data Pekerjaan</th></tr>
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
                            <tr><th colspan="2" class="text-center bg-primary text-white">Data Keberangkatan</th></tr>
                            <tr>
                                <th>Rencana Keberangkatan</th>
                                <td>{{ $jamaah->jadwal->nama_jadwal ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Pengalaman Umroh</th>
                                <td>{{ $jamaah->pengalaman_umroh }}</td>
                            </tr>
                            <tr>
                                <th>Tahun Terakhir Umroh</th>
                                <td>{{ $jamaah->terahir_tahun ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Paket Umroh</th>
                                <td>{{ $jamaah->paket_umroh }}</td>
                            </tr>
                            <tr>
                                <th>Program</th>
                                <td>{{ $jamaah->program }}</td>
                            </tr>

                            <!-- Data Keluarga -->
                            <tr><th colspan="2" class="text-center bg-primary text-white">Data Keluarga</th></tr>
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

                            <!-- Metadata -->
                            <tr><th colspan="2" class="text-center bg-primary text-white">Informasi Tambahan</th></tr>
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

    @include('validasi.notifikasi')
    @include('validasi.notifikasi-error')
@endsection