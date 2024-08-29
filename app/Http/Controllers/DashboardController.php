<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TripayService;
use App\Services\ApigamesService;
use App\Services\DigiflazzService;

class DashboardController extends Controller
{

 
    protected $tripayService;
    protected $digiflazzService;

    public function __construct(TripayService $tripayService, DigiflazzService $digiflazzService)
    {
        $this->tripayService = $tripayService;
        $this->digiflazzService = $digiflazzService;
    }

    public function index()
    {
        $cek_saldo = $this->digiflazzService->cek_saldo();
        return view('admin.index',[
        "title" => 'Dashboard'
    ],compact('cek_saldo'));
    }
}
