<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class XenditCallbackController extends Controller
{
    

    public function handle(Request $request)
    {
        $callbackToken =  $request->header('x-callback-token');
        
        $res_req = $request->all();
        
        if ($callbackToken == config('Xendit.webhook_token')){
            if ($res_req['status'] == 'PAID') {
                $transaction = Transaction::where('reference', $res_req['id'])->first();
                $transaction->status = $res_req['status'];
                $transaction->update();
            }else{
                $transaction = Transaction::where('reference', $res_req['id'])->first();
                $transaction->status = $res_req['status'];
                $transaction->update();
            }
        }else{
            return response()->json(['message' => "Upps salah"],400);
        }
       
    }
}
