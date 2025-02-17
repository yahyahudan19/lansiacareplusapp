<?php

namespace App\Http\Controllers;

use App\Models\Whatsapp;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;

class WhatsappController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data_whatsapp = Whatsapp::get();
        return view('admin.whatsapp.index',compact('data_whatsapp'));
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
    public function show(Whatsapp $whatsapp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Whatsapp $whatsapp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Whatsapp $whatsapp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Whatsapp $whatsapp)
    {
        //
    }

    public function WhatsappTestMessages(Request $request)
    {
        $request->validate([
            'no_tujuan' => 'required|string',
            'pesan' => 'required|string',
        ]);

        try {
            $response = WhatsAppService::sendMessage($request->no_tujuan, $request->pesan);

            \Log::info("WhatsApp Test Message Response", ['response' => $response]);

            if ($response === true) {
                return redirect()->back()
                    ->with('status', 'success')
                    ->with('message', 'Pesan berhasil dikirim!');
            } elseif (is_array($response) && isset($response['status']) && $response['status'] === 400) {
                return redirect()->back()
                    ->with('status', 'error')
                    ->with('message', 'Gagal mengirim pesan: Terjadi kesalahan pada permintaan.');
            } else {
                return redirect()->back()
                    ->with('status', 'error')
                    ->with('message', 'Gagal mengirim pesan. Silakan coba lagi.');
            }
        } catch (\Exception $e) {
            \Log::error("WhatsApp Test Message Error", ['error' => $e->getMessage()]);

            return redirect()->back()
                ->with('status', 'error')
                ->with('message', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    
}
