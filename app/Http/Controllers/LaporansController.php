<?php

namespace App\Http\Controllers;

use App\Exports\KunjunganExport;
use App\Exports\LaporanExport;
use App\Models\Indikators;
use App\Models\Kecamatans;
use App\Models\Kelurahans;
use App\Models\Kunjungans;
use App\Models\Log;
use App\Models\Persons;
use App\Models\Puskesmas;
use App\Models\Skrinings;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class LaporansController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user()->load('puskesmas');
        $puskesmas = Puskesmas::all();

        $puskesmasId = $request->input('puskesmas');
        $dateRange = $request->input('date_range');

        // Filter awal
        $kelurahans = Kelurahans::with('puskesmas')
            ->when($puskesmasId, fn($q) => $q->where('puskesmas_kd', $puskesmasId))
            ->get();

        if (!$puskesmasId || !$dateRange) {
            return view('admin.laporan.index', compact('kelurahans', 'puskesmasId', 'puskesmas'))
                ->with('message', 'Silakan lakukan filter terlebih dahulu untuk melihat laporan.');
        }

        // Akses kontrol user Puskesmas
        if ($user->role === 'Puskesmas' && $puskesmasId != $user->puskesmas->kode) {
            abort(403, 'Anda tidak memiliki akses ke laporan ini.');
        }

        // Parse tanggal
        [$startDate, $endDate] = array_map(
            fn($d) => Carbon::createFromFormat('m/d/Y', $d)->format('Y-m-d'),
            explode(' - ', $dateRange)
        );

        // Ambil indikator
        $indicators = Indikators::with('kelompok')->orderBy('kelompok_id')->get();

        // Buat kolom agregat untuk semua indikator
        $selectCases = [];
        foreach ($indicators as $indicator) {
            $selectCases[] = $this->buildCaseColumn($indicator);
        }

        // Query agregat sekali jalan
        $rows = \DB::table('kelurahans as k')
            ->selectRaw('k.nama as kelurahan_nama, ' . implode(', ', $selectCases))
            ->leftJoin('persons as p', 'p.kelurahan_id', '=', 'k.id')
            ->leftJoin('kunjungans as kj', 'kj.person_id', '=', 'p.id')
            ->leftJoin('skrinings as s', 's.kunjungan_id', '=', 'kj.id')
            ->when($puskesmasId, fn($q) => $q->where('k.puskesmas_kd', $puskesmasId))
            ->when($startDate && $endDate, fn($q) => $q->whereBetween('kj.tanggal_kj', [$startDate, $endDate]))
            ->groupBy('k.id', 'k.nama')
            ->get();

        // Map hasil ke format $results dan $totals seperti lama
        $results = [];
        $totals = [];

        foreach ($rows as $row) {
            foreach ($indicators as $indicator) {
                $val = (int) $row->{'i_'.$indicator->id};
                $kelompok = $indicator->kelompok->nama;
                $results[$row->kelurahan_nama][$kelompok][$indicator->nama] = $val;
                $totals[$kelompok][$indicator->nama] = ($totals[$kelompok][$indicator->nama] ?? 0) + $val;
            }
        }

        // Log aktivitas
        Log::create([
            'user_id' => auth()->user()->id,
            'username' => auth()->user()->username,
            'email' => auth()->user()->email,
            'category' => 'laporan',
            'activity' => 'generate',
            'details' => 'Laporan berhasil dibuat untuk Puskesmas ID: ' . $puskesmasId . ', Rentang Tanggal: ' . $startDate . ' hingga ' . $endDate,
        ]);

        return view('admin.laporan.index', compact(
            'results', 'totals', 'kelurahans', 'puskesmasId', 'indicators', 'puskesmas', 'startDate', 'endDate'
        ));
    }


    // public function calculateCount($indicator, $location, $startDate, $endDate, $jenisKelamin, $ageMin, $ageMax,$isAgregat)
    // {

    //     // Abstraksi filter person untuk digunakan di semua case
    //     $filterPerson = function ($q) use ($location, $jenisKelamin, $ageMin, $ageMax, $isAgregat) {
    //         if ($isAgregat) {
    //             // Jika agregat, filter berdasarkan puskesmas
    //             $q->whereHas('kelurahan', function ($query) use ($location) {
    //                 $query->where('puskesmas_kd', $location->kode);
    //             });
    //         } else {
    //             // Jika bukan agregat, filter berdasarkan kelurahan
    //             $q->where('kelurahan_id', $location->id);
    //         }

    //         if ($jenisKelamin === 'L' || $jenisKelamin === 'P') {
    //             $q->where('jenis_kelamin', $jenisKelamin);
    //         }
    //         if (!is_null($ageMin) && !is_null($ageMax)) {
    //             $q->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN ? AND ?', [$ageMin, $ageMax]);
    //         }
    //     };


    //     // Gunakan switch-case untuk perhitungan berdasarkan kelompok
    //     switch ($indicator->kelompok_id) {
    //         case 1: // DILAYANI (D)
    //             return Kunjungans::whereBetween('tanggal_kj', [$startDate, $endDate])
    //                 ->whereHas('person', $filterPerson)
    //                 ->count();

    //         case 2: // MANDIRI
    //             return Skrinings::whereHas('kunjungan', function ($q) use ($filterPerson, $startDate, $endDate) {
    //                 $q->whereBetween('tanggal_kj', [$startDate, $endDate])->whereHas('person', $filterPerson);
    //             })->where('adl', $indicator->target_value)->count();

    //         case 3: // SCREENING
    //             return Skrinings::whereHas('kunjungan', function ($q) use ($filterPerson, $startDate, $endDate) {
    //                 $q->whereBetween('tanggal_kj', [$startDate, $endDate])->whereHas('person', $filterPerson);
    //             })->count();

    //         case 4: // GGN ME
    //             return Skrinings::whereHas('kunjungan', function ($q) use ($filterPerson, $startDate, $endDate) {
    //                 $q->whereBetween('tanggal_kj', [$startDate, $endDate])->whereHas('person', $filterPerson);
    //             })->where('gds', $indicator->target_value)->count();

    //         case 5: // IMT (Indeks Massa Tubuh)
    //             return Kunjungans::whereBetween('tanggal_kj', [$startDate, $endDate])
    //                 ->whereHas('person', $filterPerson)
    //                 ->where(function ($q) use ($indicator) {
    //                     $q->whereRaw('berat_bdn / (tinggi_bdn * tinggi_bdn / 10000) >= 25')
    //                         ->when($indicator->target_value === 'LEBIH', function ($q) {
    //                             return $q->whereRaw('berat_bdn / (tinggi_bdn * tinggi_bdn / 10000) > 25');
    //                         })
    //                         ->when($indicator->target_value === 'NORMAL', function ($q) {
    //                             return $q->whereRaw('berat_bdn / (tinggi_bdn * tinggi_bdn / 10000) BETWEEN 18.5 AND 24.9');
    //                         })
    //                         ->when($indicator->target_value === 'KURANG', function ($q) {
    //                             return $q->whereRaw('berat_bdn / (tinggi_bdn * tinggi_bdn / 10000) < 18.5');
    //                         });
    //                 })
    //                 ->count();

    //         case 6: // HIPERTENSI
    //             return Kunjungans::whereBetween('tanggal_kj', [$startDate, $endDate])
    //                 ->whereHas('person', $filterPerson)
    //                 ->where('sistole', '>=', 140)
    //                 ->where('diastole', '>=', 90)
    //                 ->count();

    //         case 7: // KOLESTEROL TINGGI
    //             return Kunjungans::whereBetween('tanggal_kj', [$startDate, $endDate])
    //                 ->whereHas('person', $filterPerson)
    //                 ->where('kolesterol', '>', 200)
    //                 ->count();

    //         case 8: // DIABETES MELITUS (Gula Darah > 200)
    //             return Kunjungans::whereBetween('tanggal_kj', [$startDate, $endDate])
    //                 ->whereHas('person', $filterPerson)
    //                 ->where('gula_drh', '>', 200)
    //                 ->count();

    //         case 9: // ASAM URAT TINGGI (Laki-laki >7, Perempuan >6)
    //             return Kunjungans::whereBetween('tanggal_kj', [$startDate, $endDate])
    //                 ->whereHas('person', $filterPerson)
    //                 ->whereHas('person', function ($q) {
    //                     $q->where(function ($query) {
    //                         $query->where('jenis_kelamin', 'L')->where('asam_urat', '>', 7);
    //                     })->orWhere(function ($query) {
    //                         $query->where('jenis_kelamin', 'P')->where('asam_urat', '>', 6);
    //                     });
    //                 })
    //                 ->count();
    //         case 12: // GANGGUAN PENGLIHATAN
    //             return Skrinings::whereHas('kunjungan', function ($q) use ($filterPerson, $startDate, $endDate) {
    //                 $q->whereBetween('tanggal_kj', [$startDate, $endDate])->whereHas('person', $filterPerson);
    //             })->where('penglihatan', $indicator->target_value)->count();

    //         case 13: // GANGGUAN PENDENGARAN
    //             return Skrinings::whereHas('kunjungan', function ($q) use ($filterPerson, $startDate, $endDate) {
    //                 $q->whereBetween('tanggal_kj', [$startDate, $endDate])->whereHas('person', $filterPerson);
    //             })->where('pendengaran', $indicator->target_value)->count();

    //         case 10: // GANGGUAN GINJAL
    //             return Skrinings::whereHas('kunjungan', function ($q) use ($filterPerson, $startDate, $endDate) {
    //                 $q->whereBetween('tanggal_kj', [$startDate, $endDate])->whereHas('person', $filterPerson);
    //             })->where('ginjal', $indicator->target_value)->count();
    //         case 14: // MEROKOK
    //             return Skrinings::whereHas('kunjungan', function ($q) use ($filterPerson, $startDate, $endDate) {
    //                 $q->whereBetween('tanggal_kj', [$startDate, $endDate])
    //                 ->whereHas('person', $filterPerson);
    //             })->where('merokok', $indicator->target_value)->count();

    //         case 15: // KOGNITIF
    //             return Skrinings::whereHas('kunjungan', function ($q) use ($filterPerson, $startDate, $endDate) {
    //                 $q->whereBetween('tanggal_kj', [$startDate, $endDate])
    //                 ->whereHas('person', $filterPerson);
    //             })->where('kognitif', $indicator->target_value)->count();

    //         case 16: // MOBILISASI
    //             return Skrinings::whereHas('kunjungan', function ($q) use ($filterPerson, $startDate, $endDate) {
    //                 $q->whereBetween('tanggal_kj', [$startDate, $endDate])
    //                 ->whereHas('person', $filterPerson);
    //             })->where('mobilisasi', $indicator->target_value)->count();

    //         case 17: // MALNUTRISI
    //             return Skrinings::whereHas('kunjungan', function ($q) use ($filterPerson, $startDate, $endDate) {
    //                 $q->whereBetween('tanggal_kj', [$startDate, $endDate])
    //                 ->whereHas('person', $filterPerson);
    //             })->where('malnutrisi', $indicator->target_value)->count();

    //         case 18: // DEPRESI
    //             return Skrinings::whereHas('kunjungan', function ($q) use ($filterPerson, $startDate, $endDate) {
    //                 $q->whereBetween('tanggal_kj', [$startDate, $endDate])
    //                 ->whereHas('person', $filterPerson);
    //             })->where('depresi', $indicator->target_value)->count();

    //         default:
    //             return 0;
    //     }
        
    // }

    private function buildCaseColumn($indicator): string
    {
        $c = [];

        // filter gender/umur (ikut logic lama)
        if (in_array($indicator->jenis_kelamin, ['L','P'], true)) {
            $c[] = "p.jenis_kelamin = " . \DB::getPdo()->quote($indicator->jenis_kelamin);
        }
        if (!is_null($indicator->age_min)) {
            $c[] = "TIMESTAMPDIFF(YEAR, p.tanggal_lahir, kj.tanggal_kj) >= " . (int)$indicator->age_min;
        }
        if (!is_null($indicator->age_max)) {
            $c[] = "TIMESTAMPDIFF(YEAR, p.tanggal_lahir, kj.tanggal_kj) <= " . (int)$indicator->age_max;
        }

        // kondisi spesifik sesuai switch lama
        switch ((int)$indicator->kelompok_id) {
            case 1: /* DILAYANI */ break; // semua kunjungan yg lolos filter
            case 2: /* MANDIRI(ADL) */ $c[] = "s.adl = " . \DB::getPdo()->quote($indicator->target_value); break;
            case 3: /* SCREENING   */ $c[] = "s.id IS NOT NULL"; break;
            case 4: /* GGN ME(GDS) */ $c[] = "s.gds = " . \DB::getPdo()->quote($indicator->target_value); break;
            case 5: { // IMT
                $imt = "(kj.berat_bdn / (kj.tinggi_bdn * kj.tinggi_bdn / 10000))";
                if ($indicator->target_value === 'LEBIH')   $c[] = "$imt > 25";
                elseif ($indicator->target_value === 'NORMAL') $c[] = "$imt BETWEEN 18.5 AND 24.9";
                elseif ($indicator->target_value === 'KURANG') $c[] = "$imt < 18.5";
                else $c[] = "$imt >= 25";
                break;
            }
            case 6: $c[] = "kj.sistole >= 140 AND kj.diastole >= 90"; break;
            case 7: $c[] = "kj.kolesterol > 200"; break;
            case 8: $c[] = "kj.gula_drh > 200"; break;
            case 9: $c[] = "((p.jenis_kelamin='L' AND kj.asam_urat>7) OR (p.jenis_kelamin='P' AND kj.asam_urat>6))"; break;
            case 10: $c[] = "s.ginjal = " . \DB::getPdo()->quote($indicator->target_value); break;
            case 12: $c[] = "s.penglihatan = " . \DB::getPdo()->quote($indicator->target_value); break;
            case 13: $c[] = "s.pendengaran = " . \DB::getPdo()->quote($indicator->target_value); break;
            case 14: $c[] = "s.merokok = " . \DB::getPdo()->quote($indicator->target_value); break;
            case 15: $c[] = "s.kognitif = " . \DB::getPdo()->quote($indicator->target_value); break;
            case 16: $c[] = "s.mobilisasi = " . \DB::getPdo()->quote($indicator->target_value); break;
            case 17: $c[] = "s.malnutrisi = " . \DB::getPdo()->quote($indicator->target_value); break;
            case 18: $c[] = "s.depresi = " . \DB::getPdo()->quote($indicator->target_value); break;
            default: $c[] = "0"; break;
        }

        $where = empty($c) ? "1" : implode(' AND ', $c);
        return "SUM(CASE WHEN ($where) THEN 1 ELSE 0 END) AS `i_{$indicator->id}`";
    }

    public function exportExcel(Request $request)
    {
        $isAgregat = $request->input('is_agregat', false);
        $puskesmasId = $isAgregat ? null : $request->input('puskesmas'); // Jika agregat, tidak perlu filter puskesmas
        $dateRange = $request->input('date_range', '');

        // Format nama file
        $formattedDateRange = str_replace(['/', ' '], '', $dateRange);
        $fileType = $isAgregat ? "agregat" : "puskesmas_{$puskesmasId}";
        $fileName = "export_{$fileType}_{$formattedDateRange}.xlsx";

        return Excel::download(new LaporanExport($puskesmasId, $dateRange, $isAgregat), $fileName);
    }

    public function agregat(Request $request)
    {
        $puskesmas = Puskesmas::select('kode','nama')->orderBy('nama')->get();

        $dateRange = $request->input('date_range');
        if (!$dateRange) {
            return view('admin.laporan.agregat', compact('puskesmas'))
                ->with('message', 'Silakan lakukan filter terlebih dahulu untuk melihat laporan.');
        }

        [$s,$e]   = array_map('trim', explode(' - ', $dateRange));
        $startDate= \Carbon\Carbon::createFromFormat('m/d/Y', $s)->format('Y-m-d');
        $endDate  = \Carbon\Carbon::createFromFormat('m/d/Y', $e)->format('Y-m-d');

        $indicators = Indikators::with('kelompok')->orderBy('kelompok_id')->get();

        // SELECT: total + kolom per indikator
        $selects = [
            'kel.puskesmas_kd as puskesmas_kd',
            'ps.nama as puskesmas_nama',
            \DB::raw('COUNT(*) as total_kunjungan'),
        ];
        foreach ($indicators as $indicator) {
            $selects[] = \DB::raw($this->buildCaseColumn($indicator));
        }

        // 1 query agregat group by puskesmas
        $rows = \DB::table('kunjungans as kj')
            ->join('persons as p', 'p.id', '=', 'kj.person_id')
            ->join('kelurahans as kel', 'kel.id', '=', 'p.kelurahan_id')
            ->leftJoin('puskesmas as ps', 'ps.kode', '=', 'kel.puskesmas_kd')
            ->leftJoin('skrinings as s', 's.kunjungan_id', '=', 'kj.id')
            ->whereBetween('kj.tanggal_kj', [$startDate, $endDate])
            ->when($request->filled('puskesmas_kd'), fn($q) =>
                $q->where('kel.puskesmas_kd', $request->input('puskesmas_kd'))
            )
            ->select($selects)
            ->groupBy('kel.puskesmas_kd','ps.nama')
            ->orderBy('ps.nama')
            ->get();

        // mapping ke struktur Blade saat ini
        $results = [];
        $totals  = [];
        foreach ($rows as $row) {
            $unitNama = $row->puskesmas_nama ?? $row->puskesmas_kd;

            foreach ($indicators as $indikator) {
                $kelompokNama = $indikator->kelompok->nama;
                $col = 'i_'.$indikator->id;
                $val = (int)($row->$col ?? 0);

                $results[$unitNama][$kelompokNama][$indikator->nama] = $val;

                if (!isset($totals[$kelompokNama][$indikator->nama])) {
                    $totals[$kelompokNama][$indikator->nama] = 0;
                }
                $totals[$kelompokNama][$indikator->nama] += $val;
            }
        }

        return view('admin.laporan.agregat', compact(
            'puskesmas','startDate','endDate','indicators','results','totals'
        ));
    }

    public function exportKunjunganExcel(Request $request)
    {
        $range = $request->date_range;
        if (!$range || !Str::contains($range, ' - ')) {
            return back()->with('error', 'Format tanggal tidak valid.');
        }

        [$start, $end] = explode(' - ', $range);
        $startDate = Carbon::createFromFormat('m/d/Y', trim($start))->startOfDay();
        $endDate   = Carbon::createFromFormat('m/d/Y', trim($end))->endOfDay();

        $filename = 'Data_Kunjungan_' . now()->format('Ymd_His') . '.xlsx';
        return Excel::download(new KunjunganExport($startDate, $endDate), $filename);
    }


}
