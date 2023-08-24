<?php
namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class VipresellerService {
    
    
    
    
    public function __construct()
    {
        $this->apiTripayKey       = config('Tripay.api_key');
        $this->apiTripayPrivateKey   = config('Tripay.private_key');
        $this->apiVipKey = config('Vipreseller.api_key');
        $this->apiVipId = config('Vipreseller.api_id');
    }
    
    
    public function getPrepaid()
    {
        
        
        $response = Http::asForm()->post('https://vip-reseller.co.id/api/prepaid', [
            'key' => $this->apiVipKey,
            'sign' => md5($this->apiVipId.$this->apiVipKey),
            'type' => 'services',
            'filter_type' => 'type',
            'filter_value' => 'pulsa-reguler',
        ]);
        
        // dd(json_decode($response));
        if ($response->successful()) {
            // If the request is successful, decode and return the 'data' field from the JSON response.
            $result = json_decode($response)->data;
            return $result;
        } else {
            // If there's an error, handle it accordingly (e.g., log, return an error message, etc.).
            return "Error: " . $response->status() . " - " . $response->body();
        }
        
    }
    
    public function paymentGuzzle($request, $harga, $price)
    {
        // dd($request->all());
        // dd($harga);
        $merchantCode = 'T21486';
        $merchantRef  = 'INV6969';
        $amount       = intval($harga);
        // dd($apiKey);
        
        $data = [
            'method'         => $request->metodepembayaran,
            'merchant_ref'   => $merchantRef,
            'amount'         => intval($harga),
            'customer_name'  => 'TAMU',
            'customer_email' => $request->email,
            'customer_phone' => $request->nohp,
            'order_items'    => [
                [
                    'sku'         => $request->produk_id,
                    'name'        => $request->namaproduct,
                    'price'       => intval($price),
                    'quantity'    => 1,
                    'product_url' => 'https://tokokamu.com/product/nama-produk-1.jpg',
                    'image_url'   => asset("gambar_produk/$request->brand.png"),
                    
                ],
                // [
                    //     'sku'         => 'FB-07',
                    //     'name'        => 'Nama Produk 2',
                    //     'price'       => 500000,
                    //     'quantity'    => 1,
                    //     'product_url' => 'https://tokokamu.com/product/nama-produk-2',
                    //     'image_url'   => 'https://tokokamu.com/product/nama-produk-2.jpg',
                    //     ]
                ],
                'return_url'   => 'https://domainanda.com/redirect',
                'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
                'signature'    => hash_hmac('sha256', $merchantCode.$merchantRef.$amount, $this->apiTripayPrivateKey)
            ];
            
            // dd($data);
            
            
            $bearer = "Bearer $this->apiTripayKey";
            // dd($bearer);
            $response = Http::withHeaders([
                'Authorization' => $bearer,
                ])->post('https://tripay.co.id/api-sandbox/transaction/create', $data);
               
                $responses = json_decode($response->body());
                // dd($responses);
                return $responses;
                
            }
            
            public function orderPulsa($product)
            {
                $apiVipId = config('Vipreseller.api_id');
                $apiVipKey = config('Vipreseller.api_key');
                if($product->status === "PAID")
                {
                    $response = Http::asForm()->post('https://vip-reseller.co.id/api/prepaid', [
                        'key' => $apiVipKey,
                        'sign' => md5($apiVipId.$apiVipKey),
                        'type' => 'order',
                        'service' => $product->pulsa_id,
                        'data_no' => $product->nohp
                    ]);
                    // $responses = $response->body();
                    
                    $result = json_decode($response)->data;
                    return $result;
                    
                }else{
                    return response()->json(['error' => "Gagal di proses"]);
                }
            }       
            
        }