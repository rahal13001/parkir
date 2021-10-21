<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Http\Request;

class SchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Schedule $schedule)
    {
        if (request()->ajax()) {

            $query = Schedule::query();
            return DataTables::of($query)

                ->addColumn('aksi', function ($query) {

                    return '
                            <div class="text-center">
                            <a href = "' . route('schedule_edit', $query->id) . '"
                            class = "btn btn-warning">
                                Edit </a></div>';
                })->rawColumns(['aksi'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('jadwal.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Schedule $schedule)
    {
        return view('jadwal.edit', compact('schedule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        $data = $request->all();

        Schedule::where('id', $schedule->id)->update([
            'hari' => $data['hari'],
            'buka' => $data['buka'],
            'istirahat' => $data['istirahat'],
            'masuk' => $data['masuk'],
            'tutup' => $data['tutup']
        ]);
        return redirect('/jamkerja')->with('status', 'Data Jam Kerja Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
