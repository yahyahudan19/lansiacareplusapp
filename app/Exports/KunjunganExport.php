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
            ->whereBetween('tanggal_kj', [$this->startDate, $this->endDate])
            ->get()
            ->values() // reset key biar $index berurutan
            ->map(function ($kunjungan, $index) {
                $p  = $kunjungan->person;
                $sk = $kunjungan->skrinings->first();
                $yn = fn($v) => $v === 'Y' ? 'Ya' : ($v === 'N' ? 'Tidak' : 'Tidak Ada Data');

                return [
                    'NO'               => $index + 1,
                    'NAMALENGKAP'      => $p->nama,
                    'ALAMAT'           => $p->alamat,
                    'RW'               => $p->rw,
                    'KELURAHAN'        => $p->kelurahan->nama ?? '',
                    'KECAMATAN'        => $p->kelurahan->kecamatan->nama ?? '',
                    'NIK'              => (string) $p->nik,   // tetap simpan sebagai string; format TEXT di columnFormats
                    'NoBPJS'           => (string) $p->bpjs,
                    'NoTelpHP'         => (string) $p->telp,
                    'JenisKelamin'     => $p->jenis_kelamin,
                    'TglLahir'         => Carbon::parse($p->tanggal_lahir)->format('Y-m-d'),
                    'Usia'             => Carbon::parse($p->tanggal_lahir)->diffInYears($kunjungan->tanggal_kj ?? now()),
                    'BeratBadan'       => $kunjungan->berat_bdn,
                    'TinggiBadan'      => $kunjungan->tinggi_bdn,
                    'LingkarPerut'     => $kunjungan->lingkar_prt,
                    'Sistole'          => $kunjungan->sistole,
                    'Diastole'         => $kunjungan->diastole,
                    'GulaDarah'        => $kunjungan->gula_drh,
                    'Kolesterol'       => $kunjungan->kolesterol,
                    'AsamUrat'         => $kunjungan->asam_urat,
                    'Ginjal'           => $sk ? $yn($sk->ginjal) : 'Tidak Ada Data',
                    'GangguanPenglihatan' => $sk ? $yn($sk->penglihatan) : 'Tidak Ada Data',
                    'GangguanPendengaran' => $sk ? $yn($sk->pendengaran) : 'Tidak Ada Data',
                    'ADL' => match ($sk->adl ?? '') {
                        'A' => 'Mandiri (A) : Dapat melakukan aktivitas sendiri tanpa bantuan orang lain',
                        'B' => 'Ketergantungan Ringan (B) : Membutuhkan bantuan orang lain dalam melakukan aktivitas tertentu/memakai kursi roda',
                        'B1'=> 'Ketergantungan Sedang (B) : Mengalami gangguan dalam aktivitas sehari-hari sendiri, terutama dalam hal BAK/BAB',
                        'C' => 'Ketergantungan Berat (C) : Hanya bisa beraktivitas di atas tempat tidur',
                        'D' => 'Ketergantungan Total (D) : Sama sekali tidak mampu melakukan aktivitas harian',
                        default => 'Tidak Ada Data',
                    },
                    'GDS' => match ($sk->gds ?? '') {
                        'A' => 'Sudah puas dengan kehidupan, bersemangat, merasa bahagia, menyenangkan',
                        'B' => 'Merasa bosan, lebih senang di rumah, meninggalkan kesenangan, cemas, masalah daya ingat',
                        'C' => 'Merasa kehidupan hampa, tidak berdaya, tidak berharga, tidak ada harapan',
                        default => 'Tidak Ada Data',
                    },
                    'Merokok'    => match ($sk->merokok ?? '') {
                        'Y'   => 'Iya',
                        'TSB' => 'Tidak, Sudah Berhenti < 1 Tahun',
                        'TPS' => 'Tidak Pernah Sama Sekali',
                        default => 'Tidak Ada Data',
                    },
                    'Kognitif'   => $sk ? $yn($sk->kognitif)   : 'Tidak Ada Data',
                    'Mobilisasi' => $sk ? $yn($sk->mobilisasi) : 'Tidak Ada Data',
                    'Malnutrisi' => $sk ? $yn($sk->malnutrisi) : 'Tidak Ada Data',
                    'keterangan' => $sk->keterangan ?? 'Tidak Ada Data',
                    'Timestamp'  => Carbon::parse($kunjungan->created_at)->format('Y-m-d H:i:s'),
                    'Status'     => $p->status,
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
