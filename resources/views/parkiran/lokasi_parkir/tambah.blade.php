@extends('layouts.layout')

@section('judul', 'Tambah Lokasi Parkir LPSPL Sorong')

@section('isi')


<div class="card shadow mb-4">
   
    <div class="col-lg-10 mx-auto">
        <div class="p-5">

            <form class="user" method="post" action="{{ route('lokasiparkir_store') }}" enctype="">
                @csrf
                <div class="form-group mt-3">
                    <label for="nama_lokasi">Nama Lokasi</label>
                      <input type="text" class="form-control @error('nama_lokasi') is-invalid @enderror" name="nama_lokasi" id="nama_lokasi" placeholder="Masukan Nama" value="{{old('nama_lokasi') }}">
                      @error('nama_lokasi') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
            
                    <div class="form-group mt-3">
                      <label for="jenis_kendaraan">Jenis Kendaraan</label>
                      <select class="form-control form-select @error('jenis_kendaraan') is-invalid @enderror" aria-label="jenis_kendaraan" name="jenis_kendaraan">
                          <option selected value="{{ old('jenis_kendaraan') }}">{{ old('jenis_kendaraan') }}</option>
                          <option value="Motor">Motor</option>
                          <option value="Mobil">Mobil</option>
                        </select>
                        @error('lokasi') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                      </div>
            
                      <div class="form-group mt-3">
                        <label for="kapasitas">Kapasitas</label>
                          <input type="number" class="form-control @error('kapasitas') is-invalid @enderror" name="kapasitas" id="kapasitas" placeholder="Masukan Kapasitas" value="{{ old('kapasitas') }}">
                          @error('kapasitas') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                        </div>
            
                    <div class="form-group mt-3">
                    <label for="status">Status</label>
                    <select class="form-control form-select @error('status') is-invalid @enderror" aria-label="status" name="status">
                        <option selected value="{{ old('status') }}">{{ old('status') }}</option>
                        <option value="Bisa">Bisa</option>
                        <option value="Tidak">Tidak</option>
                      </select>
                      @error('status') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                  
            
                        <button type="submit" class="btn btn-primary float-left">Tambah</button>
            </form>
            <!-- Button trigger modal -->
                <a href="/lokasiparkir" class="btn btn-secondary ml-2">Batal</a>

        </div>
    </div>
</div>



@endsection