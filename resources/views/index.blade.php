@extends('layout.client_main')
@section('body')



<section id="produk" class="mt-5">
    <div class="container">
        
        
        
        <!-- Slides with controls -->
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/img/slide2.png" class="img-fluid" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="assets/img/slide2.png" class="img-fluid" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="assets/img/slide2.png" class="img-fluid" alt="...">
                </div>
            </div>
            
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            
        </div><!-- End Slides with controls -->
        
        
        
        
    </div>
</section>

<section id="produk" class="mt-3">
    <div class="container">
        <div class="col-lg-12 text-center pb-3">
            <h3>Menjual Akun Netflix, Spotify Premium, Game &amp; Voucher Murah Pengiriman Otomatis 1 Detik</h3>
        </div>
        <div class="row">
            <div class="col">
                <ul class="nav nav-pills justify-content-center pb-2">
                    <li class="nav-item small">
                        <a class="nav-link active" data-toggle="tab" href="#streaming">Streaming</a>
                    </li>
                    <li class="nav-item small">
                        <a class="nav-link" data-toggle="tab" href="#pulsa">Pulsa</a>
                    </li>
                    <li class="nav-item small">
                        <a class="nav-link" data-toggle="tab" href="#apps">Apps</a>
                    </li>
                    <li class="nav-item small">
                        <a class="nav-link" data-toggle="tab" href="#voucher">Voucher</a>
                    </li>
                </ul>
                <div class="tab-content">
                    
                    <div id="streaming" class="tab-pane fade show active">
                        
                        
                        <div class="row mt-2">
                            @foreach ($product as $products)
                            <div class="col-lg-2 col-4 pb-4">
                                <div class="card-group">
                                    <div class="card">
                                        <div class="card-body">
                                            @if ($products->qty > 1)   
                                            <a href="/produk/{{ $products->id}}" ><img style="border-radius:20px;width:100px;height:100px" src="{{ asset('gambar_produk/'.$products->gambar) }}" loading="lazy" alt="NETFLIX" sharing="" class="img-thumbnail text-center mt-2"></a>
                                            <h5 class="card-title text-center">{{ $products->nama }}</h5>
                                            <p class="card-text text-center">Stock {{ $products->qty }}</p>
                                            @else
                                            <img style="border-radius:20px;width:100%;" src="{{ asset('gambar_produk/'.$products->gambar) }}" loading="lazy" alt="NETFLIX" sharing="" class="img-thumbnail text-center mt-2">
                                            <h5 class="card-title text-center">{{ $products->nama }}</h5>
                                            <p class="card-text text-center">Stock Habis</p>
                                            
                                            
                                            
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                            
                        </div>
                        
                        
                        
                    </div>
                    
                    <div id="pulsa" class="tab-pane fade show ">
                        <div class="row mt-2">
                            @foreach ($group as $brand => $groupBrand)
                            
                            
                            <div class="col-lg-2 col-4 pb-4">
                                <div class="card-group">
                                    <div class="card">
                                        <div class="card-body">
                                            <form action="{{ url('pulsa/' . $brand) }}" method="get">
                                             
                                                <img style="border-radius:20px;width:100px;height:100px;" src="{{ asset('gambar_operator/'.$brand.'.png') }}" loading="lazy" alt="NETFLIX" sharing="" class=" img-thumbnail text-center mt-2">
                                                <input type="submit" class="btn btn-primary mt-3" name="brand" value="{{ $brand }}" >
                                               
                                                
                                                
                                                
                                                
                                                
                                            </form >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            
                            @endforeach
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>






</section>

@endsection