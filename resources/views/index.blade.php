@extends('layout.client_main')
@section('body')

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Perhatian !!!</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>  Website ini dibuat untuk keperluan portofolio saya dalam membuat website ,
                    namun fungsi utama dari website ini saya buat
                    dengan sungguh sehingga anda dapat mencobanya, namun memang ada beberapa bug yang mungkin belum saya perbaiki. terima kasih atas
                    perhatiannya.
                </p>
            </div>
            <div class="modal-footer">
                <p> Website ini terinspirasi dari website <a href="https://nontonyuk.id">Nontonyuk.id</a>
                    saya sangat berterima kasih karena telah menjadi inspirasi saya untuk membuat website serupa.</p>
                    
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    
                </div>
                
            </div>
        </div>
    </div>
    
    
    
    <section id="produk" class="mt-5">
        <div class="container">
            
            
            
            <!-- Slides with controls -->
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="assets/img/wetoko.png" class="img-fluid" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/img/wetoko.png" class="img-fluid" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/img/wetoko.png" class="img-fluid" alt="...">
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
                            <a class="nav-link" data-toggle="tab" href="#pulsa">Pulsa</a>
                        </li>
                        <li class="nav-item small">
                            <a class="nav-link" data-toggle="tab" href="#game">Game</a>
                        </li>
                        <li class="nav-item small">
                            <a class="nav-link" data-toggle="tab" href="#voucher">Voucher</a>
                        </li>
                    </ul>
                    <div class="tab-content">                        
                        <div id="pulsa" class="tab-pane fade show active">
                            <div class="row mt-2">
                                @foreach ($brands as $data)
                                @if ($data->kategori == "pulsa")
                                <div class="col-lg-2 col-4 pb-4">
                                    <div class="card-group">
                                        <div class="card">
                                            <div class="card-body">
                                                <img style="border-radius:20px;width:100%;" src="{{ Storage::url($data->gambar) }}" loading="lazy" alt="NETFLIX" sharing="" class="img-thumbnail text-center mt-2">
                                                <h5 class="card-title text-center">{{ $data->nama }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach   
                            </div>
                        </div>
                        
                        {{-- <div id="pulsa" class="tab-pane fade show ">
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
                        </div> --}}
                        <div id="game" class="tab-pane fade show ">
                            <div class="row mt-2">
                                @foreach ($brands as $data)
                                @if ($data->kategori == "game")
                                <div class="col-lg-2 col-4 pb-4">
                                    <div class="card-group">
                                        <div class="card">
                                            <a href="{{route('produk', $data->slug)}}">
                                                <div class="card-body">
                                                    <img style="border-radius:20px;width:100%;" src="{{ Storage::url($data->gambar) }}" loading="lazy" alt="NETFLIX" sharing="" class="img-thumbnail text-center mt-2">
                                                    <h5 class="card-title text-center">{{ $data->nama }}</h5>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    
    
    
    
    
</section>
<script src="{{ asset('assets/js/script.js') }}"></script>
@endsection



@endpush