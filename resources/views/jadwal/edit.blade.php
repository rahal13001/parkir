@extends('layouts.layout')

@section('judul', 'Edit Jadwal Pelayanan')

@section('isi')


<div class="card shadow mb-4">
   
    <div class="col-lg-10 mx-auto">
        <div class="p-5">

            <form class="user" method="post" action="{{ route('schedule_update', $schedule->id) }}" enctype="">
                @method('put')
                @csrf
                <div class="form-row">
                  <div class="form-group col-sm-12">
                  <label for="hari">Hari</label>
                    <input type="text" class="form-control @error('hari') is-invalid @enderror" name="hari" id="hari" placeholder="Masukan Tanggal" value="{{ $schedule->hari }}" readonly>
                    @error('hari') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                  </div>
                </div>
                <div class="form-group">
                  <label for="buka">Jam Buka</label>
                    <input type="time" class="form-control @error('buka') is-invalid @enderror" name="buka" id="buka" placeholder="Masukan Tanggal" value="{{  $schedule->buka }}">
                    @error('buka') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                  </div>
                  <div class="form-group">
                    <label for="istirahat">Jam Istirahat</label>
                      <input type="time" class="form-control @error('istirahat') is-invalid @enderror" name="istirahat" id="istirahat" placeholder="Masukan Tanggal" value="{{  $schedule->istirahat }}">
                      @error('istirahat') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                    <div class="form-group">
                      <label for="masuk">Jam Masuk</label>
                        <input type="time" class="form-control @error('masuk') is-invalid @enderror" name="masuk" id="masuk" placeholder="Masukan Tanggal" value="{{  $schedule->masuk }}">
                        @error('masuk') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                      </div>
                      <div class="form-group">
                        <label for="tutup">Jam Tutup</label>
                          <input type="time" class="form-control @error('tutup') is-invalid @enderror" name="tutup" id="tutup" placeholder="Masukan Tanggal" value="{{  $schedule->tutup }}">
                          @error('tutup') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                        </div>                      
                        <button type="submit" class="btn btn-primary float-left">Edit</button>
            </form>
            <!-- Button trigger modal -->
                <a href="/jamkerja" class="btn btn-secondary ml-2 float-left mb-4">Batal</a>

        </div>
    </div>
</div>


@endsection