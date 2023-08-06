<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DigiflazzService;

class DigiflazzController extends Controller
{
    public function __construct(DigiflazzService $digiflazzService)
    {
        $this->digiflazzService = $digiflazzService;
    }
    
    public function check_saldo()
    {
        $responses = $this->digiflazzService->cek_saldo(); 
       return response()->json($responses);
    }


}
