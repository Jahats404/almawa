@extends('layouts.master')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Pengajuan Agen</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex">
                <h6 class="m-0 font-weight-bold text-primary">Pengajuan Agen</h6>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>No Registrasi</th>
                            <th>No KTP</th>
                            <th>Nama Lengkap</th>
                            {{-- <th style="width: 150px;">Tanggal Lahir</th> --}}
                            <th>Umur</th>
                            <th>Jenis Kelamin</th>
                            <th>Pekerjaan</th>
                            <th>Rekomendasi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($agen as $item)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->agen->no_registrasi }}</td>
                                <td>{{ $item->agen->ktp }}</td>
                                <td>{{ $item->agen->nama_lengkap }}</td>
                                {{-- <td style="width: 150px">{{ \Carbon\Carbon::parse($item->agen->tanggal_lahir)->locale('id')->isoFormat('D MMMM YYYY') }}</td> --}}
                                <td>{{ $item->agen->umur }}</td>
                                <td>{{ $item->agen->jenis_kelamin }}</td>
                                <td>{{ $item->agen->pekerjaan }}</td>
                                <td>{{ $item->agen->supervisor->name ?? '-' }}</td>
                                <td>
                                    @if ($item->agen->status == 'Diajukan')
                                        <span class="badge badge-info">{{ $item->agen->status }}</span>
                                    @elseif ($item->agen->status == 'Ditolak')
                                        <span class="badge badge-danger">{{ $item->agen->status }}</span>
                                    @else
                                        {{ $item->agen->status ?? '-' }}
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('marketing.detail.agen', ['id' => $item->agen->no_registrasi]) }}" class="btn btn-success btn-circle btn-sm mr-2" title="Detail">
                                            <i class="fas fa-solid fa-eye"></i>
                                        </a>
                                        <div class="btn-group mr-2">
                                            <button type="button" title="Aksi" class="btn btn-info btn-circle btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-solid fa-spinner"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <form action="{{ route('marketing.ubah.status.agen', ['id' => $item->agen->no_registrasi]) }}" method="post">
                                                    @csrf
                                                    <button class="dropdown-item" type="submit">Terima</button>
                                                </form>
                                                <form action="{{ route('marketing.ubah.status.agen', ['id' => $item->agen->no_registrasi]) }}" method="post">
                                                    @csrf
                                                    <button class="dropdown-item" type="submit">Tolak</button>
                                                </form>
                                            </div>
                                        </div>
                                        <form action="{{ route('marketing.delete.agen', ['id' => $item->agen->no_registrasi]) }}" method="POST" class="delete-form">
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
                            @include('super-admin.pengguna.kelola-agen.modal-update-agen', ['item' => $item->agen])
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    @include('validasi.notifikasi')
    @include('validasi.notifikasi-error')
@endsection