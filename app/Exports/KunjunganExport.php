<?php

namespace App\Exports;

use App\Models\Kunjungans;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Carbon\Carbon;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class KunjunganExport implements FromCollection, WithHeadings, WithEvents,WithColumnFormatting
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = Carbon::parse($startDate)->startOfDay();
        $this->endDate = Carbon::parse($endDate)->endOfDay();
    }

    public function collection()
    {
        return Kunjungans::with(['person.kelurahan.kecamatan', 'skrinings'])
            ->whereBetween('created_at', [$this->startDate, $this->endDate])
            ->get()
            ->map(function ($kunjungan, $index) {
                $person = $kunjungan->person;
                $skrinings = $kunjungan->skrinings->first();

                return [
                    'NO' => $index + 1,
                    'NAMALENGKAP' => $person->nama,
                    'ALAMAT' => $person->alamat,
                    'RW' => $person->rw,
                    'KELURAHAN' => $person->kelurahan->nama ?? '',
                    'KECAMATAN' => $person->kelurahan->kecamatan->nama ?? '',
                    'NIK' => $person->nik,
                    'NoBPJS' => $person->bpjs,
                    'NoTelpHP' => $person->telp,
                    'JenisKelamin' => $person->jenis_kelamin,
                    'TglLahir' => $person->tanggal_lahir,
                    'Usia' => Carbon::parse($person->tanggal_lahir)->age,
                    'BeratBadan' => $kunjungan->berat_bdn,
                    'TinggiBadan' => $kunjungan->tinggi_bdn,
                    'LingkarPerut' => $kunjungan->lingkar_prt,
                    'Sistole' => $kunjungan->sistole,
                    'Diastole' => $kunjungan->diastole,
                    'GulaDarah' => $kunjungan->gula_drh,
                    'Kolesterol' => $kunjungan->kolesterol,
                    'AsamUrat' => $kunjungan->asam_urat,
                    'Ginjal' => $skrinings->ginjal === 'Y' ? 'Ya' : ($skrinings->ginjal === 'N' ? 'Tidak' : ''),
                    'GangguanPenglihatan' => $skrinings->penglihatan === 'Y' ? 'Ya' : ($skrinings->penglihatan === 'N' ? 'Tidak' : ''),
                    'GangguanPendengaran' => $skrinings->pendengaran === 'Y' ? 'Ya' : ($skrinings->pendengaran === 'N' ? 'Tidak' : ''),
                    'ADL' => match ($skrinings->adl ?? '') {
                        'A' => 'Mandiri (A)',
                        'B' => 'Ketergantungan Ringan (B)',
                        'B1' => 'Ketergantungan Sedang (B)',
                        'C' => 'Ketergantungan Berat (C)',
                        'D' => 'Ketergantungan Total (D)',
                        default => '',
                    },
                    'GDS' => $skrinings->gds === 'A' ? 'A : Normal' : ($skrinings->gds ?? ''),
                    'Timestamp' => $kunjungan->created_at->format('Y-m-d H:i:s'),
                    'Status' => $person->status,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'NO', 'NAMALENGKAP', 'ALAMAT', 'RW', 'KELURAHAN', 'KECAMATAN', 'NIK', 'NoBPJS', 'NoTelpHP',
            'JenisKelamin', 'TglLahir', 'Usia', 'BeratBadan', 'TinggiBadan', 'LingkarPerut', 'Sistole',
            'Diastole', 'GulaDarah', 'Kolesterol', 'AsamUrat', 'Ginjal', 'GangguanPenglihatan',
            'GangguanPendengaran', 'ADL', 'GDS', 'Timestamp', 'Status',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Auto-size untuk semua kolom A-Z (atau lebih kalau jumlah kolomnya lebih dari 26)
                foreach (range('A', 'Z') as $col) {
                    $event->sheet->getDelegate()->getColumnDimension($col)->setAutoSize(true);
                }

                // Jika kolom lebih dari Z (misal sampai AB), lanjutkan di sini
                foreach (range('A', 'B') as $prefix) {
                    foreach (range('A', 'Z') as $suffix) {
                        $col = $prefix . $suffix;
                        $event->sheet->getDelegate()->getColumnDimension($col)->setAutoSize(true);
                    }
                }
            },
        ];
    }

    public function columnFormats(): array
    {
        return [
            'G' => '0',  // G = kolom NIK
            'H' => '0',  // NoBPJS
            'I' => '0',  // NoTelpHP
        ];
    }

    
}
