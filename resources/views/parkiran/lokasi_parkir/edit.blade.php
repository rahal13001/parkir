@extends('layouts.layout')

@section('judul', 'Edit Lokasi Parkir LPSPL Sorong')

@section('isi')


<div class="card shadow mb-4">
   
    <div class="col-lg-10 mx-auto">
        <div class="p-5">

            <form class="user" method="post" action="{{ route('lokasiparkir_update', $parkinglocation->id) }}" enctype="">
                @method('put')
                @csrf
                <div class="form-group mt-3">
                    <label for="nama_lokasi">Nama Lokasi</label>
                      <input type="text" class="form-control @error('nama_lokasi') is-invalid @enderror" name="nama_lokasi" id="nama_lokasi" placeholder="Masukan Nama" value="{{ $parkinglocation->nama_lokasi }}">
                      @error('nama_lokasi') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
            
                    <div class="form-group mt-3">
                    <label for="kapasitas">Kapasitas</label>
                      <input type="number" class="form-control @error('kapasitas') is-invalid @enderror" name="kapasitas" id="kapasitas" placeholder="Masukan Kapasitas" value="{{ $parkinglocation->kapasitas }}">
                      @error('kapasitas') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                      
                    <div class="form-group mt-3">
                    <label for="jenis_kendaraan">Jenis Kendaraan</label>
                    <select class="form-control form-select @error('jenis_kendaraan') is-invalid @enderror" aria-label="jenis_kendaraan" name="jenis_kendaraan">
                        <option selected value="{{ $parkinglocation->jenis_kendaraan }}">{{ $parkinglocation->jenis_kendaraan }}</option>
                        <option value="Motor">Motor</option>
                        <option value="Mobil">Mobil</option>
                      </select>
                      @error('lokasi') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>

                    <div class="form-group mt-3">
                      <label for="status">Status</label>
                      <select class="form-control form-select @error('status') is-invalid @enderror" aria-label="status" name="status">
                          <option selected value="{{ $parkinglocation->status }}">{{ $parkinglocation->status }}</option>
                          <option value="Bisa">Bisa</option>
                          <option value="Tidak">Tidak</option>
                        </select>
                        @error('status') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                      </div>
                           
                        <button type="submit" class="btn btn-primary float-left">Edit</button>
            </form>
            <!-- Button trigger modal -->
                <a href="/lokasiparkir" class="btn btn-secondary ml-2 float-left">Batal</a>

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
        <form action="/lokasiparkir/{{$parkinglocation->id}}" method="post">
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