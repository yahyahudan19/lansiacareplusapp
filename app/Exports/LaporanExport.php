<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Font;
use App\Models\Puskesmas;
use App\Models\Kelurahans;
use App\Models\Indikators;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LaporansController;

class LaporanExport implements FromArray, WithHeadings, WithStyles
{
    protected $puskesmasId;
    protected $startDate;
    protected $endDate;
    protected $laporanController;
    protected $isAgregat;

    public function __construct($puskesmasId, $dateRange, $isAgregat = false)
    {
        $this->puskesmasId = $puskesmasId;
        $this->isAgregat = $isAgregat; // Simpan nilai isAgregat
        // $this->laporanController = new LaporansController();

        if ($dateRange) {
            $dates = explode(' - ', $dateRange);
            $this->startDate = Carbon::createFromFormat('m/d/Y', trim($dates[0]))->format('Y-m-d');
            $this->endDate = Carbon::createFromFormat('m/d/Y', trim($dates[1]))->format('Y-m-d');
        } else {
            $this->startDate = null;
            $this->endDate = null;
        }
    }

    private function buildCaseColumn($indicator): string
    {
        $conds = [];

        if (in_array($indicator->jenis_kelamin, ['L','P'], true)) {
            $conds[] = "p.jenis_kelamin = " . \DB::getPdo()->quote($indicator->jenis_kelamin);
        }
        if (!is_null($indicator->age_min)) {
            $conds[] = "TIMESTAMPDIFF(YEAR, p.tanggal_lahir, kj.tanggal_kj) >= " . (int)$indicator->age_min;
        }
        if (!is_null($indicator->age_max)) {
            $conds[] = "TIMESTAMPDIFF(YEAR, p.tanggal_lahir, kj.tanggal_kj) <= " . (int)$indicator->age_max;
        }

        switch ((int)$indicator->kelompok_id) {
            case 1: break; // DILAYANI: tidak tambah kondisi
            case 2: $conds[] = "s.adl = " . \DB::getPdo()->quote($indicator->target_value); break;
            case 3: $conds[] = "s.id IS NOT NULL"; break; // SCREENING
            case 4: $conds[] = "s.gds = " . \DB::getPdo()->quote($indicator->target_value); break;
            case 5:
                $imt = "(kj.berat_bdn / (kj.tinggi_bdn * kj.tinggi_bdn / 10000))";
                if ($indicator->target_value === 'LEBIH')        $conds[] = "$imt > 25";
                elseif ($indicator->target_value === 'NORMAL')   $conds[] = "$imt BETWEEN 18.5 AND 24.9";
                elseif ($indicator->target_value === 'KURANG')   $conds[] = "$imt < 18.5";
                else                                             $conds[] = "$imt >= 25";
                break;
            case 6: $conds[] = "kj.sistole >= 140 AND kj.diastole >= 90"; break;
            case 7: $conds[] = "kj.kolesterol > 200"; break;
            case 8: $conds[] = "kj.gula_drh > 200"; break;
            case 9: $conds[] = "((p.jenis_kelamin='L' AND kj.asam_urat>7) OR (p.jenis_kelamin='P' AND kj.asam_urat>6))"; break;
            case 10: $conds[] = "s.ginjal = " . \DB::getPdo()->quote($indicator->target_value); break;
            case 12: $conds[] = "s.penglihatan = " . \DB::getPdo()->quote($indicator->target_value); break;
            case 13: $conds[] = "s.pendengaran = " . \DB::getPdo()->quote($indicator->target_value); break;
            case 14: $conds[] = "s.merokok = " . \DB::getPdo()->quote($indicator->target_value); break;
            case 15: $conds[] = "s.kognitif = " . \DB::getPdo()->quote($indicator->target_value); break;
            case 16: $conds[] = "s.mobilisasi = " . \DB::getPdo()->quote($indicator->target_value); break;
            case 17: $conds[] = "s.malnutrisi = " . \DB::getPdo()->quote($indicator->target_value); break;
            case 18: $conds[] = "s.depresi = " . \DB::getPdo()->quote($indicator->target_value); break;
            default: $conds[] = "0";
        }

        $where = empty($conds) ? "1" : implode(' AND ', $conds);
        return "SUM(CASE WHEN ($where) THEN 1 ELSE 0 END) AS `i_{$indicator->id}`";
    }

   
    public function array(): array
    {
        $user = Auth::user()->load('puskesmas');
        if ($user->role === 'Puskesmas' && !$this->isAgregat) {
            if ($this->puskesmasId != $user->puskesmas->kode) {
                abort(403, 'Anda tidak memiliki akses ke laporan ini.');
            }
        }

        // daftar unit untuk header kolom
        if ($this->isAgregat) {
            $locations = Puskesmas::select('kode','nama')->orderBy('nama')->get();
        } else {
            $locations = Kelurahans::select('id','nama')
                ->where('puskesmas_kd', $this->puskesmasId)
                ->orderBy('nama')
                ->get();
        }

        $indicators = Indikators::with('kelompok')->orderBy('kelompok_id')->get();

        // siapkan SELECT kolom CASE untuk semua indikator
        $selects = [];
        foreach ($indicators as $indicator) {
            $selects[] = \DB::raw($this->buildCaseColumn($indicator));
        }

        // base query
        $q = \DB::table('kunjungans as kj')
            ->join('persons as p', 'p.id', '=', 'kj.person_id')
            ->join('kelurahans as kel', 'kel.id', '=', 'p.kelurahan_id')
            ->leftJoin('skrinings as s', 's.kunjungan_id', '=', 'kj.id')
            ->whereBetween('kj.tanggal_kj', [$this->startDate, $this->endDate]);

        if ($this->isAgregat) {
            $q->leftJoin('puskesmas as ps', 'ps.kode', '=', 'kel.puskesmas_kd')
            ->addSelect('ps.nama as unit_nama')
            ->groupBy('ps.nama')
            ->orderBy('ps.nama');
        } else {
            $q->where('kel.puskesmas_kd', $this->puskesmasId)
            ->addSelect('kel.nama as unit_nama')
            ->groupBy('kel.nama')
            ->orderBy('kel.nama');
        }

        $rows = $q->addSelect($selects)->get();

        // mapping ke struktur [unit_nama][i_{id}] => value
        $byUnit = [];
        foreach ($rows as $r) {
            $unit = $r->unit_nama ?? '-';
            $byUnit[$unit] = (array)$r; // berisi i_{id}
        }

        // ====== Rakit data export (header & body) ======
        $exportData = [];
        $title = $this->isAgregat ? 'Laporan Agregat Puskesmas' : 'Laporan Puskesmas';
        $exportData[] = [$title, 'Periode: '.$this->startDate.' - '.$this->endDate];

        $header = ['Kelompok', 'Indikator'];
        foreach ($locations as $loc) {
            $header[] = $loc->nama;
        }
        $header[] = 'Total';
        $exportData[] = $header;

        // body per indikator (ikut urutan indikator di Blade)
        foreach ($indicators as $indikator) {
            $kelompokNama = $indikator->kelompok->nama;
            $col = 'i_'.$indikator->id;

            $row = [$kelompokNama, $indikator->nama];
            $sum = 0;

            foreach ($locations as $loc) {
                $unitNama = $loc->nama;
                $val = isset($byUnit[$unitNama][$col]) ? (int)$byUnit[$unitNama][$col] : 0;
                $row[] = $val;
                $sum += $val;
            }
            $row[] = $sum;
            $exportData[] = $row;
        }

        return $exportData;
    }



