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
    // public function index() {

    //     $kelurahans = Kelurahans::all();
    //     $puskesmas = Puskesmas::all();
    //     // // Ambil data indikator dan relasinya dengan kelompok
    //     $indicators = Indikators::with('kelompok')->get();

    //     // // Ambil kelurahans secara dinamis
    //     $kelurahans = Kelurahans::where('puskesmas_kd', '1033246')->get()->all();

    //     // // Ambil date range dari request, sementara hardcode
    //     $startDate = '2024-01-01';
    //     $endDate = '2024-01-01';

    //     // // Hitung data penduduk untuk setiap indikator
    //     $dataCounts = [];

    //     // // Loop setiap indikator
    //     // foreach ($indicators as $indicator) {
    //     //     foreach ($kelurahans as $kelurahan) {
    //     //         // Tentukan tabel dan kolom yang digunakan berdasarkan indikator
    //     //         $sourceTable = $indicator->source_table;
    //     //         $sourceColumn = $indicator->source_column;
    //     //         $calculationType = $indicator->calculation_type;

    //     //         // Jika source table adalah skrinings, join dengan kunjungans untuk ambil tanggal_kj
    //     //         if ($sourceTable === 'skrinings') {
    //     //             $query = DB::table('skrinings')
    //     //                 ->join('kunjungans', 'skrinings.kunjungan_id', '=', 'kunjungans.id')
    //     //                 ->join('persons', 'kunjungans.person_id', '=', 'persons.id')
    //     //                 ->where('persons.kelurahan_id', $kelurahan->id)
    //     //                 ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, persons.tanggal_lahir, CURDATE())'), [$indicator->age_min, $indicator->age_max])
    //     //                 ->whereDate('kunjungans.tanggal_kj', '>=', $startDate)
    //     //                 ->whereDate('kunjungans.tanggal_kj', '<=', $endDate);
    //     //         } else {
    //     //             // Query normal untuk tabel kunjungans (source table selain skrinings)
    //     //             $query = DB::table($sourceTable)
    //     //                 ->join('persons', "{$sourceTable}.person_id", '=', 'persons.id')
    //     //                 ->where('persons.kelurahan_id', $kelurahan->id)
    //     //                 ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, persons.tanggal_lahir, CURDATE())'), [$indicator->age_min, $indicator->age_max])
    //     //                 ->whereDate("{$sourceTable}.tanggal_kj", '>=', $startDate)
    //     //                 ->whereDate("{$sourceTable}.tanggal_kj", '<=', $endDate);
    //     //         }

    //     //         // Filter berdasarkan jenis kelamin jika ada
    //     //         $query->when($indicator->jenis_kelamin, function ($query) use ($indicator) {
    //     //             if ($indicator->jenis_kelamin !== 'L+P') {
    //     //                 $query->where('persons.jenis_kelamin', $indicator->jenis_kelamin);
    //     //             }
    //     //         });

    //     //         // Perhitungan berdasarkan tipe perhitungan khusus
    //     //         if ($calculationType === 'IMT') {
    //     //             // IMT = berat_bdn / (tinggi_bdn * tinggi_bdn)
    //     //             $query->select(DB::raw('AVG(berat_bdn / (tinggi_bdn * tinggi_bdn)) as imt'));
    //     //             $count = $query->value('imt');
    //     //         } elseif ($calculationType === 'HIPERTENSI') {
    //     //             // Hipertensi: Hitung orang dengan sistole >= 140 atau diastole >= 90
    //     //             $query->where(function($q) {
    //     //                 $q->where('sistole', '>=', 140)
    //     //                   ->orWhere('diastole', '>=', 90);
    //     //             });
    //     //             $count = $query->count();
    //     //         } elseif ($calculationType === 'count') {
    //     //             $count = $query->count();
    //     //         } elseif ($calculationType === 'sum') {
    //     //             $count = $query->sum($sourceColumn);
    //     //         } elseif ($calculationType === 'avg') {
    //     //             $count = $query->avg($sourceColumn);
    //     //         } else {
    //     //             $count = $query->count();
    //     //         }

    //     //         // Simpan hasil dalam array berdasarkan indikator dan kelurahan
    //     //         $dataCounts[$indicator->id][$kelurahan->id] = $count;
    //     //     }
    //     // }

    //     // return view('admin.laporan.index', compact('indicators', 'kelurahans', 'dataCounts'));
    //     return view('admin.laporan.index', compact('puskesmas','kelurahans','indicators'));
    // }

    public function index(Request $request)
    {
        $user = Auth::user()->load('puskesmas');
        $puskesmas = Puskesmas::all();

        // Ambil data kelurahan sesuai filter puskesmas
        $puskesmasId = $request->input('puskesmas', null);
        $kelurahans = Kelurahans::with('puskesmas')->where('puskesmas_kd', $puskesmasId)->get();

        // dd($puskesmasId);

        // Ambil date range dari request dan format ulang
        $dateRange = $request->input('date_range', null);
        if ($dateRange) {
            $dates = explode(' - ', $dateRange);
            $startDate = Carbon::createFromFormat('m/d/Y', $dates[0])->format('Y-m-d');
            $endDate = Carbon::createFromFormat('m/d/Y', $dates[1])->format('Y-m-d');
        } else {
            $startDate = null;
            $endDate = null;
        }

        // Jika tidak ada filter, tampilkan halaman kosong
        if (!$puskesmasId || !$dateRange) {
            return view('admin.laporan.index', compact('kelurahans', 'puskesmasId', 'puskesmas'))
                ->with('message', 'Silakan lakukan filter terlebih dahulu untuk melihat laporan.');
        }

         // Cek apakah user memiliki akses ke puskesmas yang diminta berdasarkan puskesmas_kd
         if ($user->role === 'Puskesmas') {
            if ($puskesmasId != $user->puskesmas->kode) {
                abort(403, 'Anda tidak memiliki akses ke laporan ini.');
            }
        }

        // Ambil semua indikator
        $indicators = Indikators::with('kelompok')->orderBy('kelompok_id')->get();

        $results = [];
        $totals = [];
        
        foreach ($kelurahans as $kelurahan) {
            foreach ($indicators as $indicator) {
                $count = $this->calculateCount(
                    $indicator,
                    $kelurahan,
                    $startDate,
                    $endDate,
                    $indicator->jenis_kelamin,
                    $indicator->age_min,
                    $indicator->age_max, 
                    false // Bukan agregat, jadi FALSE
                );

                // Simpan hasil per kelurahan
                $results[$kelurahan->nama][$indicator->kelompok->nama][$indicator->nama] = $count;
        
                // Hitung total per indikator di semua kelurahan
                if (!isset($totals[$indicator->kelompok->nama][$indicator->nama])) {
                    $totals[$indicator->kelompok->nama][$indicator->nama] = 0;
                }
                $totals[$indicator->kelompok->nama][$indicator->nama] += $count;
                
            }
        }

        // Simpan data log
        Log::create([
            'user_id' => auth()->user()->id,
            'username' => auth()->user()->username,
            'email' => auth()->user()->email,
            'category' => 'laporan',
            'activity' => 'generate',
            'details' => 'Laporan berhasil dibuat untuk Puskesmas ID: ' . $puskesmasId . ', Rentang Tanggal: ' . $startDate . ' hingga ' . $endDate,
        ]);

        // return response()->json($totals);
        return view('admin.laporan.index', compact('results', 'totals', 'kelurahans', 'puskesmasId', 'indicators', 'puskesmas','startDate','endDate'));
    }

    // private function calculateCount($indicator, $kelurahan, $startDate, $endDate, $jenisKelamin, $ageMin, $ageMax)
    // {
    //     switch ($indicator->kelompok_id) {
    //         case 1: // DILAYANI (D)
    //             return Kunjungans::whereBetween('tanggal_kj', [$startDate, $endDate])
    //                 ->whereHas('person', function ($q) use ($kelurahan, $jenisKelamin, $ageMin, $ageMax) {
    //                     $q->where('kelurahan_id', $kelurahan->id);
    //                     if ($jenisKelamin === 'L' || $jenisKelamin === 'P') {
    //                         $q->where('jenis_kelamin', $jenisKelamin);
    //                     }
    //                     if (!is_null($ageMin) && !is_null($ageMax)) {
    //                         $q->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN ? AND ?', [$ageMin, $ageMax]);
    //                     }
    //                 })
    //                 ->count();

    //         case 2: // MANDIRI
    //             return Skrinings::whereHas('kunjungan', function ($q) use ($kelurahan, $startDate, $endDate, $jenisKelamin, $ageMin, $ageMax) {
    //                 $q->whereBetween('tanggal_kj', [$startDate, $endDate])
    //                     ->whereHas('person', function ($q) use ($kelurahan, $jenisKelamin, $ageMin, $ageMax) {
    //                         $q->where('kelurahan_id', $kelurahan->id);
    //                         if ($jenisKelamin === 'L' || $jenisKelamin === 'P') {
    //                             $q->where('jenis_kelamin', $jenisKelamin);
    //                         }
    //                         if (!is_null($ageMin) && !is_null($ageMax)) {
    //                             $q->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN ? AND ?', [$ageMin, $ageMax]);
    //                         }
    //                     });
    //             })->where('adl', $indicator->target_value)->count();

    //         case 3: // SCREENING
    //             return Skrinings::whereHas('kunjungan', function ($q) use ($kelurahan, $startDate, $endDate, $jenisKelamin, $ageMin, $ageMax) {
    //                 $q->whereBetween('tanggal_kj', [$startDate, $endDate])
    //                     ->whereHas('person', function ($q) use ($kelurahan, $jenisKelamin, $ageMin, $ageMax) {
    //                         $q->where('kelurahan_id', $kelurahan->id);
    //                         if ($jenisKelamin === 'L' || $jenisKelamin === 'P') {
    //                             $q->where('jenis_kelamin', $jenisKelamin);
    //                         }
    //                         if (!is_null($ageMin) && !is_null($ageMax)) {
    //                             $q->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN ? AND ?', [$ageMin, $ageMax]);
    //                         }
    //                     });
    //             })->count();

    //         case 4: // GGN ME
    //             return Skrinings::whereHas('kunjungan', function ($q) use ($kelurahan, $startDate, $endDate, $jenisKelamin, $ageMin, $ageMax) {
    //                 $q->whereBetween('tanggal_kj', [$startDate, $endDate])
    //                     ->whereHas('person', function ($q) use ($kelurahan, $jenisKelamin, $ageMin, $ageMax) {
    //                         $q->where('kelurahan_id', $kelurahan->id);
    //                         if ($jenisKelamin === 'L' || $jenisKelamin === 'P') {
    //                             $q->where('jenis_kelamin', $jenisKelamin);
    //                         }
    //                         if (!is_null($ageMin) && !is_null($ageMax)) {
    //                             $q->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN ? AND ?', [$ageMin, $ageMax]);
    //                         }
    //                     });
    //             })->where('gds', 'Y')->count();

    //         case 5: // IMT
    //             return Kunjungans::whereBetween('tanggal_kj', [$startDate, $endDate])
    //                 ->whereHas('person', function ($q) use ($kelurahan, $jenisKelamin, $ageMin, $ageMax) {
    //                     $q->where('kelurahan_id', $kelurahan->id);
    //                     if ($jenisKelamin === 'L' || $jenisKelamin === 'P') {
    //                         $q->where('jenis_kelamin', $jenisKelamin);
    //                     }
    //                     if (!is_null($ageMin) && !is_null($ageMax)) {
    //                         $q->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN ? AND ?', [$ageMin, $ageMax]);
    //                     }
    //                 })
    //                 ->where(function ($q) use ($indicator) {
    //                     $q->when($indicator->target_value === 'LEBIH', function ($q) {
    //                         $q->whereRaw('berat_bdn / (tinggi_bdn * tinggi_bdn / 10000) > 25');
    //                     })
    //                         ->when($indicator->target_value === 'NORMAL', function ($q) {
    //                             $q->whereRaw('berat_bdn / (tinggi_bdn * tinggi_bdn / 10000) BETWEEN 18.5 AND 24.9');
    //                         })
    //                         ->when($indicator->target_value === 'KURANG', function ($q) {
    //                             $q->whereRaw('berat_bdn / (tinggi_bdn * tinggi_bdn / 10000) < 18.5');
    //                         });
    //                 })
    //                 ->count();

    //         case 6: // HIPERTENSI
    //             return Kunjungans::whereBetween('tanggal_kj', [$startDate, $endDate])
    //                 ->whereHas('person', function ($q) use ($kelurahan, $jenisKelamin, $ageMin, $ageMax) {
    //                     $q->where('kelurahan_id', $kelurahan->id);
    //                     if ($jenisKelamin === 'L' || $jenisKelamin === 'P') {
    //                         $q->where('jenis_kelamin', $jenisKelamin);
    //                     }
    //                     if (!is_null($ageMin) && !is_null($ageMax)) {
    //                         $q->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN ? AND ?', [$ageMin, $ageMax]);
    //                     }
    //                 })
    //                 ->where(function ($q) {
    //                     $q->where('sistole', '>', 140)->orWhere('diastole', '>', 90);
    //                 })
    //                 ->count();

    //         case 7: // KOLESTEROL TINGGI
    //             return Kunjungans::whereBetween('tanggal_kj', [$startDate, $endDate])
    //                 ->whereHas('person', function ($q) use ($kelurahan, $jenisKelamin, $ageMin, $ageMax) {
    //                     $q->where('kelurahan_id', $kelurahan->id);
    //                     if ($jenisKelamin === 'L' || $jenisKelamin === 'P') {
    //                         $q->where('jenis_kelamin', $jenisKelamin);
    //                     }
    //                     if (!is_null($ageMin) && !is_null($ageMax)) {
    //                         $q->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN ? AND ?', [$ageMin, $ageMax]);
    //                     }
    //                 })
    //                 ->where('kolesterol', '>', $indicator->target_value)
    //                 ->count();

    //         // Case 8: DIABETES MELITUS
    //         case 8:
    //             return Kunjungans::whereBetween('tanggal_kj', [$startDate, $endDate])
    //                 ->whereHas('person', function ($q) use ($kelurahan, $jenisKelamin, $ageMin, $ageMax) {
    //                     $q->where('kelurahan_id', $kelurahan->id);
    //                     if ($jenisKelamin === 'L' || $jenisKelamin === 'P') {
    //                         $q->where('jenis_kelamin', $jenisKelamin);
    //                     }
    //                     if (!is_null($ageMin) && !is_null($ageMax)) {
    //                         $q->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN ? AND ?', [$ageMin, $ageMax]);
    //                     }
    //                 })
    //                 ->where('gula_drh', '>', 200)
    //                 ->count();

    //         // Case 9: ASAM URAT TINGGI
    //         case 9:
    //             return Kunjungans::whereBetween('tanggal_kj', [$startDate, $endDate])
    //                 ->whereHas('person', function ($q) use ($kelurahan, $jenisKelamin, $ageMin, $ageMax) {
    //                     $q->where('kelurahan_id', $kelurahan->id);
    //                     if ($jenisKelamin === 'L') {
    //                         $q->where('asam_urat', '>', 7);
    //                     } elseif ($jenisKelamin === 'P') {
    //                         $q->where('asam_urat', '>', 6);
    //                     }
    //                     if (!is_null($ageMin) && !is_null($ageMax)) {
    //                         $q->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN ? AND ?', [$ageMin, $ageMax]);
    //                     }
    //                 })
    //                 ->count();

    //         // Case 10: GANGGUAN GINJAL
    //         case 10:
    //             return Skrinings::whereHas('kunjungan', function ($q) use ($kelurahan, $startDate, $endDate, $jenisKelamin, $ageMin, $ageMax) {
    //                 $q->whereBetween('tanggal_kj', [$startDate, $endDate])
    //                     ->whereHas('person', function ($q) use ($kelurahan, $jenisKelamin, $ageMin, $ageMax) {
    //                         $q->where('kelurahan_id', $kelurahan->id);
    //                         if ($jenisKelamin === 'L' || $jenisKelamin === 'P') {
    //                             $q->where('jenis_kelamin', $jenisKelamin);
    //                         }
    //                         if (!is_null($ageMin) && !is_null($ageMax)) {
    //                             $q->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN ? AND ?', [$ageMin, $ageMax]);
    //                         }
    //                     });
    //             })->where('ginjal', 'Y')->count();

    //         // Case 11: GANGGUAN PENGLIHATAN
    //         case 11:
    //             return Skrinings::whereHas('kunjungan', function ($q) use ($kelurahan, $startDate, $endDate, $jenisKelamin, $ageMin, $ageMax) {
    //                 $q->whereBetween('tanggal_kj', [$startDate, $endDate])
    //                     ->whereHas('person', function ($q) use ($kelurahan, $jenisKelamin, $ageMin, $ageMax) {
    //                         $q->where('kelurahan_id', $kelurahan->id);
    //                         if ($jenisKelamin === 'L' || $jenisKelamin === 'P') {
    //                             $q->where('jenis_kelamin', $jenisKelamin);
    //                         }
    //                         if (!is_null($ageMin) && !is_null($ageMax)) {
    //                             $q->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN ? AND ?', [$ageMin, $ageMax]);
    //                         }
    //                     });
    //             })->where('penglihatan', 'Y')->count();

    //         // Case 12: GANGGUAN PENDENGARAN
    //         case 12:
    //             return Skrinings::whereHas('kunjungan', function ($q) use ($kelurahan, $startDate, $endDate, $jenisKelamin, $ageMin, $ageMax) {
    //                 $q->whereBetween('tanggal_kj', [$startDate, $endDate])
    //                     ->whereHas('person', function ($q) use ($kelurahan, $jenisKelamin, $ageMin, $ageMax) {
    //                         $q->where('kelurahan_id', $kelurahan->id);
    //                         if ($jenisKelamin === 'L' || $jenisKelamin === 'P') {
    //                             $q->where('jenis_kelamin', $jenisKelamin);
    //                         }
    //                         if (!is_null($ageMin) && !is_null($ageMax)) {
    //                             $q->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN ? AND ?', [$ageMin, $ageMax]);
    //                         }
    //                     });
    //             })->where('pendengaran', 'Y')->count();

    //         // Case 13: ASAM URAT (>= 70 TAHUN)
    //         case 13:
    //             return Kunjungans::whereBetween('tanggal_kj', [$startDate, $endDate])
    //                 ->whereHas('person', function ($q) use ($kelurahan, $ageMin) {
    //                     $q->where('kelurahan_id', $kelurahan->id)
    //                     ->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= ?', [$ageMin]);
    //                 })
    //                 ->where(function ($q) {
    //                     $q->where('asam_urat', '>', 7)->orWhere('asam_urat', '>', 6);
    //                 })
    //                 ->count();

    //         default:
    //             return 0;
    //     }
    // }

    public function calculateCount($indicator, $location, $startDate, $endDate, $jenisKelamin, $ageMin, $ageMax,$isAgregat)
    {
        // Abstraksi filter person untuk digunakan di semua case
        // $filterPerson = function ($q) use ($kelurahan, $jenisKelamin, $ageMin, $ageMax) {
        //     $q->where('kelurahan_id', $kelurahan->id);
        //     if ($jenisKelamin === 'L' || $jenisKelamin === 'P') {
        //         $q->where('jenis_kelamin', $jenisKelamin);
        //     }
        //     if (!is_null($ageMin) && !is_null($ageMax)) {
        //         $q->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN ? AND ?', [$ageMin, $ageMax]);
        //     }
        // };

        // Abstraksi filter person untuk digunakan di semua case
        $filterPerson = function ($q) use ($location, $jenisKelamin, $ageMin, $ageMax, $isAgregat) {
            if ($isAgregat) {
                // Jika agregat, filter berdasarkan puskesmas
                $q->whereHas('kelurahan', function ($query) use ($location) {
                    $query->where('puskesmas_kd', $location->kode);
                });
            } else {
                // Jika bukan agregat, filter berdasarkan kelurahan
                $q->where('kelurahan_id', $location->id);
            }

            if ($jenisKelamin === 'L' || $jenisKelamin === 'P') {
                $q->where('jenis_kelamin', $jenisKelamin);
            }
            if (!is_null($ageMin) && !is_null($ageMax)) {
                $q->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN ? AND ?', [$ageMin, $ageMax]);
            }
        };


        // Gunakan switch-case untuk perhitungan berdasarkan kelompok
        switch ($indicator->kelompok_id) {
            case 1: // DILAYANI (D)
                return Kunjungans::whereBetween('tanggal_kj', [$startDate, $endDate])
                    ->whereHas('person', $filterPerson)
                    ->count();

            case 2: // MANDIRI
                return Skrinings::whereHas('kunjungan', function ($q) use ($filterPerson, $startDate, $endDate) {
                    $q->whereBetween('tanggal_kj', [$startDate, $endDate])->whereHas('person', $filterPerson);
                })->where('adl', $indicator->target_value)->count();

            case 3: // SCREENING
                return Skrinings::whereHas('kunjungan', function ($q) use ($filterPerson, $startDate, $endDate) {
                    $q->whereBetween('tanggal_kj', [$startDate, $endDate])->whereHas('person', $filterPerson);
                })->count();

            case 4: // GGN ME
                return Skrinings::whereHas('kunjungan', function ($q) use ($filterPerson, $startDate, $endDate) {
                    $q->whereBetween('tanggal_kj', [$startDate, $endDate])->whereHas('person', $filterPerson);
                })->where('gds', $indicator->target_value)->count();

            case 5: // IMT (Indeks Massa Tubuh)
                return Kunjungans::whereBetween('tanggal_kj', [$startDate, $endDate])
                    ->whereHas('person', $filterPerson)
                    ->where(function ($q) use ($indicator) {
                        $q->whereRaw('berat_bdn / (tinggi_bdn * tinggi_bdn / 10000) >= 25')
                            ->when($indicator->target_value === 'LEBIH', function ($q) {
                                return $q->whereRaw('berat_bdn / (tinggi_bdn * tinggi_bdn / 10000) > 25');
                            })
                            ->when($indicator->target_value === 'NORMAL', function ($q) {
                                return $q->whereRaw('berat_bdn / (tinggi_bdn * tinggi_bdn / 10000) BETWEEN 18.5 AND 24.9');
                            })
                            ->when($indicator->target_value === 'KURANG', function ($q) {
                                return $q->whereRaw('berat_bdn / (tinggi_bdn * tinggi_bdn / 10000) < 18.5');
                            });
                    })
                    ->count();

            case 6: // HIPERTENSI
                return Kunjungans::whereBetween('tanggal_kj', [$startDate, $endDate])
                    ->whereHas('person', $filterPerson)
                    ->where('sistole', '>=', 140)
                    ->where('diastole', '>=', 90)
                    ->count();

            case 7: // KOLESTEROL TINGGI
                return Kunjungans::whereBetween('tanggal_kj', [$startDate, $endDate])
                    ->whereHas('person', $filterPerson)
                    ->where('kolesterol', '>', 200)
                    ->count();

            case 8: // DIABETES MELITUS (Gula Darah > 200)
                return Kunjungans::whereBetween('tanggal_kj', [$startDate, $endDate])
                    ->whereHas('person', $filterPerson)
                    ->where('gula_drh', '>', 200)
                    ->count();

            case 9: // ASAM URAT TINGGI (Laki-laki >7, Perempuan >6)
                return Kunjungans::whereBetween('tanggal_kj', [$startDate, $endDate])
                    ->whereHas('person', $filterPerson)
                    ->whereHas('person', function ($q) {
                        $q->where(function ($query) {
                            $query->where('jenis_kelamin', 'L')->where('asam_urat', '>', 7);
                        })->orWhere(function ($query) {
                            $query->where('jenis_kelamin', 'P')->where('asam_urat', '>', 6);
                        });
                    })
                    ->count();
            case 12: // GANGGUAN PENGLIHATAN
                return Skrinings::whereHas('kunjungan', function ($q) use ($filterPerson, $startDate, $endDate) {
                    $q->whereBetween('tanggal_kj', [$startDate, $endDate])->whereHas('person', $filterPerson);
                })->where('penglihatan', $indicator->target_value)->count();

            case 13: // GANGGUAN PENDENGARAN
                return Skrinings::whereHas('kunjungan', function ($q) use ($filterPerson, $startDate, $endDate) {
                    $q->whereBetween('tanggal_kj', [$startDate, $endDate])->whereHas('person', $filterPerson);
                })->where('pendengaran', $indicator->target_value)->count();

            case 10: // GANGGUAN GINJAL
                return Skrinings::whereHas('kunjungan', function ($q) use ($filterPerson, $startDate, $endDate) {
                    $q->whereBetween('tanggal_kj', [$startDate, $endDate])->whereHas('person', $filterPerson);
                })->where('ginjal', $indicator->target_value)->count();
            case 14: // MEROKOK
                return Skrinings::whereHas('kunjungan', function ($q) use ($filterPerson, $startDate, $endDate) {
                    $q->whereBetween('tanggal_kj', [$startDate, $endDate])
                    ->whereHas('person', $filterPerson);
                })->where('merokok', $indicator->target_value)->count();

            case 15: // KOGNITIF
                return Skrinings::whereHas('kunjungan', function ($q) use ($filterPerson, $startDate, $endDate) {
                    $q->whereBetween('tanggal_kj', [$startDate, $endDate])
                    ->whereHas('person', $filterPerson);
                })->where('kognitif', $indicator->target_value)->count();

            case 16: // MOBILISASI
                return Skrinings::whereHas('kunjungan', function ($q) use ($filterPerson, $startDate, $endDate) {
                    $q->whereBetween('tanggal_kj', [$startDate, $endDate])
                    ->whereHas('person', $filterPerson);
                })->where('mobilisasi', $indicator->target_value)->count();

            case 17: // MALNUTRISI
                return Skrinings::whereHas('kunjungan', function ($q) use ($filterPerson, $startDate, $endDate) {
                    $q->whereBetween('tanggal_kj', [$startDate, $endDate])
                    ->whereHas('person', $filterPerson);
                })->where('malnutrisi', $indicator->target_value)->count();

            case 18: // DEPRESI
                return Skrinings::whereHas('kunjungan', function ($q) use ($filterPerson, $startDate, $endDate) {
                    $q->whereBetween('tanggal_kj', [$startDate, $endDate])
                    ->whereHas('person', $filterPerson);
                })->where('depresi', $indicator->target_value)->count();

            default:
                return 0;
        }
        
    }

    // public function exportExcel(Request $request)
    // {
    //     $puskesmas = Puskesmas::where('kode', $request->input('puskesmas'))->first();
    //     $dateRange = $request->input('date_range', '');

    //     // Format nama file
    //     $formattedPuskesmas = str_replace(' ', '_', strtolower($puskesmas->nama));
    //     $formattedDateRange = str_replace(['/', ' '], '', $dateRange);
    //     $fileName = "export_{$formattedPuskesmas}_{$formattedDateRange}.xlsx";

    //     return Excel::download(new LaporanExport($request->input('puskesmas'), $dateRange), $fileName);
    // }
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
        $puskesmas = Puskesmas::all();

        // Ambil date range dari request dan format ulang
        $dateRange = $request->input('date_range', null);
        if ($dateRange) {
            $dates = explode(' - ', $dateRange);
            $startDate = Carbon::createFromFormat('m/d/Y', $dates[0])->format('Y-m-d');
            $endDate = Carbon::createFromFormat('m/d/Y', $dates[1])->format('Y-m-d');
        } else {
            $startDate = null;
            $endDate = null;
        }

        // Jika tidak ada filter, tampilkan halaman kosong
        if (!$dateRange) {

            return view('admin.laporan.agregat', compact('puskesmas'))
                ->with('message', 'Silakan lakukan filter terlebih dahulu untuk melihat laporan.');
        }

        // Ambil semua indikator
        $indicators = Indikators::with('kelompok')->orderBy('kelompok_id')->get();

        $results = [];
        $totals = [];

        foreach ($puskesmas as $puskesmasItem) {
            foreach ($indicators as $indicator) {
                $count = $this->calculateCount(
                    $indicator,
                    $puskesmasItem,
                    $startDate,
                    $endDate,
                    $indicator->jenis_kelamin,
                    $indicator->age_min,
                    $indicator->age_max, 
                    true // Agregat, jadi TRUE
                );

                // Simpan hasil per puskesmas
                $results[$puskesmasItem->nama][$indicator->kelompok->nama][$indicator->nama] = $count;

                // Hitung total per indikator di semua puskesmas
                if (!isset($totals[$indicator->kelompok->nama][$indicator->nama])) {
                    $totals[$indicator->kelompok->nama][$indicator->nama] = 0;
                }
                $totals[$indicator->kelompok->nama][$indicator->nama] += $count;
            }
        }
        

        return view('admin.laporan.agregat', compact('results', 'totals', 'puskesmas', 'startDate', 'endDate','indicators'));
    }

    public function exportKunjunganExcel(Request $request)
    {
        // Ambil dan parsing date_range
        $range = $request->date_range;
        if (!$range || !Str::contains($range, ' - ')) {
            return back()->with('error', 'Format tanggal tidak valid.');
        }

        [$start, $end] = explode(' - ', $range);
        $startDate = Carbon::createFromFormat('m/d/Y', trim($start))->startOfDay();
        $endDate = Carbon::createFromFormat('m/d/Y', trim($end))->endOfDay();

        // Kirim ke Export
        $filename = 'Data_Kunjungan_' . now()->format('Ymd_His') . '.xlsx';
        return Excel::download(new KunjunganExport($startDate, $endDate), $filename);
    }

}
