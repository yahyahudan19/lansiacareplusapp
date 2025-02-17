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
        $type_message = $whatsappConfig->type_message;

        // Format nomor telepon agar menggunakan kode negara +62
        $phoneNumber = ltrim($phoneNumber, '0'); // Hilangkan angka 0 di depan
        if (substr($phoneNumber, 0, 2) !== "62") {
            $phoneNumber = "62" . $phoneNumber;
        }

        // Kirim pesan
        $response = Http::get($endpoint . $type_message, [
            'api_key' => $apiKey,
            'sender' => $sender,
            'number' => $phoneNumber,
            'message' => $message,
        ]);

        // Debugging respons API
        \Log::info("WhatsApp API Response", ['body' => $response->body()]);

        // Decode respons API secara manual jika diperlukan
        $responseBody = json_decode($response->body(), true);

        if ($response->successful() && isset($responseBody['status']) && $responseBody['status'] === true) {
            return true;
        }

        return [
            'success' => false,
            'status' => $response->status(),
            'body' => $responseBody
        ];
    }
}
?>
