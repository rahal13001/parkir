<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Http\Request;

class HolidaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Holiday $holiday, Request $request)
    {
        if (request()->ajax()) {

            //Jika request from_date ada value(datanya) maka
            if (!empty($request->from_date)) {
                //Jika tanggal awal(from_date) hingga tanggal akhir(to_date) adalah sama maka
                if ($request->from_date === $request->to_date) {
                    //kita filter tanggalnya sesuai dengan request from_date
                    $query = Holiday::whereDate('mulai', '=', $request->from_date)->get();
                } else {
                    //kita filter dari tanggal awal ke akhir
                    $query = Holiday::whereBetween('mulai', array($request->from_date, $request->to_date))->get();
                }
            } else {
                $query = Holiday::query();
            }

            return DataTables::of($query)

                ->addColumn('aksi', function ($query) {


                    return '
                            <a href = "' . route('holiday_edit', $query->id) . '"
                            class = "btn btn-warning float-left mr-2">
                                Edit </a>

                            <form action="' . route('holiday_delete', $query->id) . '" method="POST">
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
        return view('libur.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('libur.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'mulai' => 'required',
            'selesai' => 'required',
            'keterangan' => 'required',
            'lokasi' => 'required'
        ]);

        $data = $request->all();

        Holiday::create([
            'mulai' => $data['mulai'],
            'selesai' => $data['selesai'],
            'keterangan' => $data['keterangan'],
            'lokasi' =>  json_encode($data['lokasi'])

        ]);
        return redirect('/libur')->with('status', 'Data Hari Libur Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Holiday $holiday)
    {
        return view('libur.edit', compact('holiday'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Holiday $holiday)
    {
        $request->validate([
            'mulai' => 'required',
            'selesai' => 'required',
            'keterangan' => 'required',
            'lokasi' => 'required'
        ]);

        $data = $request->all();

        Holiday::where('id', $holiday->id)->update([
            'mulai' => $data['mulai'],
            'selesai' => $data['selesai'],
            'keterangan' => $data['keterangan'],
            'lokasi' =>  json_encode($data['lokasi'])

        ]);
        return redirect('/libur')->with('status', 'Data Hari Libur Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Holiday $holiday)
    {
        Holiday::destroy($holiday->id);
        return redirect()->route('holiday_index')->with('status', 'Data Hari Libur Berhasil Dihapus');
    }
}
