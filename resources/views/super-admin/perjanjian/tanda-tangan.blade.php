@extends('layouts.master')

@section('content')

    <!-- Page Heading -->
    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between mb-4">
        <!-- Judul Halaman -->
        <h1 class="h3 mb-3 mb-md-0 text-gray-800">Detail</h1>
        <!-- Tombol -->
        <a href="{{ route('agen.dashboard') }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-xl-12 col-md-6 mb-4">
            <!-- Detail Surat Perjanjian -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="card-header py-3 d-flex flex-wrap align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary flex-grow-1">Surat Perjanjian Kerjasama Keagenan</h6>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Tempatkan PDF Surat Perjanjian di sini -->
                    <iframe src="{{ route('agen.perjanjian') }}" width="100%" height="600px"></iframe>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad"></script>
    <script>
        var canvas = document.getElementById('signature-pad');
        var signaturePad = new SignaturePad(canvas);

        // Menangani tombol Simpan Tanda Tangan
        document.getElementById('save-signature').addEventListener('click', function() {
            if (signaturePad.isEmpty()) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Tanda tangan tidak boleh kosong!'
                });
                return;
            }

            var signatureData = signaturePad.toDataURL(); // Mengambil data tanda tangan

            // Kirim data ke server menggunakan AJAX
            $.ajax({
                url: '/save-signature',
                method: 'POST',
                data: {
                    signature: signatureData,
                    _token: '{{ csrf_token() }}' // Token CSRF untuk Laravel
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Tanda tangan berhasil disimpan!',
                        showConfirmButton: false,
                        timer: 2000 // Refresh otomatis setelah 2 detik
                    }).then(() => {
                        location.reload(); // Refresh halaman setelah berhasil
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Gagal menyimpan tanda tangan.'
                    });
                }
            });
        });

        // Menangani tombol Reset Tanda Tangan
        document.getElementById('reset-signature').addEventListener('click', function() {
            signaturePad.clear(); // Menghapus tanda tangan yang ada di canvas
        });
    </script>

    @include('validasi.notifikasi')
    @include('validasi.notifikasi-error')
@endsection
