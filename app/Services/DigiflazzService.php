<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class DigiflazzService {

    public function cek_saldo()
    {
        $sign = md5(config('Digiflazz.username') . config('Digiflazz.api_key') . "depo");
        $sign2 = md5("M230724AWJW8782KD"."509105b0739afd93b1cdc8ba80e58a6769ce9737f2a7b28a522c5959ff9ae70e"."mongkicrot");
        // dd($sign);

        $response = Http::post('https://api.digiflazz.com/v1/cek-saldo', [
            'cmd' => 'deposit',
            'username' => config('Digiflazz.username'),
            'sign' => $sign
        ]);

        // cek username ML
        
        //  https://v1.apigames.id/merchant/M230724AWJW8782KD/cek-username/mobilelegend?user_id=129081472014&signature=9b8e182e90a43153cacba511d64df623

        // dd(json_decode($response->body()));
        return json_decode($response->body());
    }

    public function order()
    {
        $ref_id = "Test-000120";
        $sign = md5(config('Digiflazz.username') . config('Digiflazz.api_key') . $ref_id);

        $response = Http::post('https://api.digiflazz.com/v1/transaction', [
            'username' => config('Digiflazz.username'),
            'buyer_sku_code' => "ML5",
            'customer_no' => "129081472014",
            'testing' => true,
            'sign' => $sign
        ]);


        return json_decode($response->body());


    }
}
