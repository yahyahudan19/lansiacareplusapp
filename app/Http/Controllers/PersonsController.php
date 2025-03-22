<?php

namespace App\Http\Controllers;

use App\Models\Kecamatans;
use App\Models\Kelurahans;
use App\Models\Persons;
use Illuminate\Http\Request;
use Carbon\Carbon;


class PersonsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kecamatans = Kecamatans::all();
        $kelurahans = Kelurahans::all();
        $data_person = Persons::latest()->take(10)->get();
        // $data_person = Persons::get()->all();
        return view('admin.persons', compact('data_person','kecamatans','kelurahans'));
    }
    public function index_lansia()
    {
        $kecamatans = Kecamatans::all();
        $kelurahans = Kelurahans::all();
        $data_person = Persons::where('tanggal_lahir', '<=', Carbon::now()->subYears(60))->latest()->take(10)->get();
        // $data_person = Persons::get()->all();
        return view('admin.persons', compact('data_person','kecamatans','kelurahans'));
    }
    public function index_pra_lansia()
    {
        $kecamatans = Kecamatans::all();
        $kelurahans = Kelurahans::all();

        // Filter persons who are Pra-Lansia (aged between 45 and 59 years)
        $data_person = Persons::whereBetween('tanggal_lahir', [
            Carbon::now()->subYears(59),  // Maximum 59 years old
            Carbon::now()->subYears(45)   // Minimum 45 years old
        ])->latest()->take(10)->get();

        return view('admin.persons', compact('data_person', 'kecamatans', 'kelurahans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $existingPerson = Persons::where('nik', $request->person_nik)->first();

        if ($existingPerson) {
            // Jika NIK sudah ada, kembalikan pesan error
            return redirect()->back()
            ->with('status', 'error')
            ->with('message', 'NIK sudah terdaftar !');
        }

        //  data datetime from request
        $datetime = $request->input('person_tl'); 

        // Konversi ke format date 
        $tanggal_lahir = Carbon::createFromFormat('m/d/Y h:i A', $datetime)->toDateString();

        // dd($tanggal_lahir);
        try {
            Persons::create([
                'nama' => $request->person_name,
                'nik' => $request->person_nik,
                'telp' => $request->person_telp,
                'tanggal_lahir' => $tanggal_lahir, // Pastikan input dalam format yang benar
                'bpjs' => $request->person_bpjs,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->person_alamat,
                'rt' => $request->person_rt,
                'rw' => $request->person_rw,
                'status' => "Hidup",
                'valid' => "Y",
                'notifikasi' => $request->person_notifikasi,
                'created_by' => auth()->user()->id,
                'kelurahan_id' => $request->person_kelurahan,
            ]);

            // Redirect berdasarkan role user
            $redirectRoute = match (auth()->user()->role) {
                'Kader' => route('kunjungans.create.kader', ['nik' => $request->person_nik]),
                'System Administrator' => route('kunjungans.create.admin', ['nik' => $request->person_nik]),
                'Puskesmas' => route('kunjungans.create.puskesmas', ['nik' => $request->person_nik]),
                default => route('dashboard.index') // Redirect ke dashboard jika role tidak dikenali
            };

            return redirect($redirectRoute)
                ->with('status', 'success')
                ->with('message', 'Penduduk berhasil ditambahkan, lanjut ke kunjungan!');

        } catch (\Exception $e) {
            return redirect()->back()
            ->with('status', 'error')
            ->with('message', 'Terjadi kesalahan saat menambahkan penduduk.'. $e->getMessage());
        }

        
    }

    /**
     * Display the specified resource.
     */
    public function detail_view($id)
    {   
        
        $persons = Persons::findOrFail($id);

        // Menghitung usia
        $birthDate = Carbon::parse($persons->tanggal_lahir);
        $age = $birthDate->age;

        // Menentukan kategori berdasarkan usia
        if ($age >= 60) {
            $kategori = 'Lansia';
        } elseif ($age >= 45) {
            $kategori = 'Pra-Lansia';
        } else {
            $kategori = 'Non Lansia';
        }

        return view('admin.persons.detail',compact('persons','age','kategori'));
    }
    public function edit_view($id)
    {   
        $persons = Persons::findOrFail($id);
        $kelurahans = Kelurahans::all();
        $tanggal_lahir = Carbon::parse($persons->tanggal_lahir)->format('m/d/Y g:i A');

        return view('admin.persons.edit',compact('persons','kelurahans','tanggal_lahir'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        // Temukan data persons berdasarkan ID
        $person = Persons::findOrFail($id);

        //  data datetime from request
        $datetime = $request->input('tanggal_lahir'); 

        // Konversi ke format date 
        $tanggal_lahir = Carbon::createFromFormat('m/d/Y h:i A', $datetime)->format('Y-m-d H:i:s');

        try {
            // Update data
            $person->update([
                'nama' => $request->nama,
                'nik' => $request->nik,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $tanggal_lahir,
                'status' => $request->status,
                'telp' => $request->telp,
                'bpjs' => $request->bpjs,
                'alamat' => $request->alamat,
                'rt' => $request->rt,
                'rw' => $request->rw,
                'kelurahan_id' => $request->kelurahan_id,
                'notifikasi' => $request->notifikasi,
                'edited_by' => auth()->user()->id,
                'valid' => "Y",

            ]);
            // Kirim pesan sukses
            return redirect()->back()
            ->with('status', 'success')
            ->with('message', 'Penduduk berhasil diupdate !');

        } catch (\Exception $e) {
            return redirect()->back()
            ->with('status', 'error')
            ->with('message', 'Terjadi kesalahan saat mengupdate penduduk.'. $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        
        try {
            //code...
            $persons = Persons::findOrFail($id);

            $persons->delete();

            return response()->json([
                'status' => 'success', 
                'success' => true,
                'message' => 'Penduduk berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error', 
                'message' => 'Terjadi kesalahan saat menghapus Penduduk.'
            ], 500);
        }
    }

    public function getKelurahan($id)
    {
        $kelurahans = Kelurahans::where('kecamatan_id', $id)->pluck('nama', 'id');
        return response()->json($kelurahans);
    }

    public function searchPersons(Request $request)
    {
        $kecamatans = Kecamatans::all();

        if (auth()->user()->role == "Puskesmas") {
            $kelurahans = Kelurahans::where('puskesmas_kd', auth()->user()->puskesmas->kode)->get()->all();
        } else {
            $kelurahans = Kelurahans::all();
        }
        
        
        
        // Ambil kecamatan_id, kelurahan_id, range date dari request
        $kecamatan_id = $request->input('kecamatan');
        $kelurahan_id = $request->input('kelurahan');
        $dateRange = $request->input('date_range');

        // Query dasar
        $query = Persons::query();

        // dd($request->input('kategori'));

        // Pengecekan path untuk menentukan filter usia
        if ($request->input('kategori') == "Lansia") {
            $query->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 60');
        } elseif ($request->input('kategori') == "Pra-Lansia") {
            $query->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 45 AND TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) < 60');
        }

        // Filter berdasarkan date range jika ada
        if ($dateRange) {
            $dates = explode(' - ', $dateRange);
            $startDate = date('Y-m-d', strtotime($dates[0]));
            $endDate = date('Y-m-d', strtotime($dates[1]));
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        // Filter berdasarkan kelurahan jika dipilih
        if ($kelurahan_id) {
            $query->where('kelurahan_id', $kelurahan_id);
        }
        // Jika hanya kecamatan yang dipilih (tanpa kelurahan)
        elseif ($kecamatan_id) {
            $query->whereHas('kelurahan', function($q) use ($kecamatan_id) {
                $q->where('kecamatan_id', $kecamatan_id);
            });
        }

        // Eksekusi query
        $data_person = $query->get();

        return view('admin.persons', compact('data_person', 'kecamatans', 'kelurahans'));
    }


    public function searchPersonsByName(Request $request){

        // dd($request->all());

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
            $data_person = Persons::where('nik', $searchTerm)->get();

        } else {
            // Pencarian berdasarkan Nama
            $data_person = Persons::where('nama', 'LIKE', '%' . $searchTerm . '%')->get();
        }

        return view('admin.persons', compact('data_person','kecamatans','kelurahans'));

    }
    public function getPendudukByNIK(Request $request)
    {
        $nik = $request->get('nik');
        $person = Persons::where('nik', $nik)->first();

        if ($person) {
            return response()->json(['status' => 'success', 'data' => $person]);
        } else {
            return response()->json(['status' => 'error']);
        }
    }

    public function checkNik(Request $request)
    {
        $nik = $request->input('nik');
    
        $exists = Persons::where('nik', $nik)->exists();
    
        return response()->json([
            'valid' => !$exists, // true kalau belum ada, false kalau sudah ada
        ]);
    }




    
}
