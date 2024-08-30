<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\Brand;
use App\Models\Product;
use App\Mail\kirimEmail;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\TripayService;
use App\Services\XenditService;
use App\Services\ApigamesService;
use App\Services\DigiflazzService;
use App\Services\VipresellerService;
use Illuminate\Support\Facades\Mail;
use SebastianBergmann\CodeCoverage\BranchAndPathCoverageNotSupportedException;

class ClientController extends Controller
{

    protected $tripayService;
    protected $digiflazzService;
    protected $xenditService;

    public function __construct(TripayService $tripayService, DigiflazzService $digiflazzService, XenditService $xenditService)
    {
        $this->tripayService = $tripayService;
        $this->digiflazzService = $digiflazzService;
        $this->xenditService = $xenditService;
    }
    
    public function index()
    {
         
        $brands = Brand::all();
        return view('index',[
            'title' => "Produk Kita"
        ], compact('brands'));
    }
    
    
    
    public function produk($slug)
    {
        
        // Menggunakan HTTP Client Guzzle Laravel
        $responses = $this->tripayService->getPaymentChannelsLaravel();  
        $result = json_decode($responses)->data;
      
        $brand = Brand::where('slug', $slug)->first();

        $produk = Product::where('brand_id', $brand->id)->get();
        // dd($produk);
    
        return view('produk.produk',[
            'title' => "Pemesanan "
        ],compact('produk','result','brand'));
    }
    
    
    
    public function payment(Request $request)
    {
        $result = $this->xenditService->create_invoice($request);
     
        return response($result);
    }
    

    public function pembayaran(Request $request)
    {
        // return $request->all();
        $product = Product::find($request->produk_id);
        // mEnggunakan Guzzle
        $results = $this->tripayService->paymentGuzzle($request, $product);  
        // dd($results->success);
        
      
            if($results->success == false){
                return response()->json(['error' => "Gagal menyimpan data",
                'message'=> "Harga Tidak Sesuai Mohon tidak mengubah harga yang sudah tertera",
            ], 422);
            }else{
            $result = $results->data;
            $str =  strtoupper(Str::random(12));
            $invoice_id ="PK-$str";
            // dd(strtoupper($invoice_id));
            $transaction = Transaction::create([
                'product_id' => $request->produk_id,
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
            
            $product = Transaction::with('product')
            ->where('reference',$transaction->reference)
            ->first();
            
            $total = $product->product->qty-1;
            $produk = Product::where('id', $product->product_id );
            $produk->update(['qty' => $total]);
            
            
            $pesan = "Email :  $items->name  ";
            $pesan .= "<h1>Harga :  $items->price </h1>";
            
            $data = [
                'subject' => 'Test dari Aris',
                'sender_name' => 'admin@gmail.com',
                'isi' => $pesan
            ];
            
            Mail::to($result->customer_email)->send(new kirimEmail($data));
            
            return response()->json(['success' => "Berhasil menyimpan data",
                                    'invoice_id'=> $transaction->invoice ]);

            // return redirect()->route('invoice',['no_invoice' => $transaction->invoice]);
            
            // return view ('payment.payment',[
                //     'title' => "Pembayaran"
                // ], compact('result','items','transaction'));
                
            }
    }
        
        public function cek_invoice(Request $request)
        {
            return view('produk.cek-invoice',[
                'title' => "Invoice"
            ]);
        }
        
        public function invoice(Request $request)
        {
            
            
            $transaction = Transaction::with('product')->where('invoice', $request->no_invoice)->first();
            // Tripay Service
            $result = $this->tripayService->invoice($request, $transaction);
            // dd($result);
            
            $order_items = $result->order_items;
            foreach ($order_items as $items){
                $items;
            }
            
            
            
            
            
            return view('payment.payment',[
                'title' => "Invoice"
            ], compact('result','items','transaction'));
        }
        
        
    }
    
    
    
    