@extends('layouts.layout')

@section('judul', 'Edit Data Parkir LPSPL Sorong')

@section('isi')


<div class="card shadow mb-4">
   
    <div class="col-lg-10 mx-auto">
        <div class="p-5">

            <form class="user" method="post" action="{{ route('parkiran_update', $parking->id) }}" enctype="">
                @method('put')
                @csrf
                <div class="form-row mt-3">
                  <div class="form-group col-sm-4">
                  <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" id="tanggal" placeholder="Masukan Tanggal" value="{{ $parking->tanggal }}">
                    @error('tanggal') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                  </div>
                  <div class="form-group col-sm-4">
                      <label for="jam">Jam</label>
                        <input type="time" class="form-control @error('jam') is-invalid @enderror" name="jam" id="jam" placeholder="Masukan Jam" value="{{ $parking->jam}}">
                        @error('jam') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                      </div>
                      <div class="form-group col-sm-4">
                        <label for="nomor_parkir">Nomor Parkir</label>
                          <input type="number" class="form-control @error('nomor_parkir') is-invalid @enderror" name="nomor_parkir" id="nomor_parkir" placeholder="Masukan Nomor Parkir Jika Perlu" value="{{ $parking->nomor_parkir}}">
                          @error('nomor_parkir') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                        </div>
              </div>
              <div class="form-group mt-3">
                  <label for="nama">Nama</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" placeholder="Masukan Nama" value="{{$parking->nama }}">
                    @error('nama') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                  </div>
          
                  <div class="form-group mt-3">
                  <label for="no_plat">Nomor Plat</label>
                    <input type="text" class="form-control @error('no_plat') is-invalid @enderror" name="no_plat" id="no_plat" placeholder="Masukan Nomor HP" value="{{ $parking->no_plat }}">
                    @error('no_plat') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                  </div>
                     
                  <div class="form-group mt-3">
                  <label for="jenis_kendaraan">Jenis Kendaraan</label>
                  <select class="form-control form-select @error('jenis_kendaraan') is-invalid @enderror" aria-label="jenis_kendaraan" name="jenis_kendaraan">
                      <option selected value="{{ $parking->jenis_kendaraan }}">{{ $parking->jenis_kendaraan }}</option>
                      <option value="Motor">Motor</option>
                      <option value="Mobil">Mobil</option>
                      {{-- <option value="Morotai">Morotai</option> --}}
                    </select>
                    @error('jenis_kendaraan') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                  </div>

                  <div class="form-group mt-3">
                    <label for="status">Status</label>
                    <select class="form-control form-select @error('status') is-invalid @enderror" aria-label="status" name="status">
                        <option selected value="{{ $parking->status }}">{{ $parking->status }}</option>
                        <option value="Masuk">Masuk</option>
                        <option value="Keluar">Keluar</option>
                        {{-- <option value="Morotai">Morotai</option> --}}
                      </select>
                      @error('status') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>

                  <div class="form-group mt-3">
                    <label for="parkinglocation_id">Lokasi Parkir</label>
                    <select class="form-control form-select @error('parkinglocation_id') is-invalid @enderror" aria-label="parkinglocation_id" name="parkinglocation_id">
                        <option selected value="{{ $parking->parkinglocation_id }}">{{ $parking->lokasiparkir->nama_lokasi }}</option>
                        @foreach ($parkinglocation as $lokasi)
                        <option value={{ $lokasi->id }}>{{ $lokasi->nama_lokasi }}</option>
                        @endforeach
                                 
                      </select>
                      @error('parkinglocation_id') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
              
                    <div class="form-group mt-3">
                      <label for="warna">Warna Kendaraan</label>
                        <input type="text" class="form-control @error('warna') is-invalid @enderror" name="warna" id="warna" placeholder="Masukan Warna Kendaraaan" value="{{ $parking->warna }}">
                        @error('warna') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                      </div>
            
                        <button type="submit" class="btn btn-primary float-left">Edit</button>
            </form>
            <!-- Button trigger modal -->
                <a href="/parkir" class="btn btn-secondary ml-2 float-left">Batal</a>

                <button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#deleteModal">
                    Hapus
                </button>
        </div>
    </div>
</div>

<!-- Modal Delete-->
<div class="modal fade" id="deleteModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Hapus Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Yakin mau menghapus data ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
        <form action="/service/{{$parking->id}}" method="post">
          @method('delete')
          @csrf
          <button type="submit" class="btn btn-danger d-inline">Hapus</button>
       </form> 
      </form>
      </div>
    </div>
  </div>
</div>


@endsection