@extends('layouts.master')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Agen</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="card-header py-3 d-flex flex-wrap align-items-center">
                <h6 class="m-0 font-weight-bold text-primary flex-grow-1">Detail Agen</h6>
                <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary shadow-sm mt-2 mt-md-0">
                    <i class="fas fa-solid fa-arrow-left fa-sm text-white-50"></i> Kembali
                </a>
            </div>
        </div>

        <div class="card-body">
            @if ($agen)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>No Registrasi</th>
                                <td>{{ $agen->no_registrasi }}</td>
                            </tr>
                            <tr>
                                <th>Nama Lengkap</th>
                                <td>{{ $agen->nama_lengkap }}</td>
                            </tr>
                            <tr>
                                <th>Nama Ayah Kandung</th>
                                <td>{{ $agen->nama_ayah_kandung }}</td>
                            </tr>
                            <tr>
                                <th>Tempat Lahir</th>
                                <td>{{ $agen->tempat_lahir }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Lahir</th>
                                <td>{{ $agen->tanggal_lahir }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>{{ $agen->jenis_kelamin }}</td>
                            </tr>
                            <tr>
                                <th>Umur</th>
                                <td>{{ $agen->umur }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $agen->alamat }}</td>
                            </tr>
                            <tr>
                                <th>Desa</th>
                                <td>{{ $agen->desa }}</td>
                            </tr>
                            <tr>
                                <th>Kecamatan</th>
                                <td>{{ $agen->kecamatan }}</td>
                            </tr>
                            <tr>
                                <th>Kabupaten</th>
                                <td>{{ $agen->kabupaten }}</td>
                            </tr>
                            <tr>
                                <th>Provinsi</th>
                                <td>{{ $agen->provinsi }}</td>
                            </tr>
                            <tr>
                                <th>No Telepon</th>
                                <td>{{ $agen->no_telp }}</td>
                            </tr>
                            <tr>
                                <th>Pekerjaan</th>
                                <td>{{ $agen->pekerjaan }}</td>
                            </tr>
                            <tr>
                                <th>Nama Perusahaan</th>
                                <td>{{ $agen->nama_perusahaan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Bidang Perusahaan</th>
                                <td>{{ $agen->bidang_perusahaan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Alamat Perusahaan</th>
                                <td>{{ $agen->alamat_perusahaan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>No Telepon Perusahaan</th>
                                <td>{{ $agen->no_telp_perusahaan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Jabatan</th>
                                <td>{{ $agen->jabatan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>File KTP</th>
                                <td>
                                    @if ($agen->file_ktp)
                                        <a href="{{ asset('storage/' . $agen->file_ktp) }}" target="_blank">Lihat File KTP</a>
                                    @else
                                        Tidak Ada File
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>File Pembayaran</th>
                                <td>
                                    @if ($agen->file_pembayaran)
                                        <a href="{{ asset('storage/' . $agen->file_pembayaran) }}" target="_blank">Lihat File Pembayaran</a>
                                    @else
                                        Tidak Ada File
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Dibuat Pada</th>
                                <td>{{ \Carbon\Carbon::parse($agen->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-danger">Data agen tidak ditemukan.</p>
            @endif
        </div>
    </div>

    @include('validasi.notifikasi')
    @include('validasi.notifikasi-error')
@endsection