    public function headings(): array
    {
        return [];
    }

    public function styles(Worksheet $sheet)
    {
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        foreach (range('A', $highestColumn) as $columnID) {
            if ($columnID === 'B') {
                $sheet->getColumnDimension($columnID)->setAutoSize(true);
            } else {
                $sheet->getColumnDimension($columnID)->setAutoSize(true);
                $sheet->getColumnDimension($columnID)->setWidth(20);
            }
        }

        $sheet->getStyle("A1:$highestColumn" . '2')->applyFromArray([
            'font' => [
                'bold' => true,
                'name' => 'Aptos',
                'size' => 12
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN
                ]
            ]
        ]);

        $sheet->getStyle("A3:$highestColumn$highestRow")->applyFromArray([
            'font' => [
                'name' => 'Aptos',
                'size' => 12
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN
                ]
            ]
        ]);

        for ($row = 2; $row <= $highestRow; $row++) {
            if (strpos($sheet->getCell('B' . $row)->getValue(), '(L+P)') !== false) {
                $sheet->getStyle("A$row:$highestColumn$row")->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'FFC107']
                    ]
                ]);
            }
            $sheet->getRowDimension($row)->setRowHeight(20); // Menyesuaikan tinggi baris agar tidak terlalu rapat
        }

        // Merge cells with the same "kelompok" value
        $currentKelompok = '';
        $startRow = 0;
        for ($row = 3; $row <= $highestRow; $row++) {
            $kelompok = $sheet->getCell('A' . $row)->getValue();
            if ($kelompok !== $currentKelompok) {
                if ($startRow !== 0 && $startRow !== $row - 1) {
                    $sheet->mergeCells("A$startRow:A" . ($row - 1));
                }
                $currentKelompok = $kelompok;
                $startRow = $row;
            }
        }
        if ($startRow !== 0 && $startRow !== $highestRow) {
            $sheet->mergeCells("A$startRow:A$highestRow");
        }

        return [];
    }
}
