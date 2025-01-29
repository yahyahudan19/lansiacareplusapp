<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Whatsapp;

class WhatsAppService
{
    public static function sendMessage($phoneNumber, $message)
    {
        // Ambil konfigurasi WhatsApp dari tabel Whatsapps
        $whatsappConfig = Whatsapp::first();

        if (!$whatsappConfig) {
            throw new \Exception("Konfigurasi WhatsApp tidak ditemukan.");
        }

        $apiKey = $whatsappConfig->api_key;
        $sender = $whatsappConfig->nomor_whatsapp;
        $endpoint = $whatsappConfig->endpoint;

        // Format nomor telepon agar menggunakan kode negara +62
        if (substr($phoneNumber, 0, 1) === "0") {
            $phoneNumber = "62" . substr($phoneNumber, 1);
        }

        // Kirim pesan
        $response = Http::get($endpoint, [
            'api_key' => $apiKey,
            'sender' => $sender,
            'number' => $phoneNumber,
            'message' => $message,
        ]);

        return $response->successful();
    }
}


?>