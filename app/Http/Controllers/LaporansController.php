<?php

namespace App\Http\Controllers;

use App\Models\Indikators;
use Illuminate\Http\Request;

class LaporansController extends Controller
{
    public function index(){
        $data_indikator = Indikators::get()->all();
        return view('admin.laporan.index',compact('data_indikator'));
    }
}
