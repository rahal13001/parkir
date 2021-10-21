<?php

namespace App\Http\Controllers;

use App\Models\Parkinglocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;


class ParkinglocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {

            $query = Parkinglocation::query();
            return DataTables::of($query)

                ->addColumn('aksi', function ($query) {

                    return '
                            <div class="text-center">
                            <a href = "' . route('lokasiparkir_edit', $query->id) . '"
                            class = "btn btn-warning float-left mr-2">
                                Edit </a></div>
                                <form action="' . route('lokasiparkir_delete', $query->id) . '" method="POST">
                                ' . method_field('delete') . csrf_field() . '
                                <button type="submit" class="btn btn-danger" onclick = "return confirm(\'Anda yakin ingin menghapus data ?\') ">
                                    Hapus
                                </button>
                            </form>
                                ';
                })->rawColumns(['aksi'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('parkiran.lokasi_parkir.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('parkiran.lokasi_parkir.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        Parkinglocation::create($data);

        return redirect('/lokasiparkir')->with('status', 'Data Lokasi Parkir Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Parkinglocation  $parkinglocation
     * @return \Illuminate\Http\Response
     */
    public function show(Parkinglocation $parkinglocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Parkinglocation  $parkinglocation
     * @return \Illuminate\Http\Response
     */
    public function edit(Parkinglocation $parkinglocation)
    {
        return view('parkiran.lokasi_parkir.edit', compact('parkinglocation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Parkinglocation  $parkinglocation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parkinglocation $parkinglocation)
    {
        $data = $request->all();

        Parkinglocation::where('id', $parkinglocation->id)->update([
            'nama_lokasi' => $data['nama_lokasi'],
            'jenis_kendaraan' => $data['jenis_kendaraan'],
            'kapasitas' => $data['kapasitas'],
            'status' => $data['status'],
        ]);
        return redirect('/lokasiparkir')->with('status', 'Data Lokasi Parkir Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Parkinglocation  $parkinglocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parkinglocation $parkinglocation)
    {

        Parkinglocation::destroy($parkinglocation->id);
        return redirect('/lokasiparkir')->with('status', 'Data Lokasi Parkir Berhasil Dihapus');
    }
}
