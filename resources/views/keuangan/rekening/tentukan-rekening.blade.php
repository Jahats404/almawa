@extends('layouts.master')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tentukan Pembayaran Jamaah</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-wrap align-items-center">
            <h6 class="m-0 font-weight-bold text-primary flex-grow-1">Daftar Pembayaran Jamaah</h6>
            {{-- <button type="button" class="btn btn-sm btn-primary shadow-sm mt-2 mt-md-0" data-toggle="modal" data-target="#modalTambah">
                <i class="fas fa-solid fa-clock fa-sm text-white-50"></i> Tambah Transaksi Jamaah
            </button> --}}
        </div>
        

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama Jamaah</th>
                            <th>Jenis Paket</th>
                            <th>Jumlah Bayar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detailPembayaran as $item)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</td>
                                <td>{{ $item->pembayaran_jamaah->jamaah->nama_lengkap }}</td>
                                <td>{{ $item->pembayaran_jamaah->jamaah->paket->nama_paket }}</td>
                                <td>{{ 'Rp ' . number_format($item->jumlah, 0, ',', '.') }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="#" class="btn btn-info btn-circle btn-sm mr-2" data-toggle="modal" data-target="#modalTentukan{{ $item->id_detail_pembayaran_jamaah }}" title="Update">
                                            <i class="fas fa-file-invoice-dollar"></i>
                                        </a>
                                        {{-- <form action="{{ route('keuangan.destroy.rekening', ['id' => $item->id_rekening]) }}" method="POST" class="delete-form">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-circle btn-sm delete-btn mr-2" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form> --}}
                                    </div>
                                </td>
                            </tr>
                            
                            {{-- SweetAlert Delete --}}
                            <script>
                                // Pilih semua tombol dengan kelas delete-btn
                                document.querySelectorAll('.delete-btn').forEach(button => {
                                    button.addEventListener('click', function (e) {
                                        e.preventDefault(); // Mencegah pengiriman form langsung
                            
                                        const form = this.closest('form'); // Ambil form terdekat dari tombol yang diklik
                            
                                        Swal.fire({
                                            title: 'Apakah data ini akan dihapus?',
                                            text: "Data yang dihapus tidak dapat dikembalikan!",
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#d33',
                                            cancelButtonColor: '#3085d6',
                                            confirmButtonText: 'Ya, hapus!',
                                            cancelButtonText: 'Batal'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                form.submit(); // Kirim form jika pengguna mengonfirmasi
                                            }
                                        });
                                    });
                                });
                            </script>

                            <div class="modal fade" id="modalTentukan{{ $item->id_detail_pembayaran_jamaah }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Pilih Rekening <span class="font-weight-bold">{{ $item->pembayaran_jamaah->jamaah->nama_lengkap }}</span></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('keuangan.tambah.transaksi') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            {{-- <div class="form-group col-md-12">
                                                <span class="text-gray-600 font-weight-bold">{{ $item->pembayaran_jamaah->jamaah->nama_lengkap }}</span>
                                            </div> --}}
                                            <div class="modal-body">
                                                <!-- Debit -->
                                                <div class="form-group col-md-12">
                                                    <label for="debit">Debit</label>
                                                    <input 
                                                        type="number"
                                                        min="0"
                                                        name="debit" 
                                                        value="{{ old('debit')  }}" 
                                                        class="form-control" 
                                                        id="debit">
                                                    @error('debit')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <!-- kredit -->
                                                <div class="form-group col-md-12">
                                                    <label for="kredit">Kredit</label>
                                                    <input 
                                                        type="number"
                                                        min="0"
                                                        name="kredit" 
                                                        value="{{ old('kredit')  }}" 
                                                        class="form-control" 
                                                        id="kredit">
                                                    @error('kredit')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <!-- Rekening -->
                                                <div class="form-group col-md-12">
                                                    <label for="Rekening">Pilih Rekening <span class="text-danger">*</span></label>
                                                    <select class="form-control" name="rekening_id" id="rekening_id">
                                                        <option value="">-- Pilih Rekening --</option>
                                                        @foreach ($rekening as $rek)
                                                        <option 
                                                            value="{{ $rek->id_rekening }}" 
                                                            {{ old('rencana_keberangkatan') == $rek->id_rekening ? 'selected' : '' }}>
                                                            {{ $rek->nama_rekening }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @error('rekening_id')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                {{-- Keterangan --}}
                                                <label for="keterangan">Keterangan</label>
                                                <div class="form-group col-md-12">
                                                    <textarea name="keterangan" id="keterangan" class="form-control" cols="10" rows="7"></textarea>
                                                </div>
                                                <input type="hidden" name="detail_pembayaran_jamaah_id" value="{{ $item->id_detail_pembayaran_jamaah }}" id="">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    @include('validasi.notifikasi')
    @include('validasi.notifikasi-error')
@endsection