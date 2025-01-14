<?php

namespace App\Http\Controllers;

use App\Models\Indikators;
use App\Models\Kelurahans;
use App\Models\Kunjungans;
use App\Models\Persons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporansController extends Controller
{
    public function index() {
        // Ambil data indikator dan relasinya dengan kelompok
        $indicators = Indikators::with('kelompok')->get();
    
        // Ambil kelurahans secara dinamis
        $kelurahans = Kelurahans::where('puskesmas_kd', '1033246')->get()->all();
    
        // Ambil date range dari request, sementara hardcode
        $startDate = '2024-01-01';
        $endDate = '2024-01-01';
    
        // Hitung data penduduk untuk setiap indikator
        $dataCounts = [];
    
        // Loop setiap indikator
        foreach ($indicators as $indicator) {
            foreach ($kelurahans as $kelurahan) {
                // Tentukan tabel dan kolom yang digunakan berdasarkan indikator
                $sourceTable = $indicator->source_table;
                $sourceColumn = $indicator->source_column;
                $calculationType = $indicator->calculation_type;
    
                // Jika source table adalah skrinings, join dengan kunjungans untuk ambil tanggal_kj
                if ($sourceTable === 'skrinings') {
                    $query = DB::table('skrinings')
                        ->join('kunjungans', 'skrinings.kunjungan_id', '=', 'kunjungans.id')
                        ->join('persons', 'kunjungans.person_id', '=', 'persons.id')
                        ->where('persons.kelurahan_id', $kelurahan->id)
                        ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, persons.tanggal_lahir, CURDATE())'), [$indicator->age_min, $indicator->age_max])
                        ->whereDate('kunjungans.tanggal_kj', '>=', $startDate)
                        ->whereDate('kunjungans.tanggal_kj', '<=', $endDate);
                } else {
                    // Query normal untuk tabel kunjungans (source table selain skrinings)
                    $query = DB::table($sourceTable)
                        ->join('persons', "{$sourceTable}.person_id", '=', 'persons.id')
                        ->where('persons.kelurahan_id', $kelurahan->id)
                        ->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR, persons.tanggal_lahir, CURDATE())'), [$indicator->age_min, $indicator->age_max])
                        ->whereDate("{$sourceTable}.tanggal_kj", '>=', $startDate)
                        ->whereDate("{$sourceTable}.tanggal_kj", '<=', $endDate);
                }
    
                // Filter berdasarkan jenis kelamin jika ada
                $query->when($indicator->jenis_kelamin, function ($query) use ($indicator) {
                    if ($indicator->jenis_kelamin !== 'L+P') {
                        $query->where('persons.jenis_kelamin', $indicator->jenis_kelamin);
                    }
                });
    
                // Perhitungan berdasarkan tipe perhitungan khusus
                if ($calculationType === 'IMT') {
                    // IMT = berat_bdn / (tinggi_bdn * tinggi_bdn)
                    $query->select(DB::raw('AVG(berat_bdn / (tinggi_bdn * tinggi_bdn)) as imt'));
                    $count = $query->value('imt');
                } elseif ($calculationType === 'HIPERTENSI') {
                    // Hipertensi: Hitung orang dengan sistole >= 140 atau diastole >= 90
                    $query->where(function($q) {
                        $q->where('sistole', '>=', 140)
                          ->orWhere('diastole', '>=', 90);
                    });
                    $count = $query->count();
                } elseif ($calculationType === 'count') {
                    $count = $query->count();
                } elseif ($calculationType === 'sum') {
                    $count = $query->sum($sourceColumn);
                } elseif ($calculationType === 'avg') {
                    $count = $query->avg($sourceColumn);
                } else {
                    $count = $query->count();
                }
    
                // Simpan hasil dalam array berdasarkan indikator dan kelurahan
                $dataCounts[$indicator->id][$kelurahan->id] = $count;
            }
        }
    
        return view('admin.laporan.index', compact('indicators', 'kelurahans', 'dataCounts'));
    }
    
}
