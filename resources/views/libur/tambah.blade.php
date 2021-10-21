@extends('layouts.layout')

@section('judul', 'Tambah Hari Libur')

@section('isi')


<div class="card shadow mb-4">
   
    <div class="col-lg-10 mx-auto">
        <div class="p-5">

            <form class="user" method="post" action="{{ route('holiday_store') }}" enctype="">
                @csrf
                <div class="form-row mt-3">
                    <div class="form-group col-sm-6">
                    <label for="mulai">Mulai</label>
                      <input type="date" class="form-control @error('mulai') is-invalid @enderror" name="mulai" id="mulai" placeholder="Masukan Tanggal" value="{{ old('mulai') }}">
                      @error('mulai') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>

                    <div class="form-group col-sm-6">
                      <label for="selesai">Selesai</label>
                        <input type="date" class="form-control @error('selesai') is-invalid @enderror" name="selesai" id="selesai" placeholder="Masukan Tanggal" value="{{ old('selesai') }}">
                        @error('selesai') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                      </div>

                </div>
                <div class="form-group mt-3">
                    <label for="keterangan">Keterangan</label>
                      <input type="text" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan" placeholder="Masukan Nama" value="{{old('keterangan') }}">
                      @error('keterangan') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>                  
            
                        <button type="submit" class="btn btn-primary float-left">Tambah</button>
            </form>
            <!-- Button trigger modal -->
                <a href="/libur" class="btn btn-secondary ml-2">Batal</a>

        </div>
    </div>
</div>



@endsection