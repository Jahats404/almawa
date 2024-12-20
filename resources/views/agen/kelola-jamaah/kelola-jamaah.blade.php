@extends('layouts.master')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Jamaah</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-wrap align-items-center">
            <h6 class="m-0 font-weight-bold text-primary flex-grow-1">Daftar Jamaah</h6>
            <button type="button" class="btn btn-sm btn-primary shadow-sm mt-2 mt-md-0" data-toggle="modal" data-target="#modalTambah">
                <i class="fas fa-solid fa-clock fa-sm text-white-50"></i> Tambah Jamaah
            </button>
        </div>

        <!-- Modal Tambah -->
        @include('agen.kelola-jamaah.modal-tambah-jamaah')

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>ID Pendaftaran</th>
                            <th>No KTP</th>
                            <th>Nama Lengkap</th>
                            {{-- <th>Tanggal Lahir</th> --}}
                            <th>Umur</th>
                            <th>Jenis Kelamin</th>
                            <th>Pekerjaan</th>
                            <th>Ordal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jamaah as $item)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->id_pendaftaran }}</td>
                                <td>{{ $item->ktp }}</td>
                                <td>{{ $item->nama_lengkap }}</td>
                                {{-- <td>{{ \Carbon\Carbon::parse($item->tanggal_lahir)->locale('id')->isoFormat('D MMMM YYYY') }}</td> --}}
                                <td>{{ $item->umur }}</td>
                                <td>{{ $item->jenis_kelamin }}</td>
                                <td>{{ $item->pekerjaan }}</td>
                                <td>{{ $item->supervisor->name ?? '-' }}</td>
                                <td>
                                    @if ($item->status == 'Ditolak')
                                        <span class="badge badge-danger">{{ $item->status }}</span>
                                    @elseif ($item->status == 'Diajukan')
                                        <span class="badge badge-info">{{ $item->status }}</span>
                                    @elseif ($item->status == 'Diterima')
                                        <span class="badge badge-success">{{ $item->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('agen.detail.jamaah', ['id' => $item->id_pendaftaran]) }}" class="btn btn-success btn-circle btn-sm mr-2" title="Detail">
                                            <i class="fas fa-solid fa-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-warning btn-circle btn-sm mr-2" data-toggle="modal" data-target="#modalEdit{{ $item->id_pendaftaran }}" title="Update">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </a>
                                        <form action="{{ route('agen.delete.jamaah', ['id' => $item->id_pendaftaran]) }}" method="POST" class="delete-form">
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

                            <!-- Modal Edit -->
                            @include('agen.kelola-jamaah.modal-update-jamaah', ['item' => $item])
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    @include('validasi.notifikasi')
    @include('validasi.notifikasi-error')
@endsection