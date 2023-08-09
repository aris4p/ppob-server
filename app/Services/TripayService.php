<?php 


namespace App\Services;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\Http;

class TripayService{

    public function __construct()
    {
        $this->apiTripayKey       = config('Tripay.api_key_production');
        $this->apiTripayPrivateKey   = config('Tripay.api_private_production');
        $this->apiVipKey = config('Vipreseller.api_key');
        $this->apiVipId = config('Vipreseller.api_id');
    }

    public function getPaymentChannelsLaravel()
    {
        $apikey = $this->apiTripayKey;
        
        $bearer = "Bearer $apikey";
     
        $response = Http::withHeaders([
            'Authorization' => $bearer,
        ])->get('https://tripay.co.id/api/merchant/payment-channel');
        //    dd(json_decode($response));
        return $response;
    }   
    
    
 
    
    public function paymentGuzzle($request, $product)
    {
         
        $apiKey       = $this->apiTripayKey;
        $privateKey   = $this->apiTripayPrivateKey;
        $merchantCode = 'T22425';
        $merchantRef  = 'INV6969';
        $amount       = intval($request->harga);
        
        $data = [
            'method'         => $request->metodepembayaran,
            'merchant_ref'   => $merchantRef,
            'amount'         => intval($product->harga),
            'customer_name'  => 'TAMU',
            'customer_email' => $request->email,
            'customer_phone' => $request->nohp,
            'order_items'    => [
                [
                    'sku'         => 'FB-06',
                    'name'        => $request->namaproduct,
                    'price'       => intval($product->harga),
                    'quantity'    => 1,
                    'product_url' => 'https://tokokamu.com/product/nama-produk-1',
                    'image_url'   => asset("gambar_produk/$product->gambar"),
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
                'expired_time' => (time() + (1 * 60 * 60)), // 1 jam
                'signature'    => hash_hmac('sha256', $merchantCode.$merchantRef.$amount, $privateKey)
            ];
            
       
      
        $bearer = "Bearer $apiKey";
     
        $response = Http::withHeaders([
            'Authorization' => $bearer,
            ])->post('https://tripay.co.id/api/transaction/create', $data);
            $responses = json_decode($response)->data;
        return $responses;

    }

 
        public function invoice($request, $transaction)
        {
            
            

            $payload = ['reference'	=> $transaction->reference];
            
            $curl = curl_init();
            
            curl_setopt_array($curl, [
                CURLOPT_FRESH_CONNECT  => true,
                CURLOPT_URL            => 'https://tripay.co.id/api/transaction/detail?'.http_build_query($payload),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER         => false,
                CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$this->apiTripayKey],
                CURLOPT_FAILONERROR    => false,
                CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
            ]);
            
            $response = curl_exec($curl);
            $error = curl_error($curl);
       
            curl_close($curl);
            
            $result = json_decode($response)->data;
            // dd($result);
           return $result ? $result : $error;
        }

        public function updateCallback($product)
        {
            if($product->status != "PAID")
                {
                    $total = $product->product->qty+1;
                    $produk = Product::where('id', $product->product_id );
                    $produk->update(['qty' => $total]);
                }
        }
}
    
    