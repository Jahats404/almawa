<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            line-height: 1.6;
            margin: 0 auto;
            padding: 20px;
            max-width: 800px;
        }
        h1, h2, h3 {
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .logo {
            text-align: center;
            margin-bottom: 10px;
        }
        .bold {
            font-weight: bold;
        }
        .text-center {
            text-align: center;
        }
        .content {
            margin-top: 20px;
            text-align: justify;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .info-table td {
            padding: 5px;
            vertical-align: top;
        }
        .info-table .label {
            width: 30%; /* Kolom label (kiri) */
            text-align: left;
            font-weight: bold;
            white-space: nowrap;
        }
        .info-table .value {
            width: 70%; /* Kolom isi (kanan) */
            text-align: left;
        }
        .mt-20 {
            margin-top: 20px;
        }
    </style>
    <title>Surat Perjanjian</title>
</head>
<body>
    <!-- Logo -->
    <div class="logo">
        <img src="path/to/logo.png" alt="Logo" style="width: 100px; height: auto;">
    </div>

    <!-- Header -->
    <h1>ALMA'WA NU TOUR & TRAVEL</h1>
    <h2 class="bold">PT. NAHDLATUNA ZADUNA TAQWA</h2>
    <h3>SURAT PERJANJIAN KERJASAMA KEAGENAN</h3>

    <!-- Isi Surat -->
    <div class="content">
        <p>Yang bertanda tangan di bawah ini:</p>
        <table class="info-table">
            <tr>
                <td class="label">Nama Lengkap</td>
                <td class="value">: Priyono, SH</td>
            </tr>
            <tr>
                <td class="label">No. KTP</td>
                <td class="value">: 3301220301630002</td>
            </tr>
            <tr>
                <td class="label">Alamat</td>
                <td class="value">: JL. Biak B.9/345 RT 001/013 Gunungsimping Cilacap Jawa Tengah</td>
            </tr>
            <tr>
                <td class="label">Jabatan</td>
                <td class="value">: Direktur Utama PT. Nahdlatuna Zaduna Taqwa</td>
            </tr>
        </table>

        <p class="mt-20">
            Nama tersebut di atas mewakili <span class="bold">PT. Nahdlatuna Zaduna Taqwa</span>, 
            yang selanjutnya disebut <span class="bold">Pihak Pertama</span>.
        </p>

        <table class="info-table">
            <tr>
                <td class="label">Nama Lengkap</td>
                <td class="value">: {{ $nama_agen }}</td>
            </tr>
            <tr>
                <td class="label">No. KTP</td>
                <td class="value">: {{ $ktp_agen }}</td>
            </tr>
            <tr>
                <td class="label">Alamat</td>
                <td class="value">: {{ $alamat_agen }}</td>
            </tr>
            <tr>
                <td class="label">Jabatan</td>
                <td class="value">: Agen</td>
            </tr>
        </table>

        <p class="mt-20">
            Selanjutnya disebut sebagai <span class="bold">Pihak Kedua</span>.
        </p>

        <p class="mt-20">
            Dengan memohon Ridho Allah SWT, kami mengadakan perjanjian kerjasama sebagai berikut:
        </p>
    </div>

    <div style="page-break-before: always;"> <!-- Halaman Baru -->
        <!-- Halaman 2 -->
        <h3 class="text-center">Pasal 1</h3>
        <p class="content">
            Yang dimaksud program keagenan adalah program yang diikuti oleh Orang per Orang atau lembaga yang mempunyai kemampuan dalam memasarkan produk PT. Nahdlatuna Zaduna Taqwa.
        </p>
    
        <h3 class="text-center">Pasal 2</h3>
        <p class="content">
            Pihak Kedua berkewajiban memasarkan produk PT. Nahdlatuna Zaduna Taqwa yang meliputi Umroh Reguler, Umroh Plus, Tabungan Harian, Tabungan Simantab, Haji Plus, Haji Furoda, dan program Keagenan.
        </p>
    
        <h3 class="text-center">Pasal 3</h3>
        <p class="content">
            Pihak Kedua mendapatkan Hak Usaha sebagai bagi hasil yang sudah dijelaskan di surat edaran yang dibuat oleh Pihak Pertama.
        </p>
    
        <h3 class="text-center">Pasal 4</h3>
        <p class="content">
            Pemberian Kontribusi/fee kepada Pihak Kedua akan diberikan apabila Nasabah, Jamaah, dan Agen sudah menyetorkan uang muka atau setoran awal sesuai ketentuan yang berlaku.
        </p>
    
        <h3 class="text-center">Pasal 5</h3>
        <p class="content">
            Pihak Kedua wajib menyampaikan kepada Nasabah/Jamaah yang sudah mendaftar dan sudah DP bahwa apabila mengundurkan diri sebelum Nasabah/Jamaah tersebut berangkat umroh, akan dikenakan biaya administrasi sesuai dengan ketentuan yang berlaku.
        </p>
    
        <h3 class="text-center">Pasal 6</h3>
        <p class="content">
            Pihak Kedua wajib mendampingi semua proses pendaftaran calon jamaah serta mengurus kelengkapan dokumen perjalanan seperti Paspor, Vaksin Meningitis, dan lainnya.
        </p>
    
        <h3 class="text-center">Pasal 7</h3>
        <p class="content">
            Bila terjadi hal-hal yang sifatnya di luar kemampuan Pihak Pertama dan Pihak Kedua, dapat diselesaikan dengan cara kekeluargaan untuk mencapai mufakat.
        </p>

        <!-- Halaman 3 -->
        <h3 class="text-center">Pasal 8</h3>
        <p class="content">
            Hal-hal yang belum tercantum dalam pasal-pasal di atas bisa dimusyawarahkan oleh kedua belah pihak.
        </p>

        <p class="content">
            Perjanjian ini berlaku tanpa ada batas waktu dan bisa diwariskan. Demikian surat perjanjian kerjasama ini dibuat dan disepakati bersama. Jika ada perselisihan di kemudian hari, maka akan diselesaikan secara kekeluargaan sebelum diselesaikan melalui jalur hukum di pengadilan di wilayah Republik Indonesia.
        </p>

        <!-- Tanggal -->
        <p class="text-center mt-20"><strong>Cilacap, {{ now()->format('d F Y') }}</strong></p>

        <!-- Tanda Tangan -->
        <table style="width: 100%; margin-top: 40px; text-align: center;">
            <tr>
                <!-- Pihak Pertama -->
                <td style="width: 50%;">
                    <p>Pihak Pertama,</p>
                    <br><br><br>
                    <p><strong>Priyono, SH</strong></p>
                    <p>Direktur Utama</p>
                </td>

                <td style="width: 50%; vertical-align: top; padding-top: -40px;">
                    <p>Pihak Kedua,</p>
                    <br><br>
                    @if ($signaturePath)
                        <img src="{{ public_path('storage/' . $agen->perjanjian->ttd) }}" alt="Tanda Tangan" style="width: 150px; height: auto;">
                    @else
                        <p>(Tanda tangan belum tersedia)</p>
                    @endif
                    <p><strong>{{ $nama_agen }}</strong></p>
                </td>
            </tr>
        </table>
    </div>
    
</body>
</html>
