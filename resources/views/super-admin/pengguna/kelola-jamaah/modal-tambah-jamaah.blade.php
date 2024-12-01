<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('sa.tambah.jamaah') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <h3 class="font-weight-bold text-primary">DATA PRIBADI</h3>
                    <hr>
                    <div class="form-row">
                        <!-- No KTP -->
                        <div class="form-group col-md-6">
                            <label for="ktp">No KTP <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                name="ktp" 
                                value="{{ old('ktp') }}" 
                                class="form-control">
                            @error('ktp')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Email -->
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Alamat Email</label>
                            <input 
                                type="email" 
                                name="email" 
                                placeholder="Tidak Wajib"
                                value="{{ old('email') }}" 
                                class="form-control" 
                                id="exampleInputEmail1">
                            @error('email')
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
                                value="{{ old('nama_lengkap') }}" 
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

                    <hr>
                    <div class="d-flex">
                        <p class="text-info font-weight-bold">Ciri Ciri Fisik <span class="font-italic font-weight-normal">(Tidak Wajib)</span></p>
                    </div>
                    <div class="form-row">
                        <!-- Tinggi -->
                        <div class="form-group col-md-6">
                            <label for="name">Tinggi</label>
                            <input 
                                type="number" 
                                name="tinggi"
                                min="1" 
                                placeholder="... CM"
                                value="{{ old('tinggi') }}" 
                                class="form-control" 
                                id="tinggi">
                            @error('tinggi')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Berat -->
                        <div class="form-group col-md-6">
                            <label for="name">Berat</label>
                            <input 
                                type="number" 
                                name="berat" 
                                min="1"
                                placeholder="... KG"
                                value="{{ old('berat') }}" 
                                class="form-control" 
                                id="berat">
                            @error('berat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <!-- Muka -->
                        <div class="form-group col-md-6">
                            <label for="name">Muka</label>
                            <input 
                                type="text" 
                                name="muka"
                                value="{{ old('muka') }}" 
                                class="form-control" 
                                id="muka">
                            @error('muka')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Hidung -->
                        <div class="form-group col-md-6">
                            <label for="name">Hidung</label>
                            <input 
                                type="text" 
                                name="hidung" 
                                value="{{ old('hidung') }}" 
                                class="form-control" 
                                id="hidung">
                            @error('hidung')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <!-- Alis -->
                        <div class="form-group col-md-6">
                            <label for="name">Alis</label>
                            <input 
                                type="text" 
                                name="alis"
                                value="{{ old('alis') }}" 
                                class="form-control" 
                                id="alis">
                            @error('alis')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Rambut -->
                        <div class="form-group col-md-6">
                            <label for="name">Rambut</label>
                            <input 
                                type="text" 
                                name="rambut" 
                                value="{{ old('rambut') }}" 
                                class="form-control" 
                                id="rambut">
                            @error('rambut')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <!-- Penyakit -->
                        <div class="form-group col-md-8">
                            <label for="name">Penyakit yang potensial diderita <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                name="penyakit"
                                value="{{ old('penyakit') }}" 
                                class="form-control" 
                                id="penyakit">
                            @error('penyakit')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Rokok -->
                        <div class="form-group col-md-4">
                            <label for="name">Rokok <span class="text-danger">*</span></label>
                            <select name="rokok" value="{{ old('rokok') }}" class="form-control" id="rokok">
                                <option value="">-- Pilih --</option>
                                <option value="Iya" {{ old('rokok') == 'Iya' ? 'selected' : '' }}>Iya</option>
                                <option value="Tidak" {{ old('Tidak') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                            @error('rokok')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Kewarganegaraan -->
                    <div class="form-group col-md-12">
                        <label for="kewarganegaraan">Kewarganegaraan <span class="text-danger">*</span></label>
                        <select name="kewarganegaraan" value="{{ old('kewarganegaraan') }}" class="form-control" id="kewarganegaraan">
                            <option value="">-- Pilih --</option>
                            <option value="WNI" {{ old('kewarganegaraan') == 'WNI' ? 'selected' : '' }}>WNI</option>
                            <option value="WNA" {{ old('kewarganegaraan') == 'WNA' ? 'selected' : '' }}>WNA</option>
                        </select>
                        @error('kewarganegaraan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <hr>

                    <h3 class="font-weight-bold text-primary">ALAMAT</h3>
                    <p class="text-muted font-weight-bold">Alamat sesuai dengan KTP</p>
                    <hr>

                    <div class="form-row">
                        <!-- nama_jalan -->
                        <div class="form-group col-md-6">
                            <label for="name">Nama Jalan/No./RT/RW <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                name="nama_jalan" 
                                value="{{ old('nama_jalan') }}" 
                                class="form-control" 
                                id="nama_jalan">
                            @error('nama_jalan')
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
    
                        <!-- Kode POS -->
                        <div class="form-group col-md-6">
                            <label for="name">Kode POS <span class="text-danger">*</span></label>
                            <input 
                                type="number" 
                                name="kode_pos" 
                                value="{{ old('kode_pos') }}" 
                                class="form-control" 
                                id="kode_pos">
                            @error('kode_pos')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
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
                        <!-- Pendidikan Terahir -->
                        <div class="form-group col-md-6">
                            <label for="pendidikan_terahir">Pilih Pendidikan Terahir <span class="text-muted font-italic text-gray-500">(Tidak Wajib)</span></label>
                            <select class="form-control" name="pendidikan_terahir" id="pendidikan_terahir">
                                <option value="">-- Pilih Pendidikan Terahir --</option>
                                <option value="SD" {{ old('pekerjaan') == 'SD' ? 'selected' : '' }}>SD</option>
                                <option value="SLTP" {{ old('pekerjaan') == 'SLTP' ? 'selected' : '' }}>SLTP</option>
                                <option value="SMU" {{ old('pekerjaan') == 'SMU' ? 'selected' : '' }}>SMU</option>
                                <option value="D1/D2" {{ old('pekerjaan') == 'D1/D2' ? 'selected' : '' }}>D1/D2</option>
                                <option value="SM/D3" {{ old('pekerjaan') == 'SM/D3' ? 'selected' : '' }}>SM/D3</option>
                                <option value="S1" {{ old('pekerjaan') == 'S1' ? 'selected' : '' }}>S1</option>
                                <option value="S2" {{ old('pekerjaan') == 'S2' ? 'selected' : '' }}>S2</option>
                                <option value="S3" {{ old('pekerjaan') == 'S3' ? 'selected' : '' }}>S3</option>
                            </select>
                            @error('pekerjaan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <hr>

                    <h3 class="font-weight-bold text-primary">DATA PEKERJAAN</h3>
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

                    <h3 class="font-weight-bold text-primary">DATA KEBERANGKATAN</h3>
                    <hr>

                    <div class="form-row">
                        <!-- rencana_keberangkatan -->
                        <div class="form-group col-md-12">
                            <label for="rencana_keberangkatan">Rencana Keberangkatan <span class="text-danger">*</span></label>
                            <select class="form-control" name="rencana_keberangkatan" id="rencana_keberangkatan">
                                <option value="">-- Pilih Rencana Keberangkatan --</option>
                                @foreach ($jadwal as $item)
                                    <option 
                                        value="{{ $item->id_jadwal }}" 
                                        {{ old('rencana_keberangkatan') == $item->id_jadwal ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::parse($item->jadwal)->translatedFormat('d F Y, H:i') . ' | Pesawat : ' . $item->pesawat . ' | Makkah : ' . $item->makkah . ' | Madinah : ' . $item->madinah }}
                                    </option>
                                @endforeach
                            </select>
                            @error('rencana_keberangkatan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Pengalaman Umroh -->
                    <div class="form-group">
                        <label for="pengalaman_umroh">Pengalaman Umroh <span class="text-danger">*</span></label>
                        <select class="form-control" name="pengalaman_umroh" id="pengalaman_umroh">
                            <option value="">-- Pilih --</option>
                            <option value="Belum Pernah" {{ old('pengalaman_umroh') == 'Belum Pernah' ? 'selected' : '' }}>Belum Pernah</option>
                            <option value="Sudah" {{ old('pengalaman_umroh') == 'Sudah' ? 'selected' : '' }}>Sudah</option>
                        </select>
                        @error('pengalaman_umroh')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <!-- Input untuk sudah pengalaman lainnya -->
                    <div class="form-group" id="SudahPengalamanContainer" style="display: none;">
                        <label for="sudah_pengalaman">Terahir Tahun <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="sudah_pengalaman" id="sudah_pengalaman" value="{{ old('sudah_pengalaman') }}" placeholder="Terahir Taun">
                        @error('sudah_pengalaman')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <script>
                        // JavaScript untuk menampilkan/menghilangkan input teks
                        document.getElementById('pengalaman_umroh').addEventListener('change', function () {
                            const SudahPengalamanContainer = document.getElementById('SudahPengalamanContainer');
                            if (this.value === 'Sudah') {
                                SudahPengalamanContainer.style.display = 'block';
                            } else {
                                SudahPengalamanContainer.style.display = 'none';
                                document.getElementById('sudah_pengalaman').value = ''; // Reset input jika tidak dipilih
                            }
                        });
                    
                        // Menampilkan kembali input teks jika opsi "Lainnya" sudah dipilih sebelumnya (untuk edit form)
                        if (document.getElementById('pengalaman_umroh').value === 'Sudah') {
                            document.getElementById('SudahPengalamanContainer').style.display = 'block';
                        }
                    </script>
                    
                    <div class="form-row">
                        <!-- Paket Umroh -->
                        <div class="form-group col-md-6">
                            <label for="paket_umroh">Paket Umroh yang dipilih <span class="text-danger">*</span></label>
                            <select class="form-control" name="paket_umroh" id="paket_umroh">
                                <option value="">-- Pilih --</option>
                                <option value="Sekamar Berdua" {{ old('paket_umroh') == 'Sekamar Berdua' ? 'selected' : '' }}>Sekamar Berdua</option>
                                <option value="Sekamar Bertiga" {{ old('paket_umroh') == 'Sekamar Bertiga' ? 'selected' : '' }}>Sekamar Bertiga</option>
                                <option value="Sekamar Berempat" {{ old('paket_umroh') == 'Sekamar Berempat' ? 'selected' : '' }}>Sekamar Berempat</option>
                            </select>
                            @error('paket_umroh')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Program -->
                        <div class="form-group col-md-6">
                            <label for="program">Program <span class="text-danger">*</span></label>
                            <select class="form-control" name="program" id="program">
                                <option value="">-- Pilih Program --</option>
                                <option value="Sembilan Hari" {{ old('program') == 'Sembilan Hari' ? 'selected' : '' }}>Sembilan Hari</option>
                                <option value="Dua Belas Hari" {{ old('program') == 'Dua Belas Hari' ? 'selected' : '' }}>Dua Belas Hari</option>
                            </select>
                            @error('program')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <hr>
                    <h3 class="font-weight-bold text-primary">DATA KELUARGA</h3>
                    <p class="text-muted font-weight-bold">Keluarga yang ikut bersama : </p>
                    <div class="form-row">
                        <!-- Nama Keluarga Ikut -->
                        <div class="form-group col-md-4">
                            <label for="name">Nama Keluarga Ikut</label>
                            <input 
                                type="text" 
                                name="nama_keluarga_ikut" 
                                value="{{ old('nama_keluarga_ikut') }}" 
                                class="form-control" 
                                id="nama_keluarga_ikut">
                            @error('nama_keluarga_ikut')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Hubungan -->
                        <div class="form-group col-md-4">
                            <label for="name">Hubungan</label>
                            <input 
                                type="text" 
                                name="hubungan_keluarga_ikut" 
                                value="{{ old('hubungan_keluarga_ikut') }}" 
                                class="form-control" 
                                id="hubungan_keluarga_ikut">
                            @error('hubungan_keluarga_ikut')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Telp -->
                        <div class="form-group col-md-4">
                            <label for="name">Telp</label>
                            <input 
                                type="text" 
                                name="no_telp_keluarga_ikut" 
                                value="{{ old('no_telp_keluarga_ikut') }}" 
                                class="form-control" 
                                id="no_telp_keluarga_ikut">
                            @error('no_telp_keluarga_ikut')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Alamat</span>
                        </div>
                        <textarea class="form-control" name="alamat_keluarga_ikut" aria-label="Alamat"></textarea>
                    </div>

                    <hr>
                    <p class="text-muted font-weight-bold mt-3">Keluarga yang ditinggal & dapat dihubungi sewaktu-waktu :</p>
                    <div class="form-row">
                        <!-- Nama Keluarga Ditinggal -->
                        <div class="form-group col-md-4">
                            <label for="name">Nama Keluarga Ditinggal</label>
                            <input 
                                type="text" 
                                name="nama_keluarga_tinggal" 
                                value="{{ old('nama_keluarga_tinggal') }}" 
                                class="form-control" 
                                id="nama_keluarga_tinggal">
                            @error('nama_keluarga_tinggal')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Hubungan -->
                        <div class="form-group col-md-4">
                            <label for="name">Hubungan</label>
                            <input 
                                type="text" 
                                name="hubungan_keluarga_tinggal" 
                                value="{{ old('hubungan_keluarga_tinggal') }}" 
                                class="form-control" 
                                id="hubungan_keluarga_tinggal">
                            @error('hubungan_keluarga_tinggal')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Telp -->
                        <div class="form-group col-md-4">
                            <label for="name">Telp</label>
                            <input 
                                type="text" 
                                name="no_telp_keluarga_tinggal" 
                                value="{{ old('no_telp_keluarga_tinggal') }}" 
                                class="form-control" 
                                id="no_telp_keluarga_tinggal">
                            @error('no_telp_keluarga_tinggal')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Alamat</span>
                        </div>
                        <textarea class="form-control" name="alamat_keluarga_tinggal" aria-label="Alamat">{{ old('alamat_keluarga_tinggal') }}</textarea>
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