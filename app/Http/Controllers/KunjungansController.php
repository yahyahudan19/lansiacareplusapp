<?php

namespace App\Http\Controllers;

use App\Imports\SkriningImport;
use App\Models\Kecamatans;
use App\Models\Kelurahans;
use App\Models\Kunjungans;
use App\Models\Log;
use App\Models\Persons;
use App\Models\Logs;
use App\Models\Skrinings;
use App\Services\WhatsAppService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;

class KunjungansController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   $kecamatans = Kecamatans::all();
        $kelurahans = Kelurahans::all();
        $data_kunjungans = Kunjungans::whereDate('tanggal_kj', Carbon::today())->orderBy('tanggal_kj', 'desc')->get();

        return view('admin.kunjungan.index',compact('data_kunjungans','kecamatans','kelurahans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_view(Request $request)
    {
        $dapen = Persons::with('lastKunjungan') // Eager load kunjungan terakhir
            ->where('nik', $request->nik)
            ->first();
        // dd($dapen);
        
        if (!$dapen) {
            return redirect()->back()->with('status', 'error')->with('message', 'Data penduduk tidak ditemukan.');
        }
    
        // Tentukan view berdasarkan role user
        return match (auth()->user()->role) {
            'System Administrator' => view('admin.kunjungan.create', compact('dapen')),
            'Puskesmas' => view('admin.kunjungan.create', compact('dapen')),
            'Kader' => view('kader.kunjungan.create', compact('dapen')),
            default => abort(403, 'Unauthorized action.')
        };
    }
    

    /**
     * Show the form for detail resource.
     */
    public function detail_view($id)
    {
        $dapen = Persons::findOrFail($id);

        $dakun = Kunjungans::where('person_id', $id)->orderBy('tanggal_kj', 'desc')->first();
        $dakrin = Skrinings::where('kunjungan_id', $dakun->id)->latest()->first();

        $riwkin = Kunjungans::where('person_id', $id)
            ->orderBy('tanggal_kj', 'desc')
            ->get(); // Ambil semua data terlebih dahulu
            
        $riwkin_sliced = $riwkin->slice(1); // Potong elemen pertama
        $riwkin_jum = Kunjungans::where('person_id', $id)->latest()->count();

        // Ambil data skrining untuk seluruh riwayat kunjungan
        $riwkin_rekomendasi = [];
        foreach ($riwkin as $riw) {
            $skrining = Skrinings::where('kunjungan_id', $riw->id)->latest()->first();
            if ($skrining) {
                $perlu_rujukan = in_array('Y', [$skrining->ginjal, $skrining->penglihatan, $skrining->pendengaran, $skrining->merokok]);

                $riwkin_rekomendasi[$riw->id] = $perlu_rujukan ? "Silakan Rujuk ke Pustu atau Puskesmas terdekat" : "Tidak Perlu Rujukan";
            } else {
                $riwkin_rekomendasi[$riw->id] = "Data Skrining Tidak Tersedia";
            }
        }

        return view('admin.kunjungan.detail', compact('dakun', 'dakrin', 'riwkin', 'riwkin_jum', 'riwkin_sliced', 'dapen', 'riwkin_rekomendasi'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // Cari data Person
        $person = Persons::where('nik', $request->nik)->first();

        // Redirect berdasarkan role
        $role = auth()->user()->role;
        $redirectRoutes = [
            'Puskesmas' => '/puskesmas/kunjungan',
            'Dinkes' => '/dinkes/kunjungan',
            'System Administrator' => '/admin/kunjungan',
            'Kader' => '/kader/kunjungan',
        ];
 
        $redirectUrl = $redirectRoutes[$role] ?? '/dashboard';

        // Cek apakah sudah ada kunjungan di tahun yang sama
        $tahun_kunjungan = Carbon::parse($request->tanggal_kj)->year;
        if (Kunjungans::where('person_id', $person->id)->whereYear('tanggal_kj', $tahun_kunjungan)->exists()) {
            return redirect($redirectUrl)->with('status', 'error')->with('message', 'Kunjungan untuk tahun ini sudah ada.');
        }

        try {
            // Simpan data kunjungan
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
                'created_by' => auth()->user()->id,
            ]);

            // Simpan data skrining
            Skrinings::create([
                'ginjal' => $request->ginjal,
                'penglihatan' => $request->penglihatan,
                'pendengaran' => $request->pendengaran,
                'merokok' => $request->merokok,
                'adl' => $request->adl,
                'gds' => $request->gds,
                'keterangan' => $request->keterangan,
                'kognitif' => $request->kognitif,
                'mobilisasi' => $request->mobilisasi,
                'malnutrisi' => $request->malnutrisi,
                'depresi' => $request->depresi,
                'kunjungan_id' => $kunjungan->id,
            ]);

            // Simpan data log
            Log::create([
                'user_id' => auth()->user()->id,
                'username' => auth()->user()->username,
                'email' => auth()->user()->email,
                'category' => 'create',
                'activity' => 'create',
                'details' => 'Menambahkan kunjungan baru untuk person_id: ' . $person->id,
                
            ]);

            // Update data Persons
            if ($request->has('telp') || $request->has('kirim_hasil')) {
                $person->update([
                    'telp' => $request->telp ?? $person->telp,
                    'notifikasi' => $request->kirim_hasil ?? $person->notifikasi,
                ]);
            }

            // Cek rekomendasi
            $perlu_rujukan = in_array('Y', [
                $request->ginjal,
                $request->penglihatan,
                $request->pendengaran,  
                $request->merokok,
            ]);

            $rekomendasi = $perlu_rujukan
                ? "Silakan Rujuk ke Pustu atau Puskesmas terdekat"
                : "Tidak Perlu Rujukan";

            if ($person->notifikasi == "Y") {
                // Hitung indikator
                $indicators = $this->calculateIndicators($request->all());
            
                // Buat pesan WhatsApp
                $message = $this->generateWhatsappMessage($person, $indicators, Carbon::parse($request->tanggal_kj)->translatedFormat('d F Y'));
            
                // Kirim notifikasi WhatsApp melalui service
                // $response = WhatsAppService::sendMessage($person->telp, $message);
                
                $response = false; // Simulate a failed response
            
                \Log::info("WhatsApp Notification Response", ['response' => $response]);
            
                if ($response === true) {
                    return redirect($redirectUrl)
                        ->with('status', 'success')
                        ->with('message', 'Kunjungan berhasil ditambahkan, pesan berhasil dikirim!')
                        ->with('rekomendasi', $rekomendasi);
                } elseif (is_array($response) && isset($response['status']) && $response['status'] === 400) {
                    return redirect($redirectUrl)
                        ->with('status', 'success')
                        ->with('message', 'Kunjungan berhasil ditambahkan, namun terjadi kesalahan dalam mengirim pesan.')
                        ->with('rekomendasi', $rekomendasi);
                } else {
                    return redirect($redirectUrl)
                        ->with('status', 'success')
                        ->with('message', 'Kunjungan berhasil ditambahkan, tetapi pesan gagal dikirim.')
                        ->with('rekomendasi', $rekomendasi);
                }
            } else {
                return redirect($redirectUrl)
                    ->with('status', 'success')
                    ->with('message', 'Kunjungan berhasil ditambahkan');
            }
            

            
        } catch (\Exception $e) {

            // Redirect berdasarkan role
            $role = auth()->user()->role;
            $redirectRoutes = [
                'Puskesmas' => '/puskesmas/kunjungan',
                'Dinkes' => '/dinkes/kunjungan',
                'System Administrator' => '/admin/kunjungan',
                'Kader' => '/kader/kunjungan',
            ];

            // $redirectUrl = $redirectRoutes[$role] ?? '/dashboard';
            return redirect($redirectUrl)->with('status', 'error')->with('message', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    private function calculateIndicators($data)
    {
        $results = [];

        // Perhitungan Index Masa Tubuh (IMT) berdasarkan WHO terbaru
        if (!empty($data['tinggi_bdn']) && !empty($data['berat_bdn'])) {
            $tinggi_m = $data['tinggi_bdn'] / 100;
            $imt = round($data['berat_bdn'] / ($tinggi_m * $tinggi_m), 2); // Hanya 2 digit desimal
            
            if ($imt < 18.5) {
                $klasifikasi = 'Berat badan kurang (Underweight)';
                $kategori = 'Kurus';
            } elseif ($imt >= 18.5 && $imt <= 22.9) {
                $klasifikasi = 'Berat badan normal';
                $kategori = 'Normal';
            } elseif ($imt >= 23 && $imt <= 24.9) {
                $klasifikasi = 'Kelebihan berat badan (Overweight) dengan risiko';
                $kategori = 'Gemuk ringan';
            } elseif ($imt >= 25 && $imt <= 29.9) {
                $klasifikasi = 'Obesitas I';
                $kategori = 'Gemuk berat';
            } else {
                $klasifikasi = 'Obesitas II';
                $kategori = 'Obesitas';
            }

            $results['Index Masa Tubuh (IMT)'] = [
                'nilai' => $imt,
                'klasifikasi' => $klasifikasi,
                'kategori' => $kategori,
            ];
        } else {
            $results['Index Masa Tubuh (IMT)'] = 'Data tidak tersedia';
        }

        // Perhitungan Tekanan Darah
        if (!empty($data['sistole']) && !empty($data['diastole'])) {
            $nilai = "{$data['sistole']}/{$data['diastole']} mmHg";
            
            if ($data['sistole'] < 120 && $data['diastole'] < 80) {
                $klasifikasi = 'Normal';
            } elseif ($data['sistole'] < 140 || $data['diastole'] < 90) {
                $klasifikasi = 'Pra-Hipertensi';
            } else {
                $klasifikasi = 'Hipertensi';
            }

            $results['Tekanan Darah'] = [
                'nilai' => $nilai,
                'klasifikasi' => $klasifikasi,
            ];
        } else {
            $results['Tekanan Darah'] = 'Data tidak tersedia';
        }

        // Perhitungan Kolesterol
        if (!empty($data['kolesterol'])) {
            $nilai = "{$data['kolesterol']} mg/dL";
            
            if ($data['kolesterol'] < 200) {
                $kategori = 'Normal';
            } elseif ($data['kolesterol'] < 240) {
                $kategori = 'Batas Tinggi';
            } else {
                $kategori = 'Tinggi';
            }

            $results['Kolesterol'] = [
                'hasil' => $nilai,
                'kategori' => $kategori,
            ];
        } else {
            $results['Kolesterol'] = 'Data tidak tersedia';
        }

        // Perhitungan Gula Darah
        if (!empty($data['gula_drh'])) {
            $nilai = "{$data['gula_drh']} mg/dL";
            
            if ($data['gula_drh'] < 140) {
                $kategori = 'Normal';
            } elseif ($data['gula_drh'] <= 199) {
                $kategori = 'Pra-Diabetes';
            } else {
                $kategori = 'Diabetes';
            }

            $results['Gula Darah'] = [
                'hasil' => $nilai,
                'kategori' => $kategori,
            ];
        } else {
            $results['Gula Darah'] = 'Data tidak tersedia';
        }

        return $results;
    }


    private function generateWhatsappMessage($person, $indicators, $tanggal)
    {
        $puskesmas = auth()->user()->puskesmas->nama;
        $message = "👋 Halo, Bapak/Ibu {$person->nama},\n\n📅 Hasil Skrining Anda pada tanggal: *{$tanggal}* di Puskesmas: *{$puskesmas}* adalah sebagai berikut:\n\n";
        $counter = 1;

        foreach ($indicators as $key => $indicator) {
            if (is_array($indicator)) {
                $message .= "{$counter}. *" . ucfirst(str_replace('_', ' ', $key)) . "*\n";
                foreach ($indicator as $subKey => $subValue) {
                    $message .= "- " . ucfirst(str_replace('_', ' ', $subKey)) . ": {$subValue}\n";
                }
            } else {
                $message .= "{$counter}. *" . ucfirst(str_replace('_', ' ', $key)) . "*\n- {$indicator}\n";
            }
            $message .= "\n";
            $counter++;
        }

        $message .= "💪 Tetap jaga kesehatan dan lakukan pemeriksaan rutin untuk hidup yang lebih sehat dan bahagia.\n\nTerima kasih! 😊";

        return $message;
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
        

        return match (auth()->user()->role) {
            'Kader' => view('kader.kunjungan.edit', compact('dapen', 'kunjungan', 'skrining')),
            default => view('admin.kunjungan.edit', compact('dapen', 'kunjungan', 'skrining')),
        };
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
                'keterangan' => $request->keterangan,
                'kognitif' => $request->kognitif,
                'mobilisasi' => $request->mobilisasi,
                'malnutrisi' => $request->malnutrisi,
                'depresi' => $request->depresi,
            ]);

            // Simpan data log
            Log::create([
                'user_id' => auth()->user()->id,
                'username' => auth()->user()->username,
                'email' => auth()->user()->email,
                'category' => 'update',
                'activity' => 'update',
                'details' => 'Mengupdate kunjungan id_kunjungan : ' . $kunjungan->id,
                
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

            // Simpan data log
            Log::create([
                'user_id' => auth()->user()->id,
                'username' => auth()->user()->username,
                'email' => auth()->user()->email,
                'category' => 'delete',
                'activity' => 'delete',
                'details' => 'Menghapus kunjungan dengan id_kunjungan: ' . $kunjungan->id,
            ]);

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

    public function import(request $request){
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls',
        ]);

        try {
            Excel::import(new SkriningImport, $request->file('file'));
            return redirect()->back()->with('status', 'success')->with('message', 'Data skrining berhasil diimport.');
        } catch (\Exception $e) {
            return redirect()->back()->with('status', 'error')->with('message', 'Gagal mengimport file: ' . $e->getMessage());
        }
    }
        
}
