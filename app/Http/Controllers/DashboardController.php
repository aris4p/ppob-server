<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApigamesService;

class DashboardController extends Controller
{

 
    protected $apigamesService;

    public function __construct( ApigamesService $apigamesService)
    {
        $this->apigamesService = $apigamesService;
    }

    public function index()
    {
        $cek_saldo = $this->apigamesService->cek_saldo();
        return view('admin.index',[
        "title" => 'Dashboard'
    ],compact('cek_saldo'));
    }
}
