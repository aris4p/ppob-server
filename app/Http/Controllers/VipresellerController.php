<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\TripayService;
use App\Mail\kirimEmail;
use App\Http\Controllers\Controller;
use App\Services\VipresellerService;
use Illuminate\Support\Facades\Mail;

class VipresellerController extends Controller
{
    private $vipresellerService;
    private $tripayService;
    public function __construct(VipresellerService $vipresellerService, TripayService $tripayService )
    {
        $this->vipresellerService = $vipresellerService;
        $this->tripayService = $tripayService;
    }
    
    public function pulsa($kode, Request $request)
    {
        // dd($request->all());
        $responses = $this->tripayService->getPaymentChannelsLaravel();  
        $result = json_decode($responses)->data;
        // dd($result);
        $result1 = $this->vipresellerService->getPrepaid(); 
        
        
        
        $filteredResults = [];
        foreach ($result1 as $results) {
            if ($results->brand === $kode && $results->status === "available") {
                $filteredResults[] = $results;
            }
        }
        // dd($filteredResults);
        
        
        // Urutkan array berdasarkan harga (asumsi $results->price adalah angka)
        usort($filteredResults, function ($a, $b) {
            return $a->price->basic - $b->price->basic; // Mengurutkan dari harga terendah ke tertinggi
            // Untuk mengurutkan dari harga tertinggi ke terendah, ganti urutan kedua variabel di atas ($a->price - $b->price) menjadi ($b->price - $a->price).
        });
        // dd($filteredResults);
        return view('vip.pulsa',[
            'title' => "PULSA"
        ], compact('result','filteredResults','request'));
        
    }
    
    public function getPulsaPrepaid()
    {
        $result = $this->vipresellerService->getPrepaid(); 
        
        $filteredResults = [];
        foreach ($result as $results) {
            if ($results->status === "available") {
                $filteredResults[] = $results;
            }
        }
        
        
        // Urutkan array berdasarkan harga (asumsi $results->price adalah angka)
        usort($filteredResults, function ($a, $b) {
            return $a->price->basic - $b->price->basic; // Mengurutkan dari harga terendah ke tertinggi
            // Untuk mengurutkan dari harga tertinggi ke terendah, ganti urutan kedua variabel di atas ($a->price - $b->price) menjadi ($b->price - $a->price).
        });
        
        dd($filteredResults);
        
        return view('vip.pulsa', compact('filteredResults'));
        
    }
    
    public function payment(Request $request)
    {
        
        //    dd($request->all()); 
        $result = $this->vipresellerService->getPrepaid(); 
        foreach ($result as $results) {
            if ($results->brand === $request->brand && $results->status === "available") {
                $filteredResults[] = $results;
            }
        }
        
        foreach ($filteredResults as $harga) {
            if ($harga->code === $request->produk_id){
                
                 $hasil = $harga;
            }
        }
        
        $price = (float)$hasil->price->basic;
        if($price < 2000) {
            // Jika harga lebih besar dari 500, bulatkan ke atas
            $price = (floor($price / 500)*500)+500;
            
        } else if ($price < 10000) {
            
            $price = (ceil($price / 1000)*1000)+1000;
        } else if ($price < 25000){
            $price  = (ceil($price / 1000)*1000)+1000;
        }else{
            $price  = ceil($price / 1000)*1000+1000;
        }

        
        $str = $request->harga ;
        // dd($str);
        // Menghapus karakter "Rp." dan tanda koma (",")
        $cleanedStr = str_replace("Rp.", "", $str);
        $cleanedStr = str_replace(",", "", $cleanedStr);
        
        // Mengonversi sisa angka menjadi integer
        $harga = (int) $cleanedStr;
        $results = $this->vipresellerService->paymentGuzzle($request, $harga, $price); 
       
        // dd($results);
        if($results->success == false){
            return response()->json(['error' => "Gagal menyimpan data",
            'message'=> "Harga Tidak Sesuai Mohon tidak mengubah harga yang sudah tertera",
        ], 422);
        }else{

            $result = $results->data;
            $str =  strtoupper(Str::random(12));
            $invoice_id ="PLS-$str";
            $transaction = Transaction::create([
                
                'pulsa_id' => $request->produk_id,
                'invoice' => $invoice_id,
                'reference' => $result->reference,
                'email' => $result->customer_email,
                'nohp' => $result->customer_phone,
                'amount' => $result->amount,
                'status' => $result->status,
                'createdAt' => $result->expired_time
            ]);
            
            $order_items = $result->order_items;
            foreach ($order_items as $items){
                $items;
            }
            $harga = "Rp. ". number_format($items->price);
            
            $pesan = "Berikut data pembelian pulsa anda";
            $pesan .= "<br>Nama Pulsa :  $items->name  ";
            $pesan .= "<br>No Tujuan :  $result->customer_phone  ";
            $pesan .= "<h1>Harga :  $harga </h1>";
            
            $data = [
                'subject' => 'Test dari Aris',
                'sender_name' => 'admin@gmail.com',
                'isi' => $pesan
            ];
            
            Mail::to($result->customer_email)->send(new kirimEmail($data));
            
            return response()->json(['success' => "Berhasil menyimpan data",
            'invoice_id'=> $transaction->invoice,
        ]);
        
        }
}


}
