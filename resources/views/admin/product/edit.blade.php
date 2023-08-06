@extends('layout.admin_main')
@section('body')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Tambah Data Produk</h5>
        <!-- Horizontal Form -->
        
        @include('layout.partials_admin.pesanerror')
        
        <form action="{{ route('proses-update-product', $product->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $product->nama }}">
                </div>
            </div>
            <div class="row mb-3">
                <label for="stok" class="col-sm-2 col-form-label">Stok</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="qty" name="qty" value="{{ $product->qty }}">
                </div>
            </div>
            <div class="row mb-3">
                <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="harga" name="harga" value="{{ $product->harga }}">
                </div>
            </div>
            @if ($product->gambar)
            <div class="row mb-3">
                <img style="max-width:100px;max-height:100px" src="{{ asset('gambar_produk').'/'.$product->gambar }}">
            </div>
            
            @endif
            <div class="row mb-3">
                <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="gambar" name="gambar">
                </div>
            </div>
            
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        <!-- End Horizontal Form -->
    </div>
</div>
@endsection
