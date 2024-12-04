@extends('layouts.master')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Lengkapi Data</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="card-header py-3 d-flex flex-wrap align-items-center">
                <h6 class="m-0 font-weight-bold text-primary flex-grow-1">Lengkapi Data</h6>
                <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary shadow-sm mt-2 mt-md-0">
                    <i class="fas fa-solid fa-arrow-left fa-sm text-white-50"></i> Kembali
                </a>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('agen.action.lengkapi.data') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <!-- No Registrasi Agen -->
                    <h3 class="font-weight-bold text-primary">DATA PRIBADI</h3>
                    <hr>
                    <div class="form-row">
                        {{-- <div class="form-group col-md-6">
                            <label for="name">No Registrasi Agen <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                name="no_registrasi" 
                                value="{{ old('no_registrasi') }}" 
                                class="form-control" 
                                id="no_registrasi">
                            @error('no_registrasi')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div> --}}
                        
                        <!-- No KTP -->
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">No KTP <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                name="ktp" 
                                value="{{ old('ktp') }}" 
                                class="form-control">
                            @error('ktp')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <!-- Nama Lengkap -->
                        <div class="form-group col-md-6">
                            <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                name="nama_lengkap" 
                                value="{{ old('nama_lengkap', $user->name) }}" 
                                class="form-control" 
                                id="nama_lengkap">
                            @error('nama_lengkap')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
    
                        <!-- Nama Ayah Kandung -->
                        <div class="form-group col-md-6">
                            <label for="name">Nama Ayah Kandung <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                name="nama_ayah_kandung" 
                                value="{{ old('nama_ayah_kandung') }}" 
                                class="form-control" 
                                id="nama_ayah_kandung">
                            @error('nama_ayah_kandung')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <!-- Tempat Lahir -->
                        <div class="form-group col-md-6">
                            <label for="name">Tempat Lahir <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                name="tempat_lahir" 
                                value="{{ old('tempat_lahir') }}" 
                                class="form-control" 
                                id="tempat_lahir">
                            @error('tempat_lahir')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
    
                        <!-- Jenis Kelamin -->
                        <div class="form-group col-md-6">
                            <label for="Jenis Kelamin">Pilih Jenis Kelamin <span class="text-danger">*</span></label>
                            <select class="form-control" name="jenis_kelamin" id="role">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="Pria" {{ old('jenis_kelamin') == 'Pria' ? 'selected' : '' }}>Pria</option>
                                    <option value="Wanita" {{ old('jenis_kelamin') == 'Wanita' ? 'selected' : '' }}>Wanita</option>
                            </select>
                            @error('jenis_kelamin')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <!-- Tanggal Lahir -->
                        <div class="form-group col-md-6">
                            <label for="tanggal_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input 
                                type="date" 
                                name="tanggal_lahir" 
                                value="{{ old('tanggal_lahir') }}" 
                                class="form-control" 
                                id="tanggal_lahir">
                            @error('tanggal_lahir')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Umur -->
                        <div class="form-group col-md-6">
                            <label for="umur">Umur <span class="text-danger">*</span></label>
                            <input 
                                type="number" 
                                name="umur" 
                                value="{{ old('umur') }}" 
                                class="form-control" 
                                id="umur" 
                                readonly>
                            @error('umur')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    {{-- javascript Umur --}}
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const tanggalLahirInput = document.getElementById('tanggal_lahir');
                            const umurInput = document.getElementById('umur');
                    
                            // Fungsi untuk menghitung umur
                            function hitungUmur(tanggalLahir) {
                                const today = new Date();
                                const birthDate = new Date(tanggalLahir);
                                let umur = today.getFullYear() - birthDate.getFullYear();
                                const monthDiff = today.getMonth() - birthDate.getMonth();
                                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                                    umur--;
                                }
                                return umur;
                            }
                    
                            // Event listener untuk input tanggal lahir
                            tanggalLahirInput.addEventListener('change', function () {
                                const tanggalLahir = this.value;
                                if (tanggalLahir) {
                                    const umur = hitungUmur(tanggalLahir);
                                    umurInput.value = umur > 0 ? umur : 0; // Jika umur negatif, set ke 0
                                } else {
                                    umurInput.value = ''; // Kosongkan jika tanggal lahir dihapus
                                }
                            });
                        });
                    </script>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="exampleInputEmail1">Alamat Email <span class="text-danger">*</span></label>
                        <input 
                            type="email" 
                            name="email" 
                            value="{{ old('email', $user->email) }}" 
                            class="form-control" 
                            id="exampleInputEmail1">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <hr>
                    <h3 class="font-weight-bold text-primary">ALAMAT</h3>
                    <p class="text-muted font-weight-bold">Alamat sesuai dengan KTP</p>
                    <hr>

                    <div class="form-row">
                        <!-- Alamat -->
                        <div class="form-group col-md-6">
                            <label for="name">Alamat <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                name="alamat" 
                                value="{{ old('alamat') }}" 
                                class="form-control" 
                                id="alamat">
                            @error('alamat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
    
                        <!-- Desa -->
                        <div class="form-group col-md-6">
                            <label for="name">Desa <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                name="desa" 
                                value="{{ old('desa') }}" 
                                class="form-control" 
                                id="desa">
                            @error('desa')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <!-- Kecamatan -->
                        <div class="form-group col-md-6">
                            <label for="name">Kecamatan <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                name="kecamatan" 
                                value="{{ old('kecamatan') }}" 
                                class="form-control" 
                                id="kecamatan">
                            @error('kecamatan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
    
                        <!-- Kabupaten -->
                        <div class="form-group col-md-6">
                            <label for="name">Kabupaten/Kota <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                name="kabupaten" 
                                value="{{ old('kabupaten') }}" 
                                class="form-control" 
                                id="kabupaten">
                            @error('kabupaten')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <!-- Provinsi -->
                        <div class="form-group col-md-6">
                            <label for="name">Provinsi <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                name="provinsi" 
                                value="{{ old('provinsi') }}" 
                                class="form-control" 
                                id="provinsi">
                            @error('provinsi')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
    
                        <!-- No TELP -->
                        <div class="form-group col-md-6">
                            <label for="name">No TELP <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                name="no_telp" 
                                value="{{ old('no_telp') }}" 
                                class="form-control" 
                                id="no_telp">
                            @error('no_telp')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <!-- Upload KTP -->
                        <div class="form-group col-md-6">
                            <label for="name">Upload KTP <span class="text-danger">*</span></label>
                            <input 
                                type="file" 
                                name="file_ktp" 
                                value="{{ old('file_ktp') }}" 
                                class="form-control" 
                                id="file_ktp">
                            @error('file_ktp')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
    
                        <!-- Upload Bukti Pembayaran -->
                        <div class="form-group col-md-6">
                            <label for="name">Upload Bukti Pembayaran <span class="text-danger">*</span></label>
                            <input 
                                type="file" 
                                name="file_pembayaran" 
                                value="{{ old('file_pembayaran') }}" 
                                class="form-control" 
                                id="file_pembayaran">
                            @error('file_pembayaran')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <hr>
                    <h3 class="font-weight-bold text-primary">DATA PERUSAHAAN</h3>
                    <hr>

                    <!-- Pekerjaan -->
                    <div class="form-group">
                        <label for="pekerjaan">Pilih Pekerjaan <span class="text-danger">*</span></label>
                        <select class="form-control" name="pekerjaan" id="pekerjaan">
                            <option value="">-- Pilih Pekerjaan --</option>
                            <option value="PNS" {{ old('pekerjaan') == 'PNS' ? 'selected' : '' }}>PNS</option>
                            <option value="Peg. Swasta" {{ old('pekerjaan') == 'Peg. Swasta' ? 'selected' : '' }}>Peg. Swasta</option>
                            <option value="ABRI" {{ old('pekerjaan') == 'ABRI' ? 'selected' : '' }}>ABRI</option>
                            <option value="BUMN" {{ old('pekerjaan') == 'BUMN' ? 'selected' : '' }}>BUMN</option>
                            <option value="Wiraswasta" {{ old('pekerjaan') == 'Wiraswasta' ? 'selected' : '' }}>Wiraswasta</option>
                            <option value="Pelajar" {{ old('pekerjaan') == 'Pelajar' ? 'selected' : '' }}>Pelajar</option>
                            <option value="Mahasiswa" {{ old('pekerjaan') == 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                            <option value="Ibu Rumah Tangga" {{ old('pekerjaan') == 'Ibu Rumah Tangga' ? 'selected' : '' }}>Ibu Rumah Tangga</option>
                            <option value="Pensiunan" {{ old('pekerjaan') == 'Pensiunan' ? 'selected' : '' }}>Pensiunan</option>
                            <option value="Lainnya" {{ old('pekerjaan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('pekerjaan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <!-- Input untuk pekerjaan lainnya -->
                    <div class="form-group" id="pekerjaanLainnyaContainer" style="display: none;">
                        <label for="pekerjaan_lainnya">Masukkan Pekerjaan Lainnya</label>
                        <input type="text" class="form-control" name="pekerjaan_lainnya" id="pekerjaan_lainnya" value="{{ old('pekerjaan_lainnya') }}" placeholder="Pekerjaan Lainnya">
                        @error('pekerjaan_lainnya')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <script>
                        // JavaScript untuk menampilkan/menghilangkan input teks
                        document.getElementById('pekerjaan').addEventListener('change', function () {
                            const pekerjaanLainnyaContainer = document.getElementById('pekerjaanLainnyaContainer');
                            if (this.value === 'Lainnya') {
                                pekerjaanLainnyaContainer.style.display = 'block';
                            } else {
                                pekerjaanLainnyaContainer.style.display = 'none';
                                document.getElementById('pekerjaan_lainnya').value = ''; // Reset input jika tidak dipilih
                            }
                        });
                    
                        // Menampilkan kembali input teks jika opsi "Lainnya" sudah dipilih sebelumnya (untuk edit form)
                        if (document.getElementById('pekerjaan').value === 'Lainnya') {
                            document.getElementById('pekerjaanLainnyaContainer').style.display = 'block';
                        }
                    </script>


                    <!-- Nama Perusahaan -->
                    <div class="form-group">
                        <label for="name">Nama Perusahaan</label>
                        <input 
                            type="text" 
                            name="nama_perusahaan" 
                            value="{{ old('nama_perusahaan') }}" 
                            class="form-control" 
                            id="nama_perusahaan">
                        @error('nama_perusahaan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="form-row">
                        <!-- Bidang Perusahaan -->
                        <div class="form-group col-md-6">
                            <label for="name">Bidang Perusahaan</label>
                            <input 
                                type="text" 
                                name="bidang_perusahaan" 
                                value="{{ old('bidang_perusahaan') }}" 
                                class="form-control" 
                                id="bidang_perusahaan">
                            @error('bidang_perusahaan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
    
                        <!-- Alamat Perusahaan -->
                        <div class="form-group col-md-6">
                            <label for="name">Alamat Perusahaan</label>
                            <input 
                                type="text" 
                                name="alamat_perusahaan" 
                                value="{{ old('alamat_perusahaan') }}" 
                                class="form-control" 
                                id="alamat_perusahaan">
                            @error('alamat_perusahaan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <!-- No TELP Perusahaan -->
                        <div class="form-group col-md-6">
                            <label for="name">No TELP Perusahaan</label>
                            <input 
                                type="text" 
                                name="no_telp_perusahaan" 
                                value="{{ old('no_telp_perusahaan') }}" 
                                class="form-control" 
                                id="no_telp_perusahaan">
                            @error('no_telp_perusahaan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
    
                        <!-- Jabatan -->
                        <div class="form-group col-md-6">
                            <label for="name">Jabatan</label>
                            <input 
                                type="text" 
                                name="jabatan" 
                                value="{{ old('jabatan') }}" 
                                class="form-control" 
                                id="jabatan">
                            @error('jabatan')
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


    @include('validasi.notifikasi')
    @include('validasi.notifikasi-error')
@endsection