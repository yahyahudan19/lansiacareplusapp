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
        $this->laporanController = new LaporansController();

        if ($dateRange) {
            $dates = explode(' - ', $dateRange);
            $this->startDate = Carbon::createFromFormat('m/d/Y', trim($dates[0]))->format('Y-m-d');
            $this->endDate = Carbon::createFromFormat('m/d/Y', trim($dates[1]))->format('Y-m-d');
        } else {
            $this->startDate = null;
            $this->endDate = null;
        }
    }

    // public function array(): array
    // {
    //     $user = Auth::user()->load('puskesmas');


    //      // Cek apakah user memiliki akses ke puskesmas yang diminta berdasarkan puskesmas_kd
    //      if ($user->role === 'Puskesmas') {
    //         if ($this->puskesmasId != $user->puskesmas->kode) {
    //             abort(403, 'Anda tidak memiliki akses ke laporan ini.');
    //         }
    //     }

    //     $kelurahans = Kelurahans::with('puskesmas')->where('puskesmas_kd', $this->puskesmasId)->get();
    //     $indicators = Indikators::with('kelompok')->orderBy('kelompok_id')->get();
        
    //     $results = [];
    //     $totals = [];

    //     foreach ($kelurahans as $kelurahan) {
    //         foreach ($indicators as $indicator) {
    //             $count = $this->laporanController->calculateCount(
    //                 $indicator,
    //                 $kelurahan,
    //                 $this->startDate,
    //                 $this->endDate,
    //                 $indicator->jenis_kelamin,
    //                 $indicator->age_min,
    //                 $indicator->age_max,
    //                 false // Agregat, jadi TRUE
    //             );
                
    //             if ($count === null) {
    //                 $count = 0;
    //             }

    //             $results[$kelurahan->nama][$indicator->kelompok->nama][$indicator->nama] = $count;
                
    //             if (!isset($totals[$indicator->kelompok->nama][$indicator->nama])) {
    //                 $totals[$indicator->kelompok->nama][$indicator->nama] = 0;
    //             }
    //             $totals[$indicator->kelompok->nama][$indicator->nama] += $count;
    //         }
    //     }

    //     $exportData = [];
    //     $exportData[] = ['Laporan Puskesmas', 'Periode: ' . $this->startDate . ' - ' . $this->endDate];

    //     $header = ['Kelompok', 'Indikator'];
    //     foreach ($kelurahans as $kelurahan) {
    //         $header[] = $kelurahan->nama;
    //     }
    //     $header[] = 'Total';
    //     $exportData[] = $header;

    //     foreach ($indicators as $indicator) {
    //         $kelompokNama = $indicator->kelompok->nama;
    //         $row = [$kelompokNama, $indicator->nama];
    //         foreach ($kelurahans as $kelurahan) {
    //             $value = $results[$kelurahan->nama][$kelompokNama][$indicator->nama] ?? 0;
    //             $row[] = $value;
    //         }
    //         $row[] = $totals[$kelompokNama][$indicator->nama] ?? 0;
    //         $exportData[] = $row;
    //     }

    //     return $exportData;
    // }
    public function array(): array
    {
        $user = Auth::user()->load('puskesmas');

        if ($user->role === 'Puskesmas' && !$this->isAgregat) {
            if ($this->puskesmasId != $user->puskesmas->kode) {
                abort(403, 'Anda tidak memiliki akses ke laporan ini.');
            }
        }

        // Jika mode agregat, ambil semua puskesmas
        if ($this->isAgregat) {
            $locations = Puskesmas::all();
        } else {
            $locations = Kelurahans::where('puskesmas_kd', $this->puskesmasId)->get();
        }

        $indicators = Indikators::with('kelompok')->orderBy('kelompok_id')->get();
        $results = [];
        $totals = [];

        foreach ($locations as $location) {
            foreach ($indicators as $indicator) {
                $count = $this->laporanController->calculateCount(
                    $indicator,
                    $location,
                    $this->startDate,
                    $this->endDate,
                    $indicator->jenis_kelamin,
                    $indicator->age_min,
                    $indicator->age_max,
                    $this->isAgregat // TRUE jika agregat
                );

                if ($count === null) {
                    $count = 0;
                }

                $results[$location->nama][$indicator->kelompok->nama][$indicator->nama] = $count;

                if (!isset($totals[$indicator->kelompok->nama][$indicator->nama])) {
                    $totals[$indicator->kelompok->nama][$indicator->nama] = 0;
                }
                $totals[$indicator->kelompok->nama][$indicator->nama] += $count;
            }
        }
        
        // Format data untuk di-export ke Excel
        $exportData = [];
        $title = $this->isAgregat ? 'Laporan Agregat Puskesmas' : 'Laporan Puskesmas';
        $exportData[] = [$title, 'Periode: ' . $this->startDate . ' - ' . $this->endDate];

        $header = ['Kelompok', 'Indikator'];
        foreach ($locations as $location) {
            $header[] = $location->nama;
        }
        $header[] = 'Total';
        $exportData[] = $header;

        foreach ($indicators as $indicator) {
            $kelompokNama = $indicator->kelompok->nama;
            $row = [$kelompokNama, $indicator->nama];
            foreach ($locations as $location) {
                $value = $results[$location->nama][$kelompokNama][$indicator->nama] ?? 0;
                $row[] = $value;
            }
            $row[] = $totals[$kelompokNama][$indicator->nama] ?? 0;
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
