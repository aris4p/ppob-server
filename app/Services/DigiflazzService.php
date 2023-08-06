<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class DigiflazzService {

    public function cek_saldo()
    {
        $sign = md5(config('Digiflazz.username') . config('Digiflazz.api_key') . "pricelist");
        $sign2 = md5("M230724AWJW8782KD"."509105b0739afd93b1cdc8ba80e58a6769ce9737f2a7b28a522c5959ff9ae70e"."mongkicrot");
        dd($sign2);

        $response = Http::post('https://api.digiflazz.com/v1/price-list', [
            'cmd' => 'prepaid',
            'username' => config('Digiflazz.username'),
            'sign' => $sign
        ]);

        // cek username ML
        
        //  https://v1.apigames.id/merchant/M230724AWJW8782KD/cek-username/mobilelegend?user_id=129081472014&signature=9b8e182e90a43153cacba511d64df623


        return json_decode($response);
    }
}
