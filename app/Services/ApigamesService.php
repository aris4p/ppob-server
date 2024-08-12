<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApigamesService {

    public function cek_saldo()
    {
        $merchantId = config('Apigames.merchant_id'); // Replace with dynamic value if needed
        $secretKey = config('Apigames.secret_key');
        $sign = md5($merchantId . $secretKey);
        
        $endpoint = "https://v1.apigames.id/merchant/{$merchantId}";
        $url = "{$endpoint}?signature={$sign}";
        
        $response = Http::get($url);
        return json_decode($response->body());
    }
}
