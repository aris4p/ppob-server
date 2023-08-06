<?php 


namespace App\Services;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\Http;

class TripayService{

    

    public function getPaymentChannelsLaravel()
    {
        $apikey = config('Tripay.api_key');
        
        $bearer = "Bearer $apikey";
     
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$apikey}",
        ])->get('https://tripay.co.id/api-sandbox/merchant/payment-channel');
           
        return $response;
    }   
    
    
    public function getPaymentChannels()
    {
        $apiKey = config('Tripay.api_key');
      
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/merchant/payment-channel',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ));
        
        $response = curl_exec($curl);
        $error = curl_error($curl);
        
        curl_close($curl);
        
        $result = json_decode($response)->data;
        
        
        
        return $result ? $result : $error;
    }
    
    public function paymentGuzzle($request, $product)
    {
         
        $apiKey       = config('Tripay.api_key');
        $privateKey   = config('Tripay.private_key');
        $merchantCode = 'T21486';
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
                'expired_time' => (time() + (1 * 60 * 60)), // 48 jam
                'signature'    => hash_hmac('sha256', $merchantCode.$merchantRef.$amount, $privateKey)
            ];
            
        $apikey = config('Tripay.api_key');
      
        $bearer = "Bearer $apikey";
     
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$apikey}",
        ])->post('https://tripay.co.id/api-sandbox/transaction/create', $data);
        $responses = json_decode($response)->data;
        
        return $responses;

    }

 
        public function invoice($request, $transaction)
        {
            $apiKey = config('Tripay.api_key');

            // $invoice = Transaction::where('invoice', $request->no_invoice)->first();
           
            
            $payload = ['reference'	=> $transaction->reference];
            
            $curl = curl_init();
            
            curl_setopt_array($curl, [
                CURLOPT_FRESH_CONNECT  => true,
                CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/detail?'.http_build_query($payload),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER         => false,
                CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
                CURLOPT_FAILONERROR    => false,
                CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
            ]);
            
            $response = curl_exec($curl);
            $error = curl_error($curl);
            
            curl_close($curl);
            
            $result = json_decode($response)->data;
            // dd($result);
           return $result;
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
    
    