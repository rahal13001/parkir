@extends('layouts.layout')

@section('judul', 'Edit Hari Libur')

@section('isi')


<div class="card shadow mb-4">
   
    <div class="col-lg-10 mx-auto">
        <div class="p-5">

            <form class="user" method="post" action="{{ route('holiday_update', $holiday->id) }}" enctype="">
                @method('put')
                @csrf
                <div class="form-row mt-3">
                  <div class="form-group col-sm-6">
                  <label for="mulai">Mulai</label>
                    <input type="date" class="form-control @error('mulai') is-invalid @enderror" name="mulai" id="mulai" placeholder="Masukan Tanggal" value="{{ $holiday->mulai }}">
                    @error('mulai') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                  </div>

                  <div class="form-group col-sm-6">
                    <label for="selesai">Selesai</label>
                      <input type="date" class="form-control @error('selesai') is-invalid @enderror" name="selesai" id="selesai" placeholder="Masukan Tanggal" value="{{  $holiday->selesai }}">
                      @error('selesai') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>

              </div>
              <div class="form-group mt-3">
                  <label for="keterangan">Keterangan</label>
                    <input type="text" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan" placeholder="Masukan Nama" value="{{ $holiday->keterangan }}">
                    @error('keterangan') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                  </div>
          
                  <div class="form-group mt-3">
                  <label for="lokasi">Lokasi (Tekan Control/Command saat memilih lebih dari satu lokasi)</label>
                  <select class="form-control form-select @error('lokasi') is-invalid @enderror" aria-label="lokasi" name="lokasi[]" multiple="multiple">
                      <option value="Sorong">Sorong</option>
                      <option value="Merauke">Merauke</option>
                      <option value="Ambon">Ambon</option>
                      <option value="Ternate">Ternate</option>
                      {{-- <option value="Morotai">Morotai</option> --}}
                    </select>
                    @error('lokasi') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                  </div>
                
                    
            
                        <button type="submit" class="btn btn-primary float-left">Edit</button>
            </form>
            <!-- Button trigger modal -->
                <a href="/libur" class="btn btn-secondary ml-2 float-left">Batal</a>

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
        <form action="/libur/{{$holiday->id}}" method="post">
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