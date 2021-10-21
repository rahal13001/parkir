<?php

namespace App\Exports;

use App\Models\Parking;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class ParkingsExport implements FromQuery, WithHeadings, WithStyles, WithColumnWidths
{
    use Exportable;

    protected $from_date;
    protected $to_date;

    public function __construct($from_date, $to_date)
    {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }
    public function query()
    {
        if (!empty($this->from_date)) {
            if ($this->from_date === $this->to_date) {

                //ga tau cara eloquentnya huhuhuhuhu maafkan
                $data =    DB::table('parkings')
                    ->join('parkinglocations', 'parkings.parkinglocation_id', '=', 'parkinglocations.id')
                    ->where('tanggal', '=', $this->to_date)
                    ->select('tanggal', 'jam', 'nomor_parkir', 'no_plat', 'nama', 'parkinglocations.nama_lokasi',   'parkings.jenis_kendaraan', 'warna', 'parkings.status')->orderBy('tanggal');
            } else {

                $data =    DB::table('parkings')
                    ->join('parkinglocations', 'parkings.parkinglocation_id', '=', 'parkinglocations.id')
                    ->whereBetween('tanggal', [$this->from_date, $this->to_date])
                    ->select('tanggal', 'jam', 'nomor_parkir', 'no_plat', 'nama', 'parkinglocations.nama_lokasi',   'parkings.jenis_kendaraan', 'warna', 'parkings.status')->orderBy('tanggal');
            }  // return Book::query()->whereBetween('tanggal', [$this->from_date, $this->to_date]);
        } else {
            $data =    DB::table('parkings')
                ->join('parkinglocations', 'parkings.parkinglocation_id', '=', 'parkinglocations.id')
                ->select('tanggal', 'jam', 'nomor_parkir', 'no_plat', 'nama', 'parkinglocations.nama_lokasi',   'parkings.jenis_kendaraan', 'warna', 'parkings.status')->orderBy('tanggal');
        }
        return $data;
    }
    public function headings(): array
    {
        return [
            'Tanggal',
            'Jam',
            'Nomor Parkir',
            'Nomor Plat',
            'Nama',
            'Lokasi',
            'Jenis Kendaraan',
            'Warna',
            'Status',
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]]
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 15,
            'B' => 12,
            'C' => 10,
            'D' => 15,
            'E' => 15,
            'F' => 35,
            'G' => 20,
            'H' => 35,
            'I' => 15,
        ];
    }
}
