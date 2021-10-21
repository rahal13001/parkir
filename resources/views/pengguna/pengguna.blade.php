@extends('layouts.user')

@section('judul', 'Sistem Parkir')

@section('isi')
    
<div class="container mt-3">
  <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Parkir LPSPL Sorong</h2>
      </div>

    </div>
  </section>
  
    <section class="about">
       
        @if (session('status'))
            <div class="mt-2">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session ('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
        
            @if (isset($info))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ $info }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if (isset($woro))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ $woro }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

        <section id="team" class="team ">
          <div class="container">
    
            <div class="row">
{{--     
              <div class="col-lg-12">
                <div class="member">
                  
                  <div class="member-info">
                    <h4>Petunjuk Singkat</h4>
                    <span>Parkir Prioritas Digunakan unt</span>
                    <span>Pengguna layanan dari Provinsi Papua mengambil lokasi antrian di Merauke</span>
                    <span>Pengguna layanan dari Provinsi Maluku mengambil lokasi antrian di Ambon</span>
                    <span>Pengguna layanan dari Provinsi Maluku Utara mengambil lokasi antrian di Ternate</span>
                    <span>Pelayanan pemanfaatan jenis ikan meliputi registrasi pelaku usaha, verifikasi lapangan pengurusan SIPJI, Surat Rekomendasi dan Surat Angkut Jenis Ikan</span>
                  </div>
                </div>
              </div> --}}
       
      
        <form action="{{ route('pengguna_store') }}" method="post" class="user mt-n2">
            @csrf
            <div class="form-group mt-3">
                <label for="nama">Nama</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" placeholder="Masukan Nama" value="{{ old('nama') }}">
                @error('nama') <div class="invalid-feedback"> {{ $message }} </div> @enderror
            </div>

            <div class="form-group mt-3">
                <label for="no_plat">Nomor Plat</label>
                  <input type="text" class="form-control @error('no_plat') is-invalid @enderror" name="no_plat" id="no_plat" placeholder="Masukan Nomor Plat Kendaraan" value="{{ old('no_plat') }}">
                  @error('no_plat') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                </div>

                <div class="form-group mt-3">
                  <label for="jenis_kendaraan">Jenis Kendaraan</label>
                  <select class="form-select @error('jenis_kendaraan') is-invalid @enderror" aria-label="jenis_kendaraan" name="jenis_kendaraan">
                      <option selected value="{{ old('jenis_kendaraan') }}">{{ old('jenis_kendaraan') }}</option>
                      <option value="Motor">Motor</option>
                      <option value="Mobil">Mobil</option>
              </select>
              @error('jenis_kendaraan') <div class="invalid-feedback"> {{ $message }} </div> @enderror
              </div>

            <div class="form-group mt-3">
                <label for="parkinglocation_id">Lokasi Parkir</label>
                <select class="form-select @error('parkinglocation_id') is-invalid @enderror" aria-label="parkinglocation_id" name="parkinglocation_id">
                    <option selected value="{{ old('parkinglocation_id') }}">{{ old('parkinglocation_id') }}</option>
                    @foreach ($lokasiparkir as $lokparkir)
                    <option value={{ $lokparkir->id }}>{{ $lokparkir->nama_lokasi }}</option>
                    @endforeach
            </select>
            @error('parkinglocation_id') <div class="invalid-feedback"> {{ $message }} </div> @enderror
            </div>

            <div class="form-group mt-3">
              <label for="warna">Warna Kendaraan</label>
                <input type="text" class="form-control @error('warna') is-invalid @enderror" name="warna" id="warna" placeholder="Masukan Warna Kendaraan" value="{{ old('warna') }}">
                @error('warna') <div class="invalid-feedback"> {{ $message }} </div> @enderror
              </div>
      
            <button type="submit" class="btn btn-primary mt-3">Daftar Parkir</button>
            </form>

       

    </section>
     <!-- ======= Pricing Section ======= -->
     <section id="pricing" class="pricing ">
        <div class="container">
  
          <div class="row d-flex justify-content-center animate__animated animate__fadeInDown mt-2">
            @foreach ($lokasiparkir as $lokpar)
              
            <div class="col-lg-3 col-md-6 mt-4 mt-md-0 mb-3">
              <div class="box featured">
                <h3>{{ $lokpar->nama_lokasi }}</h3>
                <h6>Kapasitas Tersedia:</h5>
                <h5><span> {{ $lokpar->kapasitas - $lokpar->terparkir }} Kendaraan</span></h5>
                
                {{-- <div class="btn-wrap">
                  <a href="/antriansorong" class="btn-buy" target="_blank">Lihat Antrian</a>
                </div> --}}
              </div>
            </div> 

            @endforeach
        
          </div>
        </div>
      </section><!-- End Pricing Section -->

</div>

@endsection