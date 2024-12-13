@extends('layouts.master')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">List Pendaftaran</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-wrap align-items-center">
            <h6 class="m-0 font-weight-bold text-primary flex-grow-1">List Pendaftaran</h6>
            <a href="{{ route('jamaah.pendaftaran') }}" class="btn btn-sm btn-primary shadow-sm mt-2 mt-md-0">
                <i class="fas fa-solid fa-registered fa-sm text-white-50"></i> Daftarkan Diri Anda
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>ID Pendaftaran</th>
                            <th>Paket</th>
                            <th>Jadwal</th>
                            <th>Pesawat</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Rekomendasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $item)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->id_pendaftaran }}</td>
                                <td>{{ $item->paket->nama_paket }}</td>
                                <td>{{ $item->jadwal->jadwal ?? '-' }}</td>
                                <td>{{ $item->jadwal->pesawat ?? '-' }}</td>
                                <td>{{ 'Rp ' . number_format($item->paket->harga, 0, ',', '.') }}</td>
                                <td>
                                    @if ($item->status == 'Diterima')
                                        <span class="badge badge-success">{{ $item->status }}</span>
                                    @elseif ($item->status == 'Ditolak')
                                        <span class="badge badge-danger">{{ $item->status }}</span>
                                    @elseif ($item->status == 'Diajukan')
                                        <span class="badge badge-info">{{ $item->status }}</span>
                                    @endif
                                </td>
                                <td>{{ $item->supervisor->name ?? '-' }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('jamaah.pendaftaran.detail', ['id' => $item->id_pendaftaran]) }}" class="btn btn-success btn-circle btn-sm mr-2" title="Detail">
                                            <i class="fas fa-solid fa-eye"></i>
                                        </a>
                                        <div class="btn-group mr-2">
                                            <button type="button" title="Aksi" class="btn btn-info btn-circle btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-solid fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#modalEdit{{ $item->id_pendaftaran }}" title="Update">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                </a>
                                                <form action="{{ route('jamaah.pendaftaran.delete', ['id' => $item->id_pendaftaran]) }}" method="POST" class="delete-form">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="dropdown-item" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
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

                            <!-- Modal Edit -->
                            @include('jamaah.pendaftaran.update-pendaftaran', ['item' => $item])
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    @include('validasi.notifikasi')
    @include('validasi.notifikasi-error')
@endsection