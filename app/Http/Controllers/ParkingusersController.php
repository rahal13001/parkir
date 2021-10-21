<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use App\Models\Parking;
use App\Models\Parkinglocation;
use App\Models\Schedule;
use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\App;
use Spatie\OpeningHours\OpeningHours;
use Barryvdh\DomPDF\Facade as PDF;

class ParkingusersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Tampilan dasar
        $tgl = date('Y-m-d');
        $lokasiparkir = Parkinglocation::where(['status' => 'Bisa'])->get();
        $parkir = Parking::with('lokasiparkir')->where(['tanggal' =>  $tgl, 'status' => 'Masuk'])->get();


        //Melihat Jadwal Libur
        $libur = Holiday::whereDate('mulai', '<=', $tgl)->whereDate('selesai', '>=', $tgl)->orderBy('mulai')->limit(1)->get();

        //melihat hari ini libur atau ga
        $ceklibur = $libur->count();
        //eksekusi perintah jika libur
        if ($ceklibur > 0) {
            foreach ($libur as $holiday) {

                $selesai = $holiday->selesai;
                $keterangan = $holiday->keterangan;
            }


            //tampilan tanggal supaya Indonesia Banget
            $selesai = date('d-m-Y', strtotime($selesai));
            //Kasih tau kalau kami lagi libur
            $info = "Hari Ini Kami Sedang Libur, Sampai Tanggal " . $selesai . " Dalam Rangka " . $keterangan;
            return view('pengguna.pengguna', compact('parkir', 'lokasiparkir', 'info'));
        }


        $monday = Schedule::where(['hari' => 'Senin'])->get();
        foreach ($monday as $senin) {
            $masuk_monday = date("H:i", strtotime($senin->masuk));
            $istirahat_monday = date("H:i", strtotime($senin->istirahat));
            $buka_monday = date("H:i", strtotime($senin->buka));
            $tutup_monday = date("H:i", strtotime($senin->tutup));
        }

        $tuesday = Schedule::where(['hari' => 'Selasa'])->get();
        foreach ($tuesday as $selasa) {
            $masuk_tuesday = date("H:i", strtotime($selasa->masuk));
            $istirahat_tuesday = date("H:i", strtotime($selasa->istirahat));
            $buka_tuesday = date("H:i", strtotime($selasa->buka));
            $tutup_tuesday = date("H:i", strtotime($selasa->tutup));
        }

        $wednesday = Schedule::where(['hari' => 'Rabu'])->get();
        foreach ($wednesday as $rabu) {
            $masuk_wednesday = date("H:i", strtotime($rabu->masuk));
            $istirahat_wednesday = date("H:i", strtotime($rabu->istirahat));
            $buka_wednesday = date("H:i", strtotime($rabu->buka));
            $tutup_wednesday = date("H:i", strtotime($rabu->tutup));
        }

        $thursday = Schedule::where(['hari' => 'Kamis'])->get();
        foreach ($thursday as $kamis) {
            $masuk_thursday = date("H:i", strtotime($kamis->masuk));
            $istirahat_thursday = date("H:i", strtotime($kamis->istirahat));
            $buka_thursday = date("H:i", strtotime($kamis->buka));
            $tutup_thursday = date("H:i", strtotime($kamis->tutup));
        }

        $friday = Schedule::where(['hari' => 'Jumat'])->get();
        foreach ($friday as $jumat) {
            $masuk_friday = date("H:i", strtotime($jumat->masuk));
            $istirahat_friday = date("H:i", strtotime($jumat->istirahat));
            $buka_friday = date("H:i", strtotime($jumat->buka));
            $tutup_friday = date("H:i", strtotime($jumat->tutup));
        }

        $saturday = Schedule::where(['hari' => 'Sabtu'])->get();
        foreach ($saturday as $sabtu) {
            $masuk_saturday = date("H:i", strtotime($sabtu->masuk));
            $istirahat_saturday = date("H:i", strtotime($sabtu->istirahat));
            $buka_saturday = date("H:i", strtotime($sabtu->buka));
            $tutup_saturday = date("H:i", strtotime($sabtu->tutup));
        }

        $sunday = Schedule::where(['hari' => 'Minggu'])->get();
        foreach ($sunday as $minggu) {
            $masuk_sunday = date("H:i", strtotime($minggu->masuk));
            $istirahat_sunday = date("H:i", strtotime($minggu->istirahat));
            $buka_sunday = date("H:i", strtotime($minggu->buka));
            $tutup_sunday = date("H:i", strtotime($minggu->tutup));
        }
        //Buat jadwal pake spatie-opening hours
        $range = [
            'monday'     => [$buka_monday . '-' . $istirahat_monday, $masuk_monday . '-' . $tutup_monday],
            'tuesday'    => [$buka_tuesday . '-' . $istirahat_tuesday, $masuk_tuesday . '-' . $tutup_tuesday],
            'wednesday'  => [$buka_wednesday . '-' . $istirahat_wednesday, $masuk_wednesday . '-' . $tutup_wednesday],
            'thursday'   => [$buka_thursday . '-' . $istirahat_thursday, $masuk_thursday . '-' . $tutup_thursday],
            'friday'     => [$buka_friday . '-' . $istirahat_friday, $masuk_friday . '-' . $tutup_friday],
            'saturday'   => [$buka_saturday . '-' . $istirahat_saturday, $masuk_saturday . '-' . $tutup_saturday],
            'sunday'     => [$buka_sunday . '-' . $istirahat_sunday, $masuk_sunday . '-' . $tutup_sunday],
        ];
        $openingHours = OpeningHours::createAndMergeOverlappingRanges($range);
        $now = new DateTime('now');
        $range = $openingHours->currentOpenRange($now);

        if ($range) {
            $woro = "Halo Sahabat Pelayanan LPSPL Sorong, Hari Ini Kami Buka Pukul " . $range->start() . " - " . $range->end() . " WIT";

            //ini kalau ga lagi libur dan di jam pelayanan
            return view('pengguna.pengguna', compact('parkir', 'lokasiparkir', 'woro'));
        } else {
            $info = 'Mohon Maaf Pelayanan Tutup, Silahkan Coba Kembali Pada Hari dan Jam Kerja';
            //ini kalau ga lagi libur tapi di luar jam pelayanan
            return view('pengguna.pengguna', compact('parkir', 'lokasiparkir', 'info'));
        }


        return view('pengguna.pengguna', compact('parkir', 'lokasiparkir'));
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
        $request->validate([
            'nama' => 'required',
            'parkinglocation_id' => 'required',
            'no_plat' => 'required',
            'jenis_kendaraan' => 'required',
            'warna' => 'required'
        ]);


        $tanggal = date('Y-m-d');
        $jam = date('H:i:s');
        $nama = $request->nama;
        $no_plat = $request->no_plat;
        $parkinglocation_id = $request->parkinglocation_id;
        $jenis_kendaraan = $request->jenis_kendaraan;
        $warna = $request->warna;

        //Melihat Jadwal Libur
        $libur = Holiday::whereDate('mulai', '<=', $tanggal)->whereDate('selesai', '>=', $tanggal)->orderBy('mulai')->limit(1)->get();

        //melihat hari ini libur atau ga
        $ceklibur = $libur->count();

        //Jika hari libur
        if ($ceklibur > 0) {
            //Cek apakah lokasi yang dituju libur atau buka
            return redirect()->back()->with('status', 'Pelayanan Sedang Libur, Silahkan Isi Pada Hari dan Jam Kerja');
        }

        //perhatikan jumlah data berdasarkan tanggal, lokasi dan keperluan
        $cek_data = Parking::where(['tanggal' => $tanggal])->get();
        $hitung = $cek_data->count();

        //Jika Sudah ada nomor parkir di hari ini
        if ($hitung > 0) {
            //AMbil yang paling akhir dan tambahkan 1
            $urutan = Parking::where(['tanggal' => $tanggal])->latest('nomor_parkir')->limit(1)->get('nomor_parkir');
            foreach ($urutan as $urut) {
                $norut = $urut->nomor_parkir;
            }
            $nomor_parkir = $norut + 1;
        } else {
            //jika belum langsung aja 0 + 1
            $nomor_parkir = $hitung + 1;
        }

        //display nomor urut
        $display_nomorparkir = sprintf("%03s", $nomor_parkir);


        $monday = Schedule::where(['hari' => 'Senin'])->get();
        foreach ($monday as $senin) {
            $masuk_monday = date("H:i", strtotime($senin->masuk));
            $istirahat_monday = date("H:i", strtotime($senin->istirahat));
            $buka_monday = date("H:i", strtotime($senin->buka));
            $tutup_monday = date("H:i", strtotime($senin->tutup));
        }

        $tuesday = Schedule::where(['hari' => 'Selasa'])->get();
        foreach ($tuesday as $selasa) {
            $masuk_tuesday = date("H:i", strtotime($selasa->masuk));
            $istirahat_tuesday = date("H:i", strtotime($selasa->istirahat));
            $buka_tuesday = date("H:i", strtotime($selasa->buka));
            $tutup_tuesday = date("H:i", strtotime($selasa->tutup));
        }

        $wednesday = Schedule::where(['hari' => 'Rabu'])->get();
        foreach ($wednesday as $rabu) {
            $masuk_wednesday = date("H:i", strtotime($rabu->masuk));
            $istirahat_wednesday = date("H:i", strtotime($rabu->istirahat));
            $buka_wednesday = date("H:i", strtotime($rabu->buka));
            $tutup_wednesday = date("H:i", strtotime($rabu->tutup));
        }

        $thursday = Schedule::where(['hari' => 'Kamis'])->get();
        foreach ($thursday as $kamis) {
            $masuk_thursday = date("H:i", strtotime($kamis->masuk));
            $istirahat_thursday = date("H:i", strtotime($kamis->istirahat));
            $buka_thursday = date("H:i", strtotime($kamis->buka));
            $tutup_thursday = date("H:i", strtotime($kamis->tutup));
        }

        $friday = Schedule::where(['hari' => 'Jumat'])->get();
        foreach ($friday as $jumat) {
            $masuk_friday = date("H:i", strtotime($jumat->masuk));
            $istirahat_friday = date("H:i", strtotime($jumat->istirahat));
            $buka_friday = date("H:i", strtotime($jumat->buka));
            $tutup_friday = date("H:i", strtotime($jumat->tutup));
        }

        $saturday = Schedule::where(['hari' => 'Sabtu'])->get();
        foreach ($saturday as $sabtu) {
            $masuk_saturday = date("H:i", strtotime($sabtu->masuk));
            $istirahat_saturday = date("H:i", strtotime($sabtu->istirahat));
            $buka_saturday = date("H:i", strtotime($sabtu->buka));
            $tutup_saturday = date("H:i", strtotime($sabtu->tutup));
        }

        $sunday = Schedule::where(['hari' => 'Minggu'])->get();
        foreach ($sunday as $minggu) {
            $masuk_sunday = date("H:i", strtotime($minggu->masuk));
            $istirahat_sunday = date("H:i", strtotime($minggu->istirahat));
            $buka_sunday = date("H:i", strtotime($minggu->buka));
            $tutup_sunday = date("H:i", strtotime($minggu->tutup));
        }
        //Buat jadwal pake spatie-opening hours
        $range = [
            'monday'     => [$buka_monday . '-' . $istirahat_monday, $masuk_monday . '-' . $tutup_monday],
            'tuesday'    => [$buka_tuesday . '-' . $istirahat_tuesday, $masuk_tuesday . '-' . $tutup_tuesday],
            'wednesday'  => [$buka_wednesday . '-' . $istirahat_wednesday, $masuk_wednesday . '-' . $tutup_wednesday],
            'thursday'   => [$buka_thursday . '-' . $istirahat_thursday, $masuk_thursday . '-' . $tutup_thursday],
            'friday'     => [$buka_friday . '-' . $istirahat_friday, $masuk_friday . '-' . $tutup_friday],
            'saturday'   => [$buka_saturday . '-' . $istirahat_saturday, $masuk_saturday . '-' . $tutup_saturday],
            'sunday'     => [$buka_sunday . '-' . $istirahat_sunday, $masuk_sunday . '-' . $tutup_sunday],
        ];
        $openingHours = OpeningHours::createAndMergeOverlappingRanges($range);
        $now = new DateTime('now');
        $range = $openingHours->currentOpenRange($now);

        if ($range) {

            //melihat ketersediaan tempat parkir
            $eksis = Parkinglocation::where('id', $parkinglocation_id)->get();
            foreach ($eksis as $ada) {
                $keadaan = $ada->terparkir;
                $cek = $ada->kapasitas;
            }
            //cek ketersediaan tempat
            $tersedia = $cek - $keadaan;

            //Jika tempat penuh maka kembalikan
            if ($tersedia <= 0) {
                return redirect()->back()->with('status', 'Tempat Parkir Sudah Penuh, Silahkan Pilih Lokasi Lain Yang Masih Kosong');
            }

            //jika tidak penuh bisa lanjut simpan database
            Parking::create([
                'tanggal' => $tanggal,
                'nomor_parkir' => $nomor_parkir,
                'no_plat' => $no_plat,
                'nama' => $nama,
                'parkinglocation_id' => $parkinglocation_id,
                'jam' => $jam,
                'jenis_kendaraan' => $jenis_kendaraan,
                'warna' => $warna
            ]);

            //mengupdate data kendaraan yang terparkir di lokasi parkir
            $terparkir = $keadaan + 1;

            Parkinglocation::where('id', $parkinglocation_id)->update([
                'terparkir' => $terparkir
            ]);

            //melihat pengguna parkir dimana untuk dicantumkan dalam kartu parkir
            $locations = Parking::with('lokasiparkir')->where('parkinglocation_id', $parkinglocation_id)->get();
            foreach ($locations as $location) {
                $lokasi = $location->lokasiparkir->nama_lokasi;
            }

            return view('pengguna.nomorparkir', compact('jam', 'nama', 'tanggal', 'nomor_parkir', 'no_plat', 'lokasi', 'display_nomorparkir', 'jenis_kendaraan', 'warna'));
        } else {
            //Memanggil hari dalam bahasa inggris
            // $bukalagi = $openingHours->nextOpen($now)->format('D');
            //Mengubah hari ke bahasa Indoonesia
            // switch ($bukalagi) {
            //     case 'Mon':
            //         $hari = "Senin";
            //         break;
            //     case 'Tue':
            //         $hari = "Selasa";
            //         break;
            //     case 'Wed':
            //         $hari = "Rabu";
            //         break;
            //     case 'Thur':
            //         $hari = "Kamis";
            //         break;
            //     case 'Fri':
            //         $hari = "Jumat";
            //         break;
            //     case 'Sat':
            //         $hari = "Sabtu";
            //         break;
            //     case 'Sun':
            //         $hari = "Minggu";
            //         break;
            // }
            //Display pemberitahuan
            return redirect()->back()->with('status', 'Tempat Parkir Tutup, Silahkan Coba Lagi Saat Hari dan Jam Kerja');
        }
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    public function exportpdf(Request $request)
    {

        $nama = $request->nama;
        $nomor_parkir = $request->nomor_parkir;
        $tanggal = $request->tanggal;
        $jam = $request->jam;
        $no_plat = $request->no_plat;
        $jenis_kendaraan = $request->jenis_kendaraan;
        $warna = $request->warna;
        $lokasi = $request->lokasi;

        $pdf = PDF::loadView('kartu.kartu', compact('nama', 'tanggal', 'jam', 'no_plat', 'warna', 'nomor_parkir', 'jenis_kendaraan', 'lokasi'))->setPaper('a5', 'landscape');
        return $pdf->download('kartuparkir_' . $no_plat . '.pdf');
    }
}
