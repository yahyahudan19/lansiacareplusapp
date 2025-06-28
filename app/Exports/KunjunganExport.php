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
                        'A' => 'Mandiri (A) : Dapat melakukan aktivitas sendiri tanpa bantuan orang lain',
                        'B' => 'Ketergantungan Ringan (B) : Membutuhkan bantuan orang lain dalam melakukan aktivitas tertentu/memakai kursi roda',
                        'B1' => 'Ketergantungan Sedang (B) : Mengalami gangguan dalam aktivitas sehari-hari sendiri, terutama dalam hal Buang Air Kecil (BAK) dan Buang Air Besar (BAB)',
                        'C' => 'Ketergantungan Berat (C) : Hanya bisa beraktivitas di atas tempat tidur',
                        'D' => 'Ketergantungan Total (D) : Sama sekali tidak mampu melakukan aktivitas hidup sehari-hari, sehingga sangat tergantung orang lain',
                        default => 'Tidak Ada Data',
                    },
                    'GDS' => match ($skrinings->gds ?? '') {
                        'A' => 'Sudah puas dengan kehidupan, bersemangat, merasa bahagia, menyenangkan',
                        'B' => 'Merasa bosan, lebih senang dirumah, meninggalkan banyak kesenangan, cemas, memiliki masalah daya ingat',
                        'C' => 'Merasa kehidupan hampa, tidak berdaya, tidak berharga, tidak ada harapan, keadaan orang lain lebih baik',
                        default => 'Tidak Ada Data',
                    },
                    'Merokok' => match ($skrinings->merokok ?? '') {
                        'Y' => 'Iya',
                        'TSB' => 'Tidak, Sudah Berhenti kurang dari 1 Tahun',
                        'TPS' => 'Tidak Pernah Sama Sekali',
                        default => 'Tidak Ada Data',
                    },
                    'Kognitif' => $skrinings->kognitif === 'Y' ? 'Ya' : ($skrinings->kognitif === 'N' ? 'Tidak' : 'Tidak Ada Data'),
                    'Mobilisasi' => $skrinings->mobilisasi === 'Y' ? 'Ya' : ($skrinings->mobilisasi === 'N' ? 'Tidak' : 'Tidak Ada Data'),
                    'Malnutrisi' => $skrinings->malnutrisi === 'Y' ? 'Ya' : ($skrinings->malnutrisi === 'N' ? 'Tidak' : 'Tidak Ada Data'),
                    'keterangan' => match ($skrinings->keterangan ?? '') {
                        'Tidak Ada' => 'Tidak Ada',
                        'Tidak ada Bahan Medis Habis Pakai' => 'Tidak ada Bahan Medis Habis Pakai',
                        'Belum dilakukan pemeriksaan' => 'Belum dilakukan pemeriksaan',
                        default => 'Tidak Ada Data',
                    },
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
            'GangguanPendengaran', 'ADL', 'GDS', 'Merokok', 'Kognitif', 'Mobilisasi', 'Malnutrisi',
            'keterangan','Timestamp', 'Status',
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
