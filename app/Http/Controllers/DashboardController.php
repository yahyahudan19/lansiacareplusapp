<?php

namespace App\Http\Controllers;

use App\Models\Kunjungans;
use App\Models\Persons;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlah_penduduk = number_format(Persons::count(), 0, ',', '.');
        $jumlah_kunjungan = number_format(Kunjungans::count(), 0, ',', '.');

        return view('dashboard', compact('jumlah_penduduk', 'jumlah_kunjungan'));

    }
}
