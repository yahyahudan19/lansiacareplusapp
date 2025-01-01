<?php

namespace App\Http\Controllers;

use App\Models\Kecamatans;
use App\Models\Kelurahans;
use App\Models\Kunjungans;
use Illuminate\Http\Request;

class KunjungansController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   $kecamatans = Kecamatans::all();
        $kelurahans = Kelurahans::all();
        $data_kunjungans = Kunjungans::orderBy('tanggal_kj', 'desc')->latest()->take(10)->get();

        return view('admin.kunjungan.index',compact('data_kunjungans','kecamatans','kelurahans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Kunjungans $kunjungans)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kunjungans $kunjungans)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kunjungans $kunjungans)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kunjungans $kunjungans)
    {
        //
    }
}
