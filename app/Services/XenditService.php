<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Transaction;
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use Illuminate\Support\Facades\Http;
use Xendit\Invoice\CreateInvoiceRequest;

class XenditService{
    
    private $apiXenditKey;
    public function __construct()
    {
        $this->apiXenditKey = config('Xendit.xendit_key');
        
    }
    
    public function create_invoice($request)
    {
   
        $kode_produk = $request->produk_id;

        $tanggalHariIni = date('Ymd');
    

        // Membuat nomor invoice
        $nomorInvoice = 'INV/' . $tanggalHariIni . '/' . $kode_produk;

        $produk = Product::where('kd_produk', $kode_produk)->first();
     

        $response = Http::withBasicAuth($this->apiXenditKey, '')
        ->withHeaders([
            'Content-Type' => 'application/json',
        ])
        ->post('https://api.xendit.co/v2/invoices', [
            "external_id" => "$nomorInvoice",
            "amount" => $produk->harga,
            "payer_email" => "customer@domain.com",
            "description" => "Invoice Demo #$kode_produk"
        ]);

        $datas = [
            'invoice' => $response['external_id'],
            'reference' => $response['id'],
            'amount' => $response['amount'],
            'link_checkout' => $response['invoice_url'],
            'status' => $response['status'],
        ];

        
    
    if ($response->successful()) {
        $data = $response->json();  // Decode JSON response into an array
        $transaction = Transaction::create($datas);
        return $transaction;  // Return the JSON response correctly
    } else {
        $errorMessage = $response->body();  // Get the error message
        return response()->json(['error' => $errorMessage], $response->status());  // Return error with status
    }
}
    
}