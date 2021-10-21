@extends('layouts.layout')

@section('judul', 'Jam Kerja Pelayanan')

@section('isi')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.css"
integrity="sha256-pODNVtK3uOhL8FUNWWvFQK0QoQoV3YA9wGGng6mbZ0E=" crossorigin="anonymous" />

<div class="card shadow mb-4">
    <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Jam Pelayanan LPSPL Sorong</h6>
    </div>
    @if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session ('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
    </div>
    @endif
        <div class="card-body">
         
            <!-- AKHIR DATE RANGE PICKER -->
            <div class="table-responsive">
                    <table class="table table-bordered table-hover scroll-horizontal-vertical" id="crudTable" width="100%" cellspacing="0" id="crudtable">
                <thead class="thead-dark text-center">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Hari</th>
                        <th scope="col">Buka</th>
                        <th scope="col">Istirahat</th>
                        <th scope="col">Masuk</th>
                        <th scope="col">Tutup</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
            </table>
            </div>
    </div>
</div>


@endsection

@push('addon-script')




{{-- Tombol panah Anak Table --}}
    <script>




//Ajax Data Table Mulai
       $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

    load_data();
        // AJAX DataTable
        function load_data(from_date = '', to_date = '') {
        var datatable = $('#crudTable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            order: [[ 0, "asc" ]],
            ajax: {
                url: '{!! url()->current() !!}',
                type: 'GET',
                data:{from_date:from_date, to_date:to_date},
            },
            columns: [
                    // {data: 'null', sortable : false,
                    // render : function (data, type, row, meta){
                    // return meta.row + meta.setting._iDisplayStart + 1;}},
                    { data:'id',
                      sortable: false, 
                       render: function (data, type, row, meta) {
                     return meta.row + meta.settings._iDisplayStart + 1;
                      } },
                    // {data: 'id', name : 'id'},
                    {data: 'hari', name : 'hari'},
                    {data: 'buka', name : 'buka'},
                    {data: 'istirahat', name : 'istirahat'},
                    {data: 'masuk', name : 'masuk'},
                    {data: 'tutup', name : 'tutup'},
                    {
                        data: 'aksi',
                        name : 'aksi',
                        orderable : false,
                        searchable : false,
                        width : '15%'
                    },
            ]
        });
     
        }
    });

   


    </script>
@endpush