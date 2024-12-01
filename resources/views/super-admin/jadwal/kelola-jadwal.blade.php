@extends('layouts.master')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Jadwal</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-wrap align-items-center">
            <h6 class="m-0 font-weight-bold text-primary flex-grow-1">Daftar Jadwal</h6>
            <button type="button" class="btn btn-sm btn-primary shadow-sm mt-2 mt-md-0" data-toggle="modal" data-target="#modalTambah">
                <i class="fas fa-solid fa-clock fa-sm text-white-50"></i> Tambah Jadwal
            </button>
        </div>
        

        <!-- Modal Tambah -->
        {{-- @include('super-admin.pengguna.kelola-jamaah.modal-tambah-jamaah') --}}
        <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Jadwal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('sa.tambah.jadwal') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <!-- Jadwal Keberangkatan -->
                            <div class="form-group col-md-12">
                                <label for="jadwal">Jadwal Keberangkatan <span class="text-danger">*</span></label>
                                <input 
                                    type="datetime-local" 
                                    name="jadwal" 
                                    value="{{ old('jadwal') }}" 
                                    class="form-control" 
                                    id="jadwal">
                                @error('jadwal')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <!-- Pesawat -->
                            <div class="form-group col-md-12">
                                <label for="pesawat">Pesawat <span class="text-danger">*</span></label>
                                <input 
                                    type="text" 
                                    name="pesawat" 
                                    value="{{ old('pesawat') }}" 
                                    class="form-control" 
                                    id="pesawat">
                                @error('pesawat')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-row">
                                <!-- Makkah -->
                                <div class="form-group col-md-6">
                                    <label for="jadwal">Hotel Makkah <span class="text-danger">*</span></label>
                                    <input 
                                        type="text" 
                                        name="makkah" 
                                        value="{{ old('makkah') }}" 
                                        class="form-control" 
                                        id="makkah">
                                    @error('makkah')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Madinah -->
                                <div class="form-group col-md-6">
                                    <label for="jadwal">Hotel Madinah <span class="text-danger">*</span></label>
                                    <input 
                                        type="text" 
                                        name="madinah" 
                                        value="{{ old('madinah') }}" 
                                        class="form-control" 
                                        id="madinah">
                                    @error('madinah')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Jadwal</th>
                            <th>Pesawat</th>
                            <th>Makkah</th>
                            <th>Madinah</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwal as $item)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->jadwal)->translatedFormat('d F Y, H:i') }}</td>
                                <td>{{ $item->pesawat }}</td>
                                <td>{{ $item->makkah }}</td>
                                <td>{{ $item->madinah }}</td>
                                <td>{{ $item->status }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="#" class="btn btn-warning btn-circle btn-sm mr-2" data-toggle="modal" data-target="#modalEdit{{ $item->id_jadwal }}" title="Update">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </a>
                                        <form action="{{ route('sa.destroy.jadwal', ['id' => $item->id_jadwal]) }}" method="POST" class="delete-form">
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
                            {{-- @include('super-admin.pengguna.kelola-jamaah.modal-update-jamaah', ['item' => $item->agen]) --}}
                            <div class="modal fade" id="modalEdit{{ $item->id_jadwal }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Jadwal</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('sa.update.jadwal', ['id' => $item->id_jadwal]) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <div class="modal-body">
                                                <input type="hidden" name="status" value="{{ $item->status }}">
                                                <!-- Jadwal Keberangkatan -->
                                                <div class="form-group col-md-12">
                                                    <label for="jadwal">Jadwal Keberangkatan <span class="text-danger">*</span></label>
                                                    <input 
                                                        type="datetime-local" 
                                                        name="jadwal" 
                                                        value="{{ old('jadwal', $item->jadwal)  }}" 
                                                        class="form-control" 
                                                        id="jadwal">
                                                    @error('jadwal')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <!-- Pesawat -->
                                                <div class="form-group col-md-12">
                                                    <label for="pesawat">Pesawat <span class="text-danger">*</span></label>
                                                    <input 
                                                        type="text" 
                                                        name="pesawat" 
                                                        value="{{ old('pesawat', $item->pesawat) }}" 
                                                        class="form-control" 
                                                        id="pesawat">
                                                    @error('pesawat')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="form-row">
                                                    <!-- Makkah -->
                                                    <div class="form-group col-md-6">
                                                        <label for="jadwal">Hotel Makkah <span class="text-danger">*</span></label>
                                                        <input 
                                                            type="text" 
                                                            name="makkah" 
                                                            value="{{ old('makkah', $item->makkah) }}" 
                                                            class="form-control" 
                                                            id="makkah">
                                                        @error('makkah')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <!-- Madinah -->
                                                    <div class="form-group col-md-6">
                                                        <label for="jadwal">Hotel Madinah <span class="text-danger">*</span></label>
                                                        <input 
                                                            type="text" 
                                                            name="madinah" 
                                                            value="{{ old('madinah', $item->madinah) }}" 
                                                            class="form-control" 
                                                            id="madinah">
                                                        @error('madinah')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
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