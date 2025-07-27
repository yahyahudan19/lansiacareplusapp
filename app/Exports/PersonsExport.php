<?php

namespace App\Exports;

use App\Models\Persons;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class PersonsExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting, WithColumnWidths, ShouldQueue
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection(): \Illuminate\Support\Collection
    {
        $query = Persons::query();

        if ($this->request->kategori === "Lansia") {
            $query->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, ?) >= 60', [Carbon::now()->toDateString()]);
        } elseif ($this->request->kategori === "Pra-Lansia") {
            $query->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, ?) >= 45 AND TIMESTAMPDIFF(YEAR, tanggal_lahir, ?) < 60', [Carbon::now()->toDateString(), Carbon::now()->toDateString()]);
        }

        if ($this->request->kelurahan_filter) {
            $query->where('kelurahan_id', $this->request->kelurahan_filter);
        } elseif ($this->request->kecamatan_filter) {
            $query->whereHas('kelurahan', function ($q) {
                $q->where('kecamatan_id', $this->request->kecamatan_filter);
            });
        }

        if ($this->request->status_skrining === "Sudah") {
            $query->whereHas('Kunjungan', function ($q) {
                $q->whereYear('tanggal_kj', Carbon::now()->year);
            });
        } elseif ($this->request->status_skrining === "Belum") {
            $query->whereDoesntHave('Kunjungan', function ($q) {
                $q->whereYear('tanggal_kj', Carbon::now()->year);
            });
        }

        return $query->with('kelurahan', 'kelurahan.kecamatan')->get(); // Batasi jumlah data yang diambil untuk performa
    }

    public function map($person): array
    {
        $status = $person->kunjungan
            ->where('tanggal_kj', '>=', Carbon::now()->startOfYear())
            ->isNotEmpty() ? 'Sudah' : 'Belum';

        return [
            $person->nik,
            $person->nama,
            $person->jenis_kelamin === 'L' ? 'Laki-Laki' : ($person->jenis_kelamin === 'P' ? 'Perempuan' : '-'),
            $person->tanggal_lahir ? Carbon::parse($person->tanggal_lahir)->translatedFormat('d F Y') : '-',
            $person->kelurahan->nama ?? '-',
            $person->kelurahan->kecamatan->nama ?? '-',
            $status,
        ];
    }

    public function headings(): array
    {
        return [
            'NIK',
            'Nama',
            'Jenis Kelamin',
            'Tanggal Lahir',
            'Kelurahan',
            'Kecamatan',
            'Status Skrining',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_NUMBER, // Kolom NIK jadi number biasa tanpa koma
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 25, // NIK
            'B' => 25, // Nama
            'C' => 15, // Jenis Kelamin
            'D' => 18, // Tanggal Lahir
            'E' => 25, // Kelurahan
            'F' => 25, // Kecamatan
            'G' => 20, // Status Skrining
        ];
    }



    
}
