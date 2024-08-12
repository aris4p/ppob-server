@extends('layout.admin_main')
@section('body')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Tambah Data Produk</h5>
        <!-- Horizontal Form -->

        @include('layout.partials_admin.pesanerror')

        <form action="{{ route('product-control.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <label for="brand_id" class="col-sm-2 col-form-label">Brand</label>
                <div class="col-sm-10">
                    <select class="form-control" id="brand_id" name="brand_id">
                        @foreach ($brand as $data )  
                        <option value="{{$data->id}}">{{$data->nama}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="row mb-3">
                <label for="kodeproduk" class="col-sm-2 col-form-label">Kode Produk</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="kodeproduk" name="kodeproduk">
                </div>
            </div>
            <div class="row mb-3">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" name="nama">
                </div>
            </div>
            <div class="row mb-3">
                <label for="stok" class="col-sm-2 col-form-label">Stok</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="qty" name="qty">
                </div>
            </div>
            <div class="row mb-3">
                <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="harga" name="harga">
                </div>
            </div>
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
