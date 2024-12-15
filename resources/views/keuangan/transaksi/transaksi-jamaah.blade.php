@extends('layouts.master')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Transaksi Jamaah</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-wrap align-items-center">
            <h6 class="m-0 font-weight-bold text-primary flex-grow-1">Daftar Transaksi Jamaah</h6>
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
                            <th>ID Transaksi</th>
                            <th>Debit</th>
                            <th>Kredit</th>
                            <th>Rekening</th>
                            <th>Jamaah</th>
                            <th>Nominal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $item)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->detail_pembayaran_jamaah->tanggal)->locale('id')->isoFormat('D MMMM YYYY') }}</td>
                                <td>{{ $item->id_transaksi }}</td>
                                <td>{{ $item->debit !== null ? 'Rp. ' . number_format($item->debit, 0, ',', '.') : '-' }}</td>
                                <td>{{ $item->kredit !== null ? 'Rp. ' . number_format($item->kredit, 0, ',', '.') : '-' }}</td>
                                <td>{{ $item->rekening->nama_rekening }}</td>
                                <td>{{ $item->detail_pembayaran_jamaah->pembayaran_jamaah->jamaah->nama_lengkap }}</td>
                                <td>{{ $item->detail_pembayaran_jamaah !== null ? 'Rp. ' . number_format($item->detail_pembayaran_jamaah->jumlah, 0, ',', '.') : '-' }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        {{-- <a href="#" class="btn btn-warning btn-circle btn-sm mr-2" data-toggle="modal" data-target="#modalEdit{{ $item->id_transaksi }}" title="Update">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </a> --}}
                                        <form action="{{ route('keuangan.destroy.transaksi', ['id' => $item->id_transaksi]) }}" method="POST" class="delete-form">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-circle btn-sm delete-btn mr-2" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    @include('validasi.notifikasi')
    @include('validasi.notifikasi-error')
@endsection