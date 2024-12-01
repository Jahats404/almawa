<div class="modal fade" id="modalEdit{{ $item->no_registrasi }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Agen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('marketing.update.agen', ['id' => $item->no_registrasi]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="modal-body">
                    <!-- No Registrasi Agen -->
                    <h3 class="font-weight-bold text-primary">DATA PRIBADI</h3>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">No Registrasi Agen <span class="text-danger">*</span></label>
                            <input 
                                type="text" readonly
                                name="no_registrasi" 
                                value="{{ old('no_registrasi', $item->no_registrasi) }}" 
                                class="form-control" 
                                id="no_registrasi">
                            @error('no_registrasi')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <!-- No KTP -->
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">No KTP <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                name="ktp" 
                                value="{{ old('ktp', $item->ktp) }}" 
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
                                value="{{ old('nama_lengkap', $item->nama_lengkap) }}" 
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
                                value="{{ old('nama_ayah_kandung', $item->nama_ayah_kandung) }}" 
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
                                value="{{ old('tempat_lahir', $item->tempat_lahir) }}" 
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
                                <option value="Pria" {{ old('jenis_kelamin', $item->jenis_kelamin ?? '') == 'Pria' ? 'selected' : '' }}>Pria</option>
                                <option value="Wanita" {{ old('jenis_kelamin', $item->jenis_kelamin ?? '') == 'Wanita' ? 'selected' : '' }}>Wanita</option>
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
                                value="{{ old('tanggal_lahir', $item->tanggal_lahir) }}" 
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
                                value="{{ old('umur', $item->umur) }}" 
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
                            value="{{ old('email', $item->users->email) }}" 
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
                                value="{{ old('alamat', $item->alamat) }}" 
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
                                value="{{ old('desa', $item->desa) }}" 
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
                                value="{{ old('kecamatan', $item->kecamatan) }}" 
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
                                value="{{ old('kabupaten', $item->kabupaten) }}" 
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
                                value="{{ old('provinsi', $item->provinsi) }}" 
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
                                value="{{ old('no_telp', $item->no_telp) }}" 
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
                            @if ($item->file_ktp)
                                <a href="{{ asset('storage/' . $item->file_ktp) }}" target="_blank">Lihat File KTP</a>
                            @else
                                Tidak Ada File
                            @endif
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
                            @if ($item->file_pembayaran)
                                <a href="{{ asset('storage/' . $item->file_pembayaran) }}" target="_blank">Lihat File Pembayaran</a>
                            @else
                                Tidak Ada File
                            @endif
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
                            <option value="PNS" {{ old('pekerjaan', $item->pekerjaan ?? '') == 'PNS' ? 'selected' : '' }}>PNS</option>
                            <option value="Peg. Swasta" {{ old('pekerjaan', $item->pekerjaan ?? '') == 'Peg. Swasta' ? 'selected' : '' }}>Peg. Swasta</option>
                            <option value="ABRI" {{ old('pekerjaan', $item->pekerjaan ?? '') == 'ABRI' ? 'selected' : '' }}>ABRI</option>
                            <option value="BUMN" {{ old('pekerjaan', $item->pekerjaan ?? '') == 'BUMN' ? 'selected' : '' }}>BUMN</option>
                            <option value="Wiraswasta" {{ old('pekerjaan', $item->pekerjaan ?? '') == 'Wiraswasta' ? 'selected' : '' }}>Wiraswasta</option>
                            <option value="Pelajar" {{ old('pekerjaan', $item->pekerjaan ?? '') == 'Pelajar' ? 'selected' : '' }}>Pelajar</option>
                            <option value="Mahasiswa" {{ old('pekerjaan', $item->pekerjaan ?? '') == 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                            <option value="Ibu Rumah Tangga" {{ old('pekerjaan', $item->pekerjaan ?? '') == 'Ibu Rumah Tangga' ? 'selected' : '' }}>Ibu Rumah Tangga</option>
                            <option value="Pensiunan" {{ old('pekerjaan', $item->pekerjaan ?? '') == 'Pensiunan' ? 'selected' : '' }}>Pensiunan</option>
                            <option value="Lainnya" {{ old('pekerjaan', $item->pekerjaan ?? '') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('pekerjaan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <!-- Input untuk pekerjaan lainnya -->
                    <div class="form-group" id="pekerjaanLainnyaContainer" style="display: none;">
                        <label for="pekerjaan_lainnya">Masukkan Pekerjaan Lainnya</label>
                        <input type="text" class="form-control" name="pekerjaan_lainnya" id="pekerjaan_lainnya" value="{{ old('pekerjaan_lainnya', $item->pekerjaan) }}" placeholder="Pekerjaan Lainnya">
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
                            value="{{ old('nama_perusahaan', $item->nama_perusahaan) }}" 
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
                                value="{{ old('bidang_perusahaan', $item->bidang_perusahaan) }}" 
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
                                value="{{ old('alamat_perusahaan', $item->alamat_perusahaan) }}" 
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
                                value="{{ old('no_telp_perusahaan', $item->no_telp_perusahaan) }}" 
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
                                value="{{ old('jabatan', $item->jabatan) }}" 
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
</div>