<?php

namespace App\Http\Controllers;

use App\Models\Kelurahans;
use App\Models\Kunjungans;
use App\Models\Persons;
use App\Models\Puskesmas;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlah_penduduk = number_format(Persons::count(), 0, ',', '.');

        if (auth()->user()->role === 'Puskesmas' || auth()->user()->role === 'Kader') {
            $jumlah_kunjungan = number_format(Kunjungans::whereHas('person.kelurahan', function ($query) {
            $query->where('puskesmas_kd', auth()->user()->puskesmas->kode);
            })->count(), 0, ',', '.');
        } else {
            $jumlah_kunjungan = number_format(Kunjungans::count(), 0, ',', '.');
        }
        $jumlah_puskesmas = number_format(Puskesmas::where('nama', '!=', 'Dinas Kesehatan Kota Malang')->count(), 0, ',', '.');
        $jumlah_kelurahan = number_format(Kelurahans::count(), 0, ',', '.');
        
        return view('dashboard', compact('jumlah_penduduk', 'jumlah_kunjungan', 'jumlah_puskesmas', 'jumlah_kelurahan'));

    }
}
