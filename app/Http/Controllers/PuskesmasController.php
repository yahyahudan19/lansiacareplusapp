<?php

namespace App\Http\Controllers;

use App\Models\Kelurahans;
use App\Models\Puskesmas;
use App\Models\User;
use Illuminate\Http\Request;

class PuskesmasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_puskesmas = Puskesmas::orderBy('created_at', 'asc')->get();
        return view('admin.puskesmas.index',compact('data_puskesmas'));
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
        // dd($request->all());
        
        // Cek apakah data sudah ada di database berdasarkan kode dan nama
        $existingPuskesmas = Puskesmas::where('kode', $request->puskesmas_kode)
        ->orWhere('nama', $request->puskesmas_name)
        ->first();
        

        if ($existingPuskesmas) {
            // Kirim pesan error jika data sudah ada
            return redirect()->back()
            ->with('status', 'error')
            ->with('message', 'Puskesmas dengan kode atau nama tersebut sudah ada!');
        }

        try {
            // Simpan data ke database
            Puskesmas::create([
            'nama' => $request->puskesmas_name,
            'kode' => $request->puskesmas_kode,
            'jenis' => $request->puskesmas_jenis,
            'alamat' => $request->puskesmas_alamat,
            ]);

            // Kirim pesan sukses
            return redirect()->back()
            ->with('status', 'success')
            ->with('message', 'Puskesmas berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Kirim pesan error
            return redirect()->back()
            ->with('status', 'error')
            ->with('message', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Puskesmas $puskesmas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $puskesmas = Puskesmas::find($id);

        if (!$puskesmas) {
            return response()->json(['success' => false, 'message' => 'Puskesmas tidak ditemukan!']);
        }

        return response()->json(['success' => true, 'data' => $puskesmas]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            // Cari puskesmas berdasarkan ID
            $puskesmas = Puskesmas::findOrFail($id);

            // Update data
            $puskesmas->update([
                'nama' => $request->puskesmas_name,
                'kode' => $request->puskesmas_kode,
                'jenis' => $request->puskesmas_jenis,
                'alamat' => $request->puskesmas_alamat,
            ]);

            // Redirect dengan pesan sukses
            return redirect()->back()
            ->with('status', 'success')
            ->with('message', 'Data Puskesmas berhasil diperbarui!');
        } catch (\Exception $e) {
            // Redirect dengan pesan error
            return redirect()->back()
            ->with('status', 'error')
            ->with('message', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Cari data puskesmas berdasarkan ID
        $puskesmas = Puskesmas::findOrFail($id);

        // Cek apakah data puskesmas sudah digunakan di tabel lain
        $isUsed = Kelurahans::where('puskesmas_kd', $puskesmas->kode)->exists();

        if ($isUsed) {
            return response()->json([
                'status' => 'error', 
                'success' => false,
                'message' => 'Data Puskesmas tidak dapat dihapus karena masih digunakan di tabel lain!'
            ]);
        }

        try {
            // Hapus data jika tidak digunakan di tabel lain
            $puskesmas->delete();

            // Return response dengan pesan sukses
            return response()->json([
                'status' => 'success', 
                'success' => true,
                'message' => 'Puskesmas berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            // Return response dengan pesan error
            return response()->json([
                'status' => 'error', 
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }
}
