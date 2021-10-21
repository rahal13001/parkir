<?php

namespace App\Http\Controllers;

use App\Models\Parking;
use App\Models\Parkinglocation;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Exports\ParkingsExport;
use Maatwebsite\Excel\Facades\Excel;

class ParkingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Parking $parking)
    {
        if (request()->ajax()) {

            //Jika request from_date ada value(datanya) maka
            if (!empty($request->from_date)) {
                //Jika tanggal awal(from_date) hingga tanggal akhir(to_date) adalah sama maka
                if ($request->from_date === $request->to_date) {
                    //kita filter tanggalnya sesuai dengan request from_date
                    $query = Parking::whereDate('tanggal', '=', $request->from_date)->whereNotNull('parkinglocation_id')->with('lokasiparkir')->get();
                } else {
                    //kita filter dari tanggal awal ke akhir
                    $query = Parking::whereBetween('tanggal', array($request->from_date, $request->to_date))->whereNotNull('parkinglocation_id')->with('lokasiparkir')->get();
                }
            } else {
                $query = Parking::query()->whereNotNull('parkinglocation_id')->with('lokasiparkir');
            }

            return DataTables::of($query)

                ->addColumn('aksi', function ($query) {
                    // $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i> Edit</a>';
                    // $button .= '&nbsp;&nbsp;';
                    // $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</button>';
                    // return $button;

                    return '
                                      
                            <a href = "' . route('parkiran_edit', $query->id) . '"
                            class = "btn btn-warning float-left mr-2">
                                Edit </a>

                            <form action="' . route('parkiran_delete', $query->id) . '" method="POST">
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
        return view('parkiran.parkir.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parkinglocation = Parkinglocation::where('status', 'Bisa')->get();
        return view('parkiran.parkir.tambah', compact('parkinglocation'));
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
            'nama' => 'required',
            'tanggal' => 'required',
            'jam' => 'required',
            'parkinglocation_id' => 'required',
            'no_plat' => 'required',
            'jenis_kendaraan' => 'required',
            'no_hp' => 'required',
            'merek' => 'required'
        ]);

        $tanggal = $request->tanggal;
        $jam = $request->jam;
        $nama = $request->nama;
        $no_plat = $request->no_plat;
        $parkinglocation_id = $request->parkinglocation_id;
        $jenis_kendaraan = $request->jenis_kendaraan;
        $warna = $request->warna;
        $no_hp = $request->no_hp;
        $merek = $request->merek;

        if ($request->nomor_parkir == null) {
            $cek_data = Parking::where(['tanggal' => $tanggal])->get();
            $hitung = $cek_data->count();

            if ($hitung > 0) {
                $urutan = Parking::where(['tanggal' => $tanggal])->latest('nomor_parkir')->limit(1)->get('nomor_parkir');
                foreach ($urutan as $urut) {
                    $nokir = $urut->nomor_parkir;
                }
                $nomor_parkir = $nokir + 1;
            } else {
                $nomor_parkir = $hitung + 1;
            }
        } else {
            $nomor_parkir = $request->nomor_parkir;
        }

        $eksis = Parkinglocation::where('id', $parkinglocation_id)->get('terparkir');
        foreach ($eksis as $ada) {
            $keadaan = $ada->terparkir;
            $cek = $ada->kapasitas;
        }


        if ($keadaan > $cek) {
            return redirect()->back()->with('status', 'Tempat Parkir Sudah Penuh, Silahkan Pilih Lokasi Lain Yang Masih Kosong');
        }


        Parking::create([
            'tanggal' => $tanggal,
            'nomor_parkir' => $nomor_parkir,
            'no_plat' => $no_plat,
            'nama' => $nama,
            'parkinglocation_id' => $parkinglocation_id,
            'jam' => $jam,
            'jenis_kendaraan' => $jenis_kendaraan,
            'warna' => $warna,
            'no_hp' => $no_hp,
            'merek' => $merek
        ]);

        $terparkir = $keadaan + 1;

        Parkinglocation::where('id', $parkinglocation_id)->update([
            'terparkir' => $terparkir
        ]);

        return redirect('/parkir')->with('status', 'Data Parkir Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Parking  $parking
     * @return \Illuminate\Http\Response
     */
    public function show(Parking $parking, Request $request)
    {
        if (request()->ajax()) {

            //Jika request from_date ada value(datanya) maka
            if (!empty($request->from_date)) {
                //Jika tanggal awal(from_date) hingga tanggal akhir(to_date) adalah sama maka
                if ($request->from_date === $request->to_date) {
                    //kita filter tanggalnya sesuai dengan request from_date
                    $query = Parking::whereDate('tanggal', '=', $request->from_date)->whereNotNull('parkinglocation_id')->with('lokasiparkir')->where(['status' => 'Masuk'])
                        ->get();
                } else {
                    //kita filter dari tanggal awal ke akhir
                    $query = Parking::whereBetween('tanggal', array($request->from_date, $request->to_date))->whereNotNull('parkinglocation_id')->with('lokasiparkir')->where('status', 'Masuk')->get();
                }
            } else {
                $query = Parking::query()->where('status', 'Masuk')->whereNotNull('parkinglocation_id')->with('lokasiparkir');
            }

            return DataTables::of($query)

                ->addColumn('aksi', function ($query) {

                    return '
                  
                            <form action="' . route('parkiran_keluar', $query->id) . '" method="POST">
                                ' . method_field('put') . csrf_field() . '
                                <button type="submit" class="btn btn-info mr-auto">
                                    Keluar
                                </button>
                            </form>
                    
                            ';
                })->rawColumns(['aksi'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('parkiran.parkir.terparkir');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Parking  $parking
     * @return \Illuminate\Http\Response
     */
    public function edit(Parking $parking)
    {
        $parkinglocation = Parkinglocation::where('status', 'Bisa')->get();
        $item = Parking::with('lokasiparkir')->where('id', $parking->id)->get();
        return view('parkiran.parkir.edit', compact('parking', 'parkinglocation', 'item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Parking  $parking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parking $parking)
    {
        $request->validate([
            'nama' => 'required',
            'tanggal' => 'required',
            'jam' => 'required',
            'parkinglocation_id' => 'required',
            'no_plat' => 'required',
            'no_hp' => 'required',
            'merek' => 'merek',
            'jenis_kendaraan' => 'required'
        ]);

        $tanggal = $request->tanggal;
        $jam = $request->jam;
        $nama = $request->nama;
        $no_plat = $request->no_plat;
        $parkinglocation_id = $request->parkinglocation_id;
        $jenis_kendaraan = $request->jenis_kendaraan;
        $warna = $request->warna;
        $status = $request->status;
        $no_hp = $request->no_hp;
        $merek = $request->merek;

        if ($request->nomor_parkir == null) {
            $cek_data = Parking::where(['tanggal' => $tanggal])->get();
            $hitung = $cek_data->count();

            if ($hitung > 0) {
                $urutan = Parking::where(['tanggal' => $tanggal])->latest('nomor_parkir')->limit(1)->get('nomor_parkir');
                foreach ($urutan as $urut) {
                    $nokir = $urut->nomor_parkir;
                }
                $nomor_parkir = $nokir + 1;
            } else {
                $nomor_parkir = $hitung + 1;
            }
        } else {
            $nomor_parkir = $request->nomor_parkir;
        }

        if ($status == 'Masuk') {
            $eksis = Parkinglocation::where('id', $parkinglocation_id)->get('terparkir');
            foreach ($eksis as $ada) {
                $keadaan = $ada->terparkir;
            }
            $terparkir = $keadaan + 1;

            Parkinglocation::where('id', $parkinglocation_id)->update([
                'terparkir' => $terparkir
            ]);
        } else {
            $eksis = Parkinglocation::where('id', $parkinglocation_id)->get('terparkir');
            foreach ($eksis as $ada) {
                $keadaan = $ada->terparkir;
            }
            $terparkir = $keadaan - 1;

            Parkinglocation::where('id', $parkinglocation_id)->update([
                'terparkir' => $terparkir
            ]);
        }

        //pengkondisian jika lokasi parkirnya di pindah
        //cek dulu sebelumnya dimana parkirnya
        $sebelumnya = Parking::with('lokasiparkir')->where('id', $parking->id)->get();
        foreach ($sebelumnya as $before) {
            $tempatlama = $before->parkinglocation_id;
            $jumlahlama = $before->lokasiparkir->terparkir;
        }
        //jika beneran pindah
        if ($tempatlama != $parkinglocation_id) {
            $terparkirlama = $jumlahlama - 1;

            Parkinglocation::where('id', $tempatlama)->update([
                'terparkir' => $terparkirlama
            ]);

            if ($status == 'Keluar') {
                $cekditempatbaru = Parkinglocation::where('id', $parkinglocation_id)->get('terparkir');
                foreach ($cekditempatbaru as $ada) {
                    $tempatbaru = $ada->terparkir;
                }
                $terparkirtempatbaru = $tempatbaru + 1;

                Parkinglocation::where('id', $parkinglocation_id)->update([
                    'terparkir' => $terparkirtempatbaru
                ]);
            }
        }

        Parking::where('id', $parking->id)->update([
            'tanggal' => $tanggal,
            'nomor_parkir' => $nomor_parkir,
            'no_plat' => $no_plat,
            'no_hp' => $no_hp,
            'merek' => $merek,
            'nama' => $nama,
            'parkinglocation_id' => $parkinglocation_id,
            'jam' => $jam,
            'jenis_kendaraan' => $jenis_kendaraan,
            'status' => $status,
            'warna' => $warna
        ]);
        return redirect('/parkir')->with('status', 'Data Parkir Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Parking  $parking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parking $parking)
    {

        //melihat data location id
        $panggil = Parking::with('lokasiparkir')->where('id', $parking->id)->get();
        //memanggil lokasiparkir id
        foreach ($panggil as $data) {
            $item = $data->lokasiparkir->id;
            $status = $data->status;
        }

        if ($status == 'Masuk') {
            $eksis = Parkinglocation::where('id', $item)->get('terparkir');
            foreach ($eksis as $ada) {
                $terparkir = $ada->terparkir;
            }

            $terparkir = $terparkir - 1;
            Parkinglocation::where('id', $item)->update([
                'terparkir' => $terparkir
            ]);
        }
        Parking::destroy($parking->id);

        return redirect('/parkir')->with('status', 'Data Parkir Berhasil Dihapus');
    }

    public function keluar(Parking $parking)
    {

        //melihat data location id
        $panggil = Parking::with('lokasiparkir')->where('id', $parking->id)->get();

        foreach ($panggil as $data) {
            $item = $data->lokasiparkir->id;
        }

        $eksis = Parkinglocation::where('id', $item)->get('terparkir');
        foreach ($eksis as $ada) {
            $terparkir = $ada->terparkir;
        }

        $terparkir = $terparkir - 1;
        Parkinglocation::where('id', $item)->update([
            'terparkir' => $terparkir
        ]);

        Parking::where('id', $parking->id)->update([
            'status' => 'Keluar',
        ]);

        return redirect('/kendaraanparkir')->with('status', 'Kendaraaan Dengan Plat ' . $parking->no_plat . ' Telah Keluar');
    }

    public function exportexcel(Request $request)
    {

        $from_date = $request->from_date;
        $to_date = $request->to_date;

        return Excel::download(new ParkingsExport($from_date, $to_date), 'parkir.xlsx');
    }
}
