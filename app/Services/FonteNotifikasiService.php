<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FonteNotifikasiService
{  protected string $url;
    protected string $token;
    protected string $deviceId;

    public function __construct()
    {
        $this->url      = env('FONNTE_URL');
        $this->token    = env('FONNTE_TOKEN');
        $this->deviceId = env('FONNTE_DEVICE_ID');
    }

    /**
     * Kirim pesan WhatsApp via API Fonnte
     */
    public function sendMessage(string $number, string $message)
    {
        return Http::withHeaders([
            'Authorization' => $this->token,
            'device-id'     => $this->deviceId,
            'Accept'        => 'application/json'
        ])->post($this->url, [
            'target' => $number,
            'message' => $message,
        ]);
    }
}