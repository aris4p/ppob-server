<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $transaksi = Transaction::query();
        
        
        if ($request->ajax()) {
            return Datatables::of($transaksi)
            ->addIndexColumn()
            ->editColumn('product_id', function ($row) {
                $inv = substr($row->invoice, 0, 2); 
                if ($inv === "PL") {
                    return $row->pulsa_id;
                }
                return $row->product_id;
            })
            ->editColumn('amount', function ($row) {
                return "Rp. " . number_format($row->amount);
            })
            ->editColumn('status', function ($row) {
                if ($row->status === "PAID") {
                    return "<button class='btn btn-success'>$row->status</button>";
                }
                return "<button class='btn btn-warning'>$row->status</button>";
            })
            ->rawColumns(['status'])
            ->make(true);
            
        }
        
        return view('admin.transaction.index',[
            'title' => "Transaksi"
        ], compact(
            'transaksi'
        ));
    }
}
