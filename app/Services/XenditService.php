<?php

namespace App\Services;


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
    
    public function create_invoice()
    {
        $response = Http::withBasicAuth($this->apiXenditKey, '')
        ->withHeaders([
            'Content-Type' => 'application/json',
        ])
        ->post('https://api.xendit.co/v2/invoices', [
            "external_id" => "invoice-",
            "amount" => 1800000,
            "payer_email" => "customer@domain.com",
            "description" => "Invoice Demo #123"
        ]);
    
    if ($response->successful()) {
        $data = $response->json();  // Decode JSON response into an array
        return $data;  // Return the JSON response correctly
    } else {
        $errorMessage = $response->body();  // Get the error message
        return response()->json(['error' => $errorMessage], $response->status());  // Return error with status
    }
}
    
}