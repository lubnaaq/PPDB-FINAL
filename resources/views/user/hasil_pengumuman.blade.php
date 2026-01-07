@extends('layouts.dashboard')
@section('title', 'Hasil Pengumuman')
@section('content')
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Hasil Pengumuman</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Hasil Pengumuman Seleksi</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-center">
                    <div class="card-header">
                        <h5>Status Kelulusan</h5>
                    </div>
                    <div class="card-body">
                        <div class="screen-only">
                            {{-- 
                                Status Kelulusan diambil dari Controller
                                Values: 'LULUS', 'TIDAK LULUS', 'PENDING', 'BELUM_DIBUKA'
                            --}}

                            @if ($status_kelulusan == 'LULUS')
                                <div class="mb-4">
                                    <i class="feather icon-check-circle text-success" style="font-size: 80px;"></i>
                                </div>
                                <h3 class="text-success mb-3">SELAMAT! ANDA DINYATAKAN LULUS</h3>
                                <p class="lead">
                                    Selamat <strong>{{ Auth::user()->name }}</strong>, Anda telah dinyatakan <strong>LULUS</strong> seleksi penerimaan siswa baru di SMK Kami.
                                </p>
                                <div class="alert alert-success mt-4" role="alert">
                                    <h5 class="alert-heading">Langkah Selanjutnya</h5>
                                    <p>Silakan melakukan <strong>Daftar Ulang</strong> pada menu yang tersedia atau klik tombol di bawah ini.</p>
                                </div>
                                <a href="{{ route('user.daftar_ulang') }}" class="btn btn-primary btn-lg mt-3">
                                    <i class="feather icon-file-text me-2"></i> Lanjut ke Daftar Ulang
                                </a>

                            @elseif ($status_kelulusan == 'TIDAK LULUS')
                                <div class="mb-4">
                                    <i class="feather icon-x-circle text-danger" style="font-size: 80px;"></i>
                                </div>
                                <h3 class="text-danger mb-3">MOHON MAAF</h3>
                                <p class="lead">
                                    Mohon maaf <strong>{{ Auth::user()->name }}</strong>, Anda dinyatakan <strong>TIDAK LULUS</strong> dalam seleksi penerimaan siswa baru tahun ini.
                                </p>
                                <p class="text-muted">
                                    Jangan patah semangat, tetap terus belajar dan mencoba di kesempatan lainnya.
                                </p>
                                <a href="/dashboard" class="btn btn-secondary mt-3">
                                    <i class="feather icon-home me-2"></i> Kembali ke Dashboard
                                </a>

                            @elseif ($status_kelulusan == 'PENDING')
                                 <div class="mb-4">
                                    <i class="feather icon-clock text-info" style="font-size: 80px;"></i>
                                </div>
                                <h3 class="text-info mb-3">HASIL BELUM TERSEDIA</h3>
                                <p class="lead">
                                    Hasil seleksi Anda sedang dalam proses penentuan akhir.
                                </p>
                                <p class="text-muted">
                                    Silakan cek kembali halaman ini secara berkala.
                                </p>
                                <a href="/dashboard" class="btn btn-secondary mt-3">
                                    <i class="feather icon-arrow-left me-2"></i> Kembali
                                </a>

                            @else
                                {{-- BELUM_DIBUKA --}}
                                <div class="mb-4">
                                    <i class="feather icon-lock text-warning" style="font-size: 80px;"></i>
                                </div>
                                <h3 class="text-warning mb-3">PENGUMUMAN BELUM DIBUKA</h3>
                                <p class="lead">
                                    Hasil seleksi penerimaan siswa baru belum diumumkan secara resmi.
                                </p>
                                <p class="text-muted">
                                    Silakan cek kembali halaman ini sesuai dengan jadwal pengumuman yang telah ditentukan.
                                </p>
                                @if(isset($announcementDate))
                                <div class="alert alert-info mt-4" role="alert">
                                    <strong>Jadwal Pengumuman:</strong> {{ \Carbon\Carbon::parse($announcementDate)->translatedFormat('d F Y') }}
                                </div>
                                @endif
                                <a href="/dashboard" class="btn btn-secondary mt-3">
                                    <i class="feather icon-arrow-left me-2"></i> Kembali
                                </a>
                            @endif
                        </div>

                        <!-- Print Format -->
                        <div class="print-only" style="display: none;">
                            <!-- Header Section -->
                            <div class="print-header" style="text-align: center; margin-bottom: 30px; padding-bottom: 20px; border-bottom: 2px solid #000;">
                                <h2 style="margin: 0; font-size: 18px; font-weight: bold;">PENGUMUMAN HASIL SELEKSI</h2>
                                <h3 style="margin: 10px 0 0 0; font-size: 16px; font-weight: bold;">PENERIMAAN SISWA BARU TAHUN 2026</h3>
                            </div>

                            <!-- Content Section -->
                            <div class="print-content" style="margin: 30px 0;">
                                <p style="margin: 0 0 15px 0; line-height: 1.6;">
                                    <strong>Kepada Yth,</strong><br>
                                    {{ Auth::user()->name }}<br>
                                    <em>Peserta Seleksi Penerimaan Siswa Baru</em>
                                </p>

                                <p style="margin: 20px 0; text-align: justify; line-height: 1.6;">
                                    Dengan hormat, berdasarkan hasil seleksi penerimaan siswa baru tahun akademik 2026 yang telah dilaksanakan oleh Panitia Penerimaan Siswa Baru (PPDB), maka kami dengan ini menyampaikan keputusan sebagai berikut:
                                </p>

                                @if ($status_kelulusan == 'LULUS')
                                    <div style="text-align: center; margin: 25px 0; padding: 20px; border: 2px solid #000;">
                                        <p style="margin: 0; font-weight: bold; font-size: 16px;">
                                            Berdasarkan hasil seleksi, Anda dinyatakan <u>LULUS</u>
                                        </p>
                                    </div>
                                    <p style="margin: 20px 0; text-align: justify; line-height: 1.6;">
                                        Sebagai peserta yang dinyatakan LULUS, Anda diwajibkan untuk melakukan pendaftaran ulang sesuai dengan jadwal dan prosedur yang telah ditentukan oleh pihak sekolah.
                                    </p>
                                @elseif ($status_kelulusan == 'TIDAK LULUS')
                                    <div style="text-align: center; margin: 25px 0; padding: 20px; border: 2px solid #000;">
                                        <p style="margin: 0; font-weight: bold; font-size: 16px;">
                                            Berdasarkan hasil seleksi, Anda dinyatakan <u>TIDAK LULUS</u>
                                        </p>
                                    </div>
                                    <p style="margin: 20px 0; text-align: justify; line-height: 1.6;">
                                        Kami mengucapkan terima kasih atas partisipasi Anda dalam proses seleksi ini. Kami harap Anda tidak berputus asa dan terus mengembangkan potensi diri untuk kesempatan di masa depan.
                                    </p>
                                @else
                                    <div style="text-align: center; margin: 25px 0; padding: 20px; border: 2px solid #000;">
                                        <p style="margin: 0; font-weight: bold; font-size: 16px;">
                                            Status Anda sedang dalam <u>PROSES PENILAIAN</u>
                                        </p>
                                    </div>
                                    <p style="margin: 20px 0; text-align: justify; line-height: 1.6;">
                                        Hasil seleksi Anda masih dalam tahap penilaian akhir. Silakan mengecek kembali halaman ini untuk mendapatkan keputusan akhir.
                                    </p>
                                @endif

                                <p style="margin: 20px 0; text-align: justify; line-height: 1.6;">
                                    Demikian pengumuman ini kami sampaikan. Untuk informasi lebih lanjut, silakan menghubungi Panitia Penerimaan Siswa Baru.
                                </p>
                            </div>

                            <!-- Signature Section -->
                            <div class="print-signature" style="margin-top: 50px;">
                                <div style="display: inline-block; width: 100%;">
                                    <div style="float: right; text-align: center; width: 40%;">
                                        <p style="margin: 0 0 80px 0; font-style: italic;">Kepala Sekolah,</p>
                                        <p style="margin: 0; font-weight: bold; text-decoration: underline;">________________</p>
                                        <p style="margin: 5px 0 0 0; font-size: 12px;">NIP. _______________</p>
                                    </div>
                                </div>
                                <div style="clear: both;"></div>
                                <p style="margin-top: 30px; text-align: center; font-size: 12px; color: #666;">
                                    Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted d-flex justify-content-between align-items-center">
                        <span>Panitia PPDB SMK Tahun 2026</span>
                        <button class="btn btn-outline-primary print-button" onclick="window.print()">
                            <i class="feather icon-printer me-2"></i> Cetak
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>

    <style>
        @media print {
            /* Sembunyikan elemen yang tidak perlu dicetak */
            .breadcrumb,
            .print-button,
            .btn-secondary,
            .btn-primary,
            a[href*="daftar_ulang"],
            a[href*="dashboard"],
            .screen-only {
                display: none !important;
            }

            /* Tampilkan konten print */
            .print-only {
                display: block !important;
            }

            /* Styling untuk halaman cetak */
            body {
                background: white;
                color: #333;
                font-family: 'Times New Roman', Times, serif;
                font-size: 12pt;
                line-height: 1.5;
            }

            .pc-content {
                padding: 0;
                margin: 0;
            }

            .page-header,
            .page-header-title {
                display: none !important;
            }

            .row {
                margin: 0 !important;
            }

            .card {
                border: none;
                box-shadow: none;
                page-break-inside: avoid;
                margin: 0;
                padding: 0;
            }

            .card-header {
                display: none;
            }

            .card-body {
                padding: 20px;
                page-break-inside: avoid;
            }

            .card-footer {
                display: none;
            }

            .col-md-8 {
                max-width: 100% !important;
                flex: 0 0 100% !important;
            }

            /* Print header styling */
            .print-header {
                text-align: center;
                margin-bottom: 30px;
                padding-bottom: 20px;
                border-bottom: 2px solid #000;
            }

            .print-header h2,
            .print-header h3 {
                margin: 5px 0;
                font-size: 14pt;
            }

            /* Print content styling */
            .print-content {
                margin: 30px 0;
                text-align: justify;
            }

            .print-content p {
                margin-bottom: 15px;
                line-height: 1.6;
            }

            /* Print signature styling */
            .print-signature {
                margin-top: 50px;
                page-break-inside: avoid;
            }

            /* Margin untuk halaman */
            @page {
                size: A4;
                margin: 15mm 20mm;
            }

            /* Tampilkan ikon hanya jika ada */
            i.feather {
                display: none !important;
            }

            /* Alert tidak dicetak */
            .alert {
                display: none !important;
            }
        }

        .print-button {
            white-space: nowrap;
        }

        @media print {
            .print-button {
                display: none !important;
            }
        }
    </style>
@endsection
