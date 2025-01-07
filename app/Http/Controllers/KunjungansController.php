<?php

namespace App\Http\Controllers;

use App\Models\Kecamatans;
use App\Models\Kelurahans;
use App\Models\Kunjungans;
use App\Models\Persons;
use App\Models\Skrinings;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
    public function create_view(Request $request)
    {
        $dapen = Persons::where('nik',$request->nik)->first();

        // dd($dapen);
        
        return view('admin.kunjungan.create', compact('dapen'));
    }
    /**
     * Show the form for detail resource.
     */
    public function detail_view($id)
    {
        $dapen = Persons::findOrFail($id);

        $dakun = Kunjungans::where('person_id',$id)->orderBy('tanggal_kj', 'desc')->first();
        $dakrin = Skrinings::where('kunjungan_id',$dakun->id)->latest()->first();

        $riwkin = Kunjungans::where('person_id', $id)
            ->orderBy('tanggal_kj', 'desc')
            ->get(); // Ambil semua data terlebih dahulu
            
        $riwkin_sliced = $riwkin->slice(1); // Potong elemen pertama
        // dd($riwkin);
        $riwkin_jum = Kunjungans::where('person_id',$id)->latest()->count();

        // dd($riwkin);

        return view('admin.kunjungan.detail', compact('dakun','dakrin','riwkin','riwkin_jum','riwkin_sliced','dapen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        // Cari data Person
        $person = Persons::where('nik',$request->nik)->first();
        
        // Extract year from 'tanggal_kj'
        $tahun_kunjungan = Carbon::parse($request->tanggal_kj)->year;

        // Cek apakah sudah ada kunjungan di tahun yang sama
        $existingKunjungan = Kunjungans::where('person_id', $person->id)
            ->whereYear('tanggal_kj', $tahun_kunjungan)
            ->first();

        if ($existingKunjungan) {
            // Jika kunjungan di tahun yang sama sudah ada, return error message
            return redirect('admin/kunjungan')
            ->with('status', 'error')
            ->with('message', 'Kunjungan untuk tahun ini sudah ada. Tidak bisa melakukan skrining di tahun yang sama.');
        }

        try {
            // Jika tidak ada kunjungan di tahun yang sama, buat kunjungan baru
            $kunjungan = Kunjungans::create([
                'tinggi_bdn' => $request->tinggi_bdn,
                'berat_bdn' => $request->berat_bdn,
                'lingkar_prt' => $request->lingkar_prt,
                'sistole' => $request->sistole,
                'diastole' => $request->diastole,
                'gula_drh' => $request->gula_drh,
                'kolesterol' => $request->kolesterol,
                'asam_urat' => $request->asam_urat,
                'person_id' => $person->id,
                'tanggal_kj' => $request->tanggal_kj,
            ]);

            // Buat skrining terkait kunjungan baru
            Skrinings::create([
                'ginjal' => $request->ginjal,
                'penglihatan' => $request->penglihatan,
                'pendengaran' => $request->pendengaran,
                'merokok' => $request->merokok,
                'adl' => $request->adl,
                'gds' => $request->gds,
                'kunjungan_id' => $kunjungan->id, // Relasi ke kunjungan yang baru dibuat
            ]);

            // Hitung IMT
            $tinggi_m = $request->tinggi_bdn / 100; // konversi ke meter
            $imt = $request->berat_bdn / ($tinggi_m * $tinggi_m);
            $imtKlasifikasi = '';
            $imtKategori = '';

            if ($imt < 18.5) {
                $imtKlasifikasi = 'Kurus';
                $imtKategori = 'Kekurangan berat badan tingkat ringan';
            } elseif ($imt >= 18.5 && $imt < 24.9) {
                $imtKlasifikasi = 'Normal';
                $imtKategori = 'Sehat';
            } elseif ($imt >= 25 && $imt < 29.9) {
                $imtKlasifikasi = 'Overweight';
                $imtKategori = 'Kelebihan berat badan tingkat ringan';
            } else {
                $imtKlasifikasi = 'Obesitas';
                $imtKategori = 'Kelebihan berat badan tingkat berat';
            }

            // Hitung kategori tekanan darah
            $kategoriTekananDarah = '';
            $nilaiTekananDarah = $request->sistole . '/' . $request->diastole;

            if ($request->sistole < 120 && $request->diastole < 80) {
                $kategoriTekananDarah = '1 (Normal)';
            } elseif ($request->sistole >= 120 && $request->sistole < 140 || $request->diastole >= 80 && $request->diastole < 90) {
                $kategoriTekananDarah = '2 (Pre-Hypertension)';
            } elseif ($request->sistole >= 140 && $request->sistole < 160 || $request->diastole >= 90 && $request->diastole < 100) {
                $kategoriTekananDarah = '3 (Hypertension Grade 1)';
            } else {
                $kategoriTekananDarah = '4 (Hypertension Grade 2)';
            }

            // Kategori Kolesterol
            $kategoriKolesterol = '';
            if ($request->kolesterol < 200) {
                $kategoriKolesterol = 'Sehat';
            } elseif ($request->kolesterol >= 200 && $request->kolesterol < 239) {
                $kategoriKolesterol = 'Batas Risiko (Borderline Risky)';
            } else {
                $kategoriKolesterol = 'Berbahaya (High Risk)';
            }

            // Hitung Gula Darah
            if ($request->gula_drh < 140) {
                $kategoriGulaDarah = 1;
                $keteranganGulaDarah = 'Normal';
            } elseif ($request->gula_drh >= 140 && $request->gula_drh <= 199) {
                $kategoriGulaDarah = 2;
                $keterangan = 'Prediabetes';
            } else {
                $kategoriGulaDarah = 3;
                $keterangan = 'Diabetes';
            }
            // Konversi Format Tanggal Kunjungan
            $tanggal = Carbon::parse($request->tanggal_kj)->translatedFormat('d F Y');

            // Ambil API Key, No WhatsApp dan Pesan Analisa
            // $apiKey = 'xx';
            // $sender = 'x';
            // $number = 'x';
            // $message = "Halo, Bapak/Ibu {$person->nama},\n\n".
            //             "Hasil Skrining Anda pada tanggal: {$tanggal} adalah sebagai berikut:\n\n".
            //             "1. *Indeks Massa Tubuh (IMT)*\n".
            //             "- Klasifikasi: $imtKlasifikasi\n".
            //             "- Kategori: $imtKategori\n".
            //             "- Nilai IMT: " . number_format($imt, 2) . "\n\n".
            //             "2. *Tekanan Darah*\n".
            //             "- Nilai Tekanan Darah: $nilaiTekananDarah mmHg\n".
            //             "- Kategori: $kategoriTekananDarah\n\n".
            //             "3. *Kolesterol*\n".
            //             "- Kolesterol: {$request->kolesterol} mg/dL\n".
            //             "- Kategori: $kategoriKolesterol\n\n".
            //             "4. *Gula Darah*\n".
            //             "- Kategori: $kategoriGulaDarah\n".
            //             "- Keterangan: $keteranganGulaDarah\n\n".
            //             "Tetap jaga kesehatan dan lakukan pemeriksaan rutin.\n\n".
            //             "Terima kasih.";
            // // Kirim Notifikasi WhatsApp
            // $response = Http::get("https://wagw.yahyahud.my.id/send-message", [
            //                 'api_key' => $apiKey,
            //                 'sender' => $sender,
            //                 'number' => $number,
            //                 'message' => $message,
            //             ]);
            // Kirim pesan sukses
            return redirect('admin/kunjungan')
            ->with('status', 'success')
            ->with('message', 'Kunjungan berhasil ditambahkan !');

        } catch (\Exception $e) {
            return redirect()->back()
            ->with('status', 'error')
            ->with('message', 'Terjadi kesalahan saat menambahkan kunjungan.'. $e->getMessage());
        }
        
    }
    public function searchKunjungans(Request $request) {
        $kecamatans = Kecamatans::all();
        $kelurahans = Kelurahans::all();
    
        // Ambil kecamatan_id, kelurahan_id, dan date range dari request
        $kecamatan_id = $request->input('kecamatan');
        $kelurahan_id = $request->input('kelurahan');
        $dateRange = $request->input('date_range');
    
        // Query dasar
        $query = Kunjungans::query();
    
        // Filter berdasarkan range tanggal jika ada
        if ($dateRange) {
            $dates = explode(' - ', $dateRange);
            $startDate = date('Y-m-d', strtotime($dates[0]));
            $endDate = date('Y-m-d', strtotime($dates[1]));
            $query->whereBetween('tanggal_kj', [$startDate, $endDate]);
        }
    
        // Filter berdasarkan kelurahan
        if ($kelurahan_id) {
            $query->whereHas('person.kelurahan', function($q) use ($kelurahan_id) {
                $q->where('id', $kelurahan_id);
            });
        } 
        // Filter berdasarkan kecamatan jika kelurahan tidak dipilih
        elseif ($kecamatan_id) {
            $query->whereHas('person.kelurahan', function($q) use ($kecamatan_id) {
                $q->where('kecamatan_id', $kecamatan_id);
            });
        }
    
        // Eksekusi query
        $data_kunjungans = $query->get();
    
        return view('admin.kunjungan.index', compact('data_kunjungans', 'kecamatans', 'kelurahans'));
    }
    
    public function searchPersonsByName(Request $request){

        $kecamatans = Kecamatans::all();
        $kelurahans = Kelurahans::all();

        // Ambil nilai dari input form pencarian
        $searchTerm = $request->input('search');

        // Validasi input pencarian
        if (!$searchTerm || strlen($searchTerm) < 3) {
            return redirect()->back()
            ->with('status', 'warning')
            ->with('message', 'Pencaraian minimal Harus 3 Huruf.');
        };

        // Cek apakah input adalah angka (NIK)
        if (is_numeric($searchTerm)) {
            // Validasi NIK harus 16 digit
            if (strlen($searchTerm) != 16) {
                // return redirect()->back()->withErrors(['search' => 'NIK harus terdiri dari 16 digit angka.']);
                return redirect()->back()
                ->with('status', 'error')
                ->with('message', 'NIK harus terdiri dari 16 digit angka.');
            }

            // Pencarian berdasarkan NIK
            $data_kunjungans = Kunjungans::whereHas('person', function ($query) use ($searchTerm) {
                $query->where('nik', $searchTerm);
            })->get();

        } else {
            // Pencarian berdasarkan Nama
            $data_kunjungans = Kunjungans::whereHas('person', function ($query) use ($searchTerm) {
                $query->where('nama', 'LIKE', '%' . $searchTerm . '%');
            })->get();
        }

        return view('admin.kunjungan.index', compact('data_kunjungans','kecamatans','kelurahans'));

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
    public function edit($id)
    {
        $kunjungan = Kunjungans::findOrFail($id);
        $skrining = Skrinings::where('kunjungan_id',$kunjungan->id)->first();

        $dapen = Persons::where('id',$kunjungan->person_id)->first();

        return view('admin.kunjungan.edit',compact('dapen','kunjungan','skrining'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Cari data Kunjungan berdasarkan id
        $kunjungan = Kunjungans::findOrFail($id);

        try {
            // Update data Kunjungan
            $kunjungan->update([
                'tinggi_bdn' => $request->tinggi_bdn,
                'berat_bdn' => $request->berat_bdn,
                'lingkar_prt' => $request->lingkar_prt,
                'sistole' => $request->sistole,
                'diastole' => $request->diastole,
                'gula_drh' => $request->gula_drh,
                'kolesterol' => $request->kolesterol,
                'asam_urat' => $request->asam_urat,
                'tanggal_kj' => $request->tanggal_kj,
            ]);

            // Cari data Skrining berdasarkan kunjungan_id
            $skrining = Skrinings::where('kunjungan_id', $kunjungan->id)->first();

            // Update data Skrining
            $skrining->update([
                'ginjal' => $request->ginjal,
                'penglihatan' => $request->penglihatan,
                'pendengaran' => $request->pendengaran,
                'merokok' => $request->merokok,
                'adl' => $request->adl,
                'gds' => $request->gds,
            ]);

             // Kirim pesan sukses
             return redirect()->back()
             ->with('status', 'success')
             ->with('message', 'Kunjungan berhasil diupdate !');
 
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->back()
            ->with('status', 'error')
            ->with('message', 'Terjadi kesalahan saat mengupdate kunjungan.'. $e->getMessage());
        }
        

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Cari data Kunjungan berdasarkan id
        $kunjungan = Kunjungans::findOrFail($id);

        // Cari data Skrining yang berelasi dengan Kunjungan
        $skrining = Skrinings::where('kunjungan_id', $kunjungan->id)->first();

        try {
            // Hapus data Skrining terlebih dahulu (jika ada)
            if ($skrining) {
                $skrining->delete();
            }

            // Hapus data Kunjungan
            $kunjungan->delete();

            // Kirim pesan sukses
            return response()->json([
                'status' => 'success', 
                'success' => true,
                'message' => 'Kunjungan berhasil dihapus.'
            ]);
        
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error', 
                'message' => 'Terjadi kesalahan saat menghapus Kunjungan.'
            ], 500);
        }
    }

    public function destroySkrining(Request $request){
        // Cari data Skrining yang berelasi dengan Kunjungan
        $skrining = Skrinings::where('kunjungan_id', $request->id)->first();
        
    }
        
}
