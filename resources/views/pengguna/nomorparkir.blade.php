@extends('layouts.user')
@section('judul', 'Bukti Parkir Masuk')
@section('isi')

<main id="main">
    <section class="mt-2 blog">
        <div class="container mt-5" data-aos="fade-up">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-lg-8 entries">
                    @if (session('status'))
                    <div class="mt-2">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session ('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif

                    <form action="/pengguna/exportpdf" method="POST" class="user">
                        @csrf
                        <article class="entry">                   
                            <h1 class="text-center">Nomor Parkir : {{ $display_nomorparkir }}</h1>
                            <br>
                            <h4 class="text-center">Nomor Plat : {{ $no_plat }}</h4>
                            <h6 class="text-center">Nama : {{ $nama }}</h6>
                            <h6 class="text-center">Tempat Parkir : {{ $lokasi }}, Jenis Kendaraan : {{ $jenis_kendaraan }}, Warna : {{ $warna }}</h6>
                            <p class="text-center">Tanggal : {{ $tanggal }}, Jam : {{ $jam }}</p>
                            
                            <input type="hidden" name="nomor_parkir" value="{{ $display_nomorparkir }}">
                            <input type="hidden" name="nama" value="{{ $nama }}">
                            <input type="hidden" name="tanggal" value="{{ $tanggal }}">
                            <input type="hidden" name="jam" value="{{ $jam }}">
                            <input type="hidden" name="no_plat" value="{{ $no_plat }}">
                            <input type="hidden" name="lokasi" value="{{ $lokasi }}">
                            <input type="hidden" name="jenis_kendaraan" value="{{ $jenis_kendaraan }}">
                            <input type="hidden" name="warna" value="{{ $warna }}">
                            <div class="container mt-3 text-center">
                                <button class="btn btn-primary" type="submit">Cetak Kartu</button>
                            </div>

                            {{-- <br>
                            <p>Terimakasih Telah Bersedia Untuk Mengantri</p>
                            <small class="text-center mt-n2">Kamu Menolak Segala Bentuk Gratifikasi</small> --}}
                        </article>
                    </form>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </section>
</main>
@endsection