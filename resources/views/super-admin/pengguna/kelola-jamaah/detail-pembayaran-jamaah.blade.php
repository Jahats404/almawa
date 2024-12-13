@extends('layouts.master')

@section('content')
    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between mb-4">
        <!-- Judul Halaman -->
        <h1 class="h3 mb-3 mb-md-0 text-gray-800">Detail Pembayaran</h1>
        <!-- Tombol -->
        <a href="{{ route('sa.detail.jamaah', ['id' => $idJamaah]) }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-xl-12 col-md-6 mb-4">
            
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="card-header py-3 d-flex flex-wrap align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary flex-grow-1">Upload bukti pembayaran</h6>
                    </div>
                </div>
        
                <div class="card-body">
                    <form action="{{ route('sa.store.pembayaran.jamaah') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="pembayaran_id" value="{{ $id }}">
                        <div class="form-row">
                            <!-- Jumlah Bayar -->
                            <div class="form-group col-md-12">
                                <label for="jumlah">Jumlah Bayar <span class="text-danger">*</span></label>
                                <input 
                                    type="number" 
                                    name="jumlah" 
                                    min="1"
                                    value="{{ old('jumlah') }}" 
                                    class="form-control">
                                @error('jumlah')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <!-- Upload Bukti Pembayaran -->
                            <div class="form-group col-md-12">
                                <label for="name">Upload Bukti Pembayaran <span class="text-danger">*</span></label>
                                <input 
                                    type="file" 
                                    name="bukti_pembayaran" 
                                    value="{{ old('bukti_pembayaran') }}" 
                                    class="form-control" 
                                    id="bukti_pembayaran">
                                @error('bukti_pembayaran')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-md-6 mb-4">
            <!-- Detail Pembayaran -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="card-header py-3 d-flex flex-wrap align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary flex-grow-1">Detail Pembayaran</h6>
                    </div>
                </div>
        
                <div class="card-body">
                    @if (!$detail->isEmpty())
                        <div class="table-responsive">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5 class="text-gray-800">Data Pembayaran</h5>
                                <span class="text-gray-100 fw-bold badge badge-dark">Sisa Tagihan: Rp {{ number_format($sisaTagihan, 0, ',', '.') }}</span>
                            </div>
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Jumlah Yang Harus Dibayar</th>
                                        <th>Jumlah Bayar</th>
                                        {{-- <th>Sisa Tagihan</th> --}}
                                        <th>Pengirim</th>
                                        <th>Disetujui Oleh</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detail as $item)
                                        <tr class="text-center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</td>
                                            <td>{{ 'Rp ' . number_format($item->pembayaran_jamaah->jumlah_bayar, 0, ',', '.') }}</td>
                                            <td>{{ 'Rp ' . number_format($item->jumlah, 0, ',', '.') }}</td>
                                            {{-- <td>{{ 'Rp ' . number_format($item->sisa_tagihan, 0, ',', '.') }}</td> --}}
                                            <td>{{ $item->users->name ?? '-' }}</td>
                                            <td>{{ $item->validator->name ?? '-' }}</td>
                                            <td>
                                                @if ($item->status == null)
                                                    -
                                                @elseif ($item->status == 'Pending')
                                                    <span class="badge badge-info">{{ $item->status }}</span>
                                                @elseif ($item->status == 'Diterima')
                                                    <span class="badge badge-success">{{ $item->status }}</span>
                                                @elseif ($item->status == 'Ditolak')
                                                    <span class="badge badge-danger">{{ $item->status }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href="#" class="btn btn-warning btn-circle btn-sm mr-2" data-toggle="modal" data-target="#modalLihat{{ $item->id_detail_pembayaran_jamaah }}" title="Lihat">
                                                        <i class="fas fa-file-image"></i>
                                                    </a>
                                                    <form action="{{ route('sa.status.pembayaran.jamaah', ['id' => $item->id_detail_pembayaran_jamaah]) }}" method="POST" class="delete-form">
                                                        @csrf
                                                        @method('put')
                                                        <input type="hidden" name="status" value="Diterima">
                                                        <button type="submit" class="btn btn-primary btn-circle btn-sm status-btn mr-2" title="Terima">
                                                            <i class="fas fa-solid fa-check-circle"></i>
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('sa.status.pembayaran.jamaah', ['id' => $item->id_detail_pembayaran_jamaah]) }}" method="POST" class="delete-form">
                                                        @csrf
                                                        @method('put')
                                                        <input type="hidden" name="status" value="Ditolak">
                                                        <button type="submit" class="btn btn-danger btn-circle btn-sm status-btn" title="Tolak">
                                                            <i class="fas fa-file-excel"></i>
                                                        </button>
                                                    </form>
                                                    <!-- Modal lihat -->
                                                    <div class="modal fade" id="modalLihat{{ $item->id_detail_pembayaran_jamaah }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="staticBackdropLabel">Lihat Bukti Pembayaran</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body text-center">
                                                                    @if (!empty($item->bukti_pembayaran))
                                                                        <img src="{{ asset('storage/' . $item->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="img-fluid rounded">
                                                                    @else
                                                                        <p>Bukti pembayaran tidak tersedia.</p>
                                                                    @endif
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        {{-- SweetAlert Delete --}}
                                        <script>
                                            // Pilih semua tombol dengan kelas delete-btn
                                            document.querySelectorAll('.status-btn').forEach(button => {
                                                button.addEventListener('click', function (e) {
                                                    e.preventDefault(); // Mencegah pengiriman form langsung
                                        
                                                    const form = this.closest('form'); // Ambil form terdekat dari tombol yang diklik
                                        
                                                    Swal.fire({
                                                        title: 'Apakah anda ingin mengubah status?',
                                                        icon: 'warning',
                                                        showCancelButton: true,
                                                        confirmButtonColor: '#d33',
                                                        cancelButtonColor: '#3085d6',
                                                        confirmButtonText: 'Ya, ubah!',
                                                        cancelButtonText: 'Batal'
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            form.submit(); // Kirim form jika pengguna mengonfirmasi
                                                        }
                                                    });
                                                });
                                            });
                                        </script>

                                        <!-- Modal Edit -->
                                        {{-- @include('jamaah.pendaftaran.update-pendaftaran', ['item' => $item]) --}}
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-danger">Belum ada pembayaran.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('validasi.notifikasi')
    @include('validasi.notifikasi-error')
@endsection
