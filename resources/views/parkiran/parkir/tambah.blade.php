@extends('layouts.layout')

@section('judul', 'Tambah Pengguna Parkir LPSPL Sorong')

@section('isi')


<div class="card shadow mb-4">
   
    <div class="col-lg-10 mx-auto">
      @if (session('status'))
      <div class="mt-2">
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
          {{ session ('status') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      </div>
  @endif
        <div class="p-5">

            <form class="user" method="post" action="{{ route('parkiran_store') }}" enctype="">
                @csrf
                <div class="form-row mt-3">
                    <div class="form-group col-sm-4">
                    <label for="tanggal">Tanggal</label>
                      <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" id="tanggal" placeholder="Masukan Tanggal" value="{{ old('tanggal') }}">
                      @error('tanggal') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="jam">Jam</label>
                          <input type="time" class="form-control @error('jam') is-invalid @enderror" name="jam" id="jam" placeholder="Masukan Jam" value="{{ old('jam')}}">
                          @error('jam') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                        </div>
                        <div class="form-group col-sm-4">
                          <label for="nomor_parkir">Nomor Parkir</label>
                            <input type="number" class="form-control @error('nomor_parkir') is-invalid @enderror" name="nomor_parkir" id="nomor_parkir" placeholder="Masukan Nomor Parkir Jika Perlu" value="{{ old('nomor_parkir')}}">
                            @error('nomor_parkir') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                          </div>
                </div>
                <div class="form-group mt-3">
                    <label for="nama">Nama</label>
                      <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" placeholder="Masukan Nama" value="{{old('nama') }}">
                      @error('nama') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
            
                    <div class="form-group mt-3">
                    <label for="no_plat">Nomor Plat</label>
                      <input type="text" class="form-control @error('no_plat') is-invalid @enderror" name="no_plat" id="no_plat" placeholder="Masukan Nomor Plat Kendaraan" value="{{ old('no_plat') }}">
                      @error('no_plat') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                       
                    <div class="form-group mt-3">
                      <label for="no_hp">Nomor HP</label>
                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" id="no_hp" placeholder="Masukan Nomor HP" value="{{ old('no_hp') }}">
                        @error('no_hp') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                      </div>

                    <div class="form-group mt-3">
                    <label for="jenis_kendaraan">Jenis Kendaraan</label>
                    <select class="form-control form-select @error('jenis_kendaraan') is-invalid @enderror" aria-label="jenis_kendaraan" name="jenis_kendaraan">
                        <option selected value="{{ old('jenis_kendaraan') }}">{{ old('jenis_kendaraan') }}</option>
                        <option value="Motor">Motor</option>
                        <option value="Mobil">Mobil</option>
                        {{-- <option value="Morotai">Morotai</option> --}}
                      </select>
                      @error('jenis_kendaraan') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>

                    <div class="form-group mt-3">
                      <label for="merek">Merek Kendaraan</label>
                        <input type="text" class="form-control @error('merek') is-invalid @enderror" name="merek" id="merek" placeholder="Masukan Merek Kendaraan" value="{{ old('merek') }}">
                        @error('merek') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                      </div>

                    <div class="form-group mt-3">
                      <label for="parkinglocation_id">Lokasi Parkir</label>
                      <select class="form-control form-select @error('parkinglocation_id') is-invalid @enderror" aria-label="parkinglocation_id" name="parkinglocation_id">
                          <option selected value="{{ old('parkinglocation_id') }}">{{ old('parkinglocation_id') }}</option>
                          @foreach ($parkinglocation as $lokasi)
                          <option value={{ $lokasi->id }}>{{ $lokasi->nama_lokasi }}</option>
                          @endforeach
                                   
                        </select>
                        @error('parkinglocation_id') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                      </div>
                
                      <div class="form-group mt-3">
                        <label for="warna">Warna Kendaraan</label>
                          <input type="text" class="form-control @error('warna') is-invalid @enderror" name="warna" id="warna" placeholder="Masukan Warna Kendaraan" value="{{ old('warna') }}">
                          @error('warna') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                        </div>
            
                        <button type="submit" class="btn btn-primary float-left">Tambah</button>
            </form>
            <!-- Button trigger modal -->
                <a href="/parkir" class="btn btn-secondary ml-2">Batal</a>

        </div>
    </div>
</div>



@endsection