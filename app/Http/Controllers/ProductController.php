<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        
        $products = Product::query();
     
        
        if ($request->ajax()) {
            return Datatables::of($products)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                // kita tambahkan button edit dan hapus
                $btn = '<a href="'.route('proses-edit-product', $row->id).'"  class="edit btn btn-primary btn-sm editProduk"><i class="fa fa-edit"></i>Edit</a>';
                
                $btn .= ' <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-danger btn-sm deleteProduk"><i class="fa fa-trash"></i>Delete</a>';
                
                return $btn;
            })
           

            ->addColumn('gambar', function($row){
              
                return '<img src="' .asset('gambar_produk/'. $row->gambar ). '" width="50" height="50">';
            })
          

            ->editColumn('harga', function ($row) {
                return "Rp. " . number_format($row->harga);
            })
            ->rawColumns(['action','gambar'])
            ->make(true);
         
        }
        
        return view('admin.product.index', [
            "title" => 'Product',
        ], compact('products'));
    }
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('admin.product.tambah', [
            "title" => 'Tambah Produk',
        ]);
    }
    
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        

        
        $validasi = Validator::make($request->all(), [
            'nama' => 'required',
            'qty' => 'required|numeric',
            'harga' => 'required|numeric',
            'gambar' => 'required|mimes:png,jpg,gif,svg|max:2048',
        ], [
            'nama.required' => 'Nama Wajib Diisi',
            'qty.required' => 'Stok Wajib Diisi',
            'qty.numeric' => 'Stok Hanya Angka',
            'harga.required' => 'Harga Wajib Diisi',
            'harga.numeric' => 'Harga Hanya Angka',
          
        ]);
        
        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()]);
        } else {

  
            $gambar = time().'.'.$request->gambar->getClientOriginalExtension();
            $request->gambar->move(public_path('gambar_produk'), $gambar);


            $data = [
                'nama' => $request->input('nama'),
                'qty' => $request->input('qty'),
                'harga' => $request->input('harga'),
                'gambar' => $gambar
                
            ];
            
            Product::create($data);
            return redirect()->route('product')->with('Success' , "Produk baru ditambahkan");
        }
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.product.edit',[
            'title' => "Edit Produk"
        ], compact('product'));
        // return response()->json(['result' => $product]);
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
       
        $validasi = Validator::make($request->all(), [
            'nama' => 'required',
            'qty' => 'required|numeric',
            'harga' => 'required|numeric',
            'gambar' => 'required|mimes:png,jpg,gif,svg|max:2048'
        ], [
            'nama.required' => 'Nama Wajib Diisi',
            'qty.required' => 'Stok Wajib Diisi',
            'qty.numeric' => 'Stok Hanya Angka',
            'harga.required' => 'Harga Wajib Diisi',
            'harga.numeric' => 'Harga Hanya Angka',
        ]);
        
        // if ($validasi->fails()) {
        //     return response()->json(['errors' => $validasi->errors()]);
        // } else {
        // }
            $data = [
                'nama' => $request->input('nama'),
                'qty' => $request->input('qty'),
                'harga' => $request->input('harga'),
                
            ];

            if($request->hasFile('gambar')){
                $request->validate([
                    'gambar' =>  'mimes:png,jpg,gif,svg|max:2048'
                ],[
                    'gambar.mimes' => 'Gambar hanya diperbolehkan berkestensi png,jpg,gif,svg '
                ]);

                $gambar = time().'.'.$request->gambar->getClientOriginalExtension();
                $request->gambar->move(public_path('gambar_produk'), $gambar);
                
                $data_gambar = Product::where('id', $id)->first();
              
                File::delete(public_path('gambar_produk').'/'.$data_gambar->gambar);

                $data = [
                    'gambar' => $gambar
                ];

            }


            
            Product::where('id', $id)->update($data);
            return redirect()->route('product')->with('Success', "Berhasil Update Data");
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function delete(Request $request)
    {
        $id = $request->post('id');
        
        $empdata = Product::find($id);
        
        if ($empdata->delete()) {
            $response['success'] = 1;
            $response['msg'] = 'Delete successfully';
        } else {
            $response['success'] = 0;
            $response['msg'] = 'Invalid ID.';
        }
        
        return response()->json($response);
    }
    
    public function simpanProduk(Request $request)
    {
        Product::updateOrCreate(
            ['id' => $request->id],
            [
                'nama' => $request->name,
                'qty' => $request->qty,
                'harga' => $request->harga,
                ]
            );
            
            return response()->json(['success' => 'Produk saved successfully.']);
        }
    }
    