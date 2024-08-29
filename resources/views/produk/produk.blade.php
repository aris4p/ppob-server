@extends('layout.client_main')
@section('body')

<section class="mt-4 mb-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card pt-4 pb-4 bg-light">
                    <div class="container">
                        <img style="border-radius:20px;width:100%;" src="{{ Storage::url($brand->gambar) }}" loading="lazy" alt="" class="text-center">
                        <div class="judul-produk pt-4">
                            <h1 style="font-size:24px;"></h1>
                            <!-- <h2 style="font-size:20px;"></h2> -->
                        </div>
                        <div class="deskripsi-produk pt-4">
                            <p>Top up diamond Mobile Legends resmi Moonton 100% legal. Cara beli dm ML termurah. </p>
                            <ul>
                                <li>Masukkan ID</li>
                                <li>Masukkan SERVER ID</li>
                                <li>Pilih Nominal</li>
                                <li>Pilih Pembayaran</li>
                                <li>Klik Pesan Sekarang &amp; lakukan Pembayaran</li>
                                <li>Diamonds masuk otomatis ke akun Anda </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            
            <div class="col-lg-8">
                <button id="testButton">TEST</button>
                <form action="#" method="post">
                    
                    {{-- @csrf {{ route("pembayaran") }} --}}
                    <div class="card mb-4 bg-light">
                        <div class="card-header card text-white bg-danger">
                            <span style="font-size:20px;">Lengkapi Data Pemesanan</span>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-12 pb-2">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input id="email" name="email" type="email" class="form-control" placeholder="Masukkan Email yang Valid" aria-label="Email" required="">
                                    </div>
                                    <div style="font-size:12px;margin:10px 0 0 2px;">Pengiriman otomatis ke alamat email. Pastikan menulis alamat Email&nbsp;dengan&nbsp;benar</div>
                                </div>
                                <div class="col-lg-6 col-12 pb-2">
                                    <div class="form-group">
                                        <label>No. Handphone</label>
                                        <input name="nohp" id="nohp" type="number" class="form-control" placeholder="Masukkan No.Hp (contoh:081xxxxxxxx)" aria-label="NoHp" required="">
                                    </div>
                                    <div style="font-size:12px;margin:10px 0 0 2px;">Pastikan Nomor Handphone yang kalian masukan Terhubung Dengan ovo &amp; ShopepayJika memilih metode pembayaran&nbsp;tersebut</div>
                                </div>
                            </div>
                            <p></p>
                        </div>
                    </div>
                    <div class="card mb-4 bg-light mb-lg-4">
                        <div class="card-header card text-white bg-danger">
                            <span style="font-size:20px;">Game ID</span>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-12 pb-2">
                                    <div class="form-group">
                                        <label>User ID</label>
                                        <input id="user_id" name="user_id" type="text" class="form-control" placeholder="Masukkan user id yang Valid" aria-label="user_id" required="">
                                    </div>
                                    <div style="font-size:12px;margin:10px 0 0 2px;">Pastikan menulis user id&nbsp;dengan&nbsp;benar</div>
                                </div>
                                <div class="col-lg-6 col-12 pb-2">
                                    <div class="form-group">
                                        <label>Zone / server</label>
                                        <input name="zone" id="zone" type="number" class="form-control" placeholder="Masukkan Zona / server" aria-label="zone" required="">
                                    </div>
                                    <div style="font-size:12px;margin:10px 0 0 2px;">Masukan zona/server jika ada</div>
                                </div>
                            </div>
                            <p></p>
                        </div>
                    </div>
                    <div class="card bg-light mb-4">
                        <div class="card-header card text-white bg-danger">
                            <span style="font-size:20px;">Pilih Nominal</span>
                        </div>
                        {{-- <div class="row">
                            
                            
                            <div class="col-lg-4 col-6">
                                <input class="btn-check" type="radio" name="harga" id="harga" required="">
                                <label class="btn btn-check-outline-danger pt-2 pb-2" style="width:100%; margin:0px;">
                                    <small>{{ $produk->nama }}</small>
                                    <br>
                                    <small>{{ $produk->harga }}</small>
                                </label>
                            </div>
                            
                            
                            
                            
                        </div> --}}
                        
                        <div class="grid">
                            @foreach ($produk as $data )
                            <label class="card">
                                <input name="produk" class="radio" type="radio" data-nama="{{ $data->nama }}" data-harga="{{ $data->harga }}">
                                <span class="plan-details">
                                    <img src="{{ asset('gambar_produk/'.$data->gambar) }}" alt="mobilelegends">
                                    <span class="styled-text">{{ $data->nama }}</span>
                                    <span class="styled-text">Rp. {{ $data->harga }}</span>
                                </span>
                            </label>
                            @endforeach
                        </div>
                        
                        
                        
                        
                    </div>
                    <div class="card bg-light">
                        <div class="card-header card text-white bg-danger">
                            <span style="font-size:20px; ">Metode Pembayaran</span>
                        </div>
                        <div class="card">
                            <div id="wallet" class="card-header" data-toggle="collapse" data-target="#collapse3" aria-expanded="true">
                                <span class="title">Pembayaran</span>
                                <span class="accicon">
                                    <i class="fa fa-angle-down rotate-icon"></i>
                                </span>
                            </div>
                            
                            
                            <div id="accordion">
                                
                                
                                
                                <div class="card">
                                   
                                   
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4 col-lg-4 col-sm-4">
                                                    
                                                    <label>
                                                        <input type="radio" name="pembayaran" id="pembayaran"   class="card-input-element" value="Semua channel" />
                                                        
                                                        <div class="card card-default card-input">
                                                            <img src="https://assets.tripay.co.id/upload/payment-icon/BpE4BPVyIw1605597490.png" class="mx-auto mt-4" width="100px">
                                                            <br>
                                                            <div class="card-header mx-auto">Semua Channel</div>
                                                            <div class="card-body text-center total_fee">
                                                                <input type="hidden" class="flat" value="10000">
                                                                <input type="hidden" class="percent" value="">
                                                                <input type="hidden" class="kode" value="">
                                                                <span class="total"></span>
                                                            </div>
                                                        </div>
                                                        
                                                    </label>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    
                                </div>
                                
                                {{-- <div class="card " id="deletebank">
                                    <div class="card-header">
                                        <a class="card-link" data-toggle="collapse" href="#collapseOne">
                                            Bank
                                        </a>
                                    </div>
                                    <div id="collapseOne" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">

                                                <div class="col-md-4 col-lg-4 col-sm-4">
                                                    
                                                    <label>
                                                        <input type="radio" name="pembayaran" id="pembayaran"  class="card-input-element" value="{{ $pembayaran->code }}" />
                                                        
                                                        <div class="card card-default card-input">
                                                            <img src="https://assets.tripay.co.id/upload/payment-icon/BpE4BPVyIw1605597490.png" class="mx-auto mt-4" width="100px">
                                                            <br>
                                                            <div class="card-header mx-auto">Semua Pembayaran</div>
                                                            <div class="card-body text-center total_fee">
                                                                <input type="hidden" class="flat" value="10000">
                                                                <input type="hidden" class="percent" value="">
                                                                <input type="hidden" class="kode" value="">
                                                                <span class="total"></span>
                                                            </div>
                                                        </div>
                                                        
                                                    </label>
                                                    
                                                </div>

                                                @foreach ($result as $pembayaran)
                                                @if ($pembayaran->group == "Virtual Account")
                                                <div class="col-md-4 col-lg-4 col-sm-4">
                                                    
                                                    <label>
                                                        <input type="radio" name="pembayaran" id="pembayaran"  class="card-input-element" value="{{ $pembayaran->code }}" />
                                                        
                                                        <div class="card card-default card-input">
                                                            <img src="{{ $pembayaran->icon_url }}" class="mx-auto mt-4" width="100px">
                                                            <br>
                                                            <div class="card-header mx-auto">{{ $pembayaran->name }}</div>
                                                            <div class="card-body text-center total_fee">
                                                                <input type="hidden" class="flat" value="{{  $pembayaran->total_fee->flat  }}">
                                                                <input type="hidden" class="percent" value="{{  $pembayaran->total_fee->percent  }}">
                                                                <input type="hidden" class="kode" value="{{  $pembayaran->type  }}">
                                                                <span class="total"></span>
                                                            </div>
                                                        </div>
                                                        
                                                    </label>
                                                    
                                                </div>
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                
                                
                                
                            </div>
                        </div>
                        
                    </div>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="modalPesan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    
                                    <table class="table table-sm">
                                        
                                        <tr>
                                            <th scope="row">Email</th>
                                            <td><span id="modalEmail"></span></td>
                                        </tr>
                                        
                                        
                                        
                                        <tr>
                                            <th scope="row">No HP</th>
                                            <td ><span id="modalHp"></span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Nama Produk</th>
                                            <td ><span id="modalNamaproduk"></span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Harga</th>
                                            <td ><span id="modalHarga"></span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Metode Pembayaran</th>
                                            <td ><span id="modalMetodepembayaran"></span></td>
                                        </tr>
                                        <tr>
                                            <th colspan="2" style="color:red;font-style: italic;">*Pastikan data sudah benar</th>
                                            
                                        </tr>
                                        
                                    </table>
                                    
                                </div>
                                <div class="modal-footer">
                                    
                                    <button type="button" class="btn btn-primary" id="btnpesan">Pesan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="mt-4">
                        <button type="button" class="btn btn-danger" id="btnPesan">Lanjutkan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            
            let idproduct;
            let email;
            let nohp;
            let namaproduct
            let harga;
            let metodepembayaran;
            //Setup Global
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });  
            
            function closeModal() {
                let tutupModal =  document.getElementById('modalPesan');
                $('#modalPesan').modal('hide'); 
            }   
            
            
            
   
            
            // 02 Proses menampilkan data     
            $('body').on('click', '#btnPesan', function(e){
                e.preventDefault();
                let idproduct = $('#produk_id').val();
                let email =  $('#email').val();
                let nohp =  $('#nohp').val();
                const selectedProduct = document.querySelector('input[name="produk"]:checked');
                let namaproduct = selectedProduct.getAttribute('data-nama');
                let harga = selectedProduct.getAttribute('data-harga');

                const selectedRadioButton =  document.querySelector('input[name="pembayaran"]:checked');
                let metodepembayaran = selectedRadioButton.value;
                document.getElementById('modalEmail').innerHTML = email;
                document.getElementById('modalHp').innerHTML = nohp;
                document.getElementById('modalNamaproduk').innerHTML = namaproduct;
                document.getElementById('modalHarga').innerHTML = 'Rp. ' + harga;
                document.getElementById('modalMetodepembayaran').innerHTML = metodepembayaran;
                
                $('#modalPesan').modal('show');
                // 03 proses pembayaran
                $('#btnpesan').click(function(){
                    const selectedRadioButton = document.querySelector('input[name="pembayaran"]:checked');
                    $.ajax({
                        url: "{{route('create-invoice')}}",
                        type:'POST',
                        data:{
                            produk_id : idproduct,
                            email : email,
                            nohp : nohp,
                            namaproduct : namaproduct,
                            harga : harga,
                            metodepembayaran : selectedRadioButton ? selectedRadioButton.value : ''
                        },
                        success:function(response){
                            
                            let no_invoice =  response.invoice_url;
                            window.location.href = no_invoice;
                            
                        },
                        error: function(xhr, status, error) {
                            // Mengakses pesan kesalahan dari respons JSON
                            let errorMessage = xhr.responseJSON.message;
                            console.log("Error:", errorMessage);
                            alert(errorMessage);
                        }
                    });
                    closeModal();
                });
            });
            
            
    
        });
        
    </script>
    
    <script>
        $(document).ready(function() {
            $('#testButton').click(function() {
                $.ajax({
                    url: "{{route('create-invoice')}}", // Ganti dengan URL endpoint yang ingin Anda tuju
                    type: 'POST', // atau 'GET' tergantung kebutuhan
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Aksi ketika request berhasil
                        console.log('Success:', response);
                    },
                    error: function(xhr, status, error) {
                        // Aksi ketika request gagal
                        console.error('Error:', error);
                    }
                });
            });
        });
        
    </script>
    
    @endsection
    
    @push('style')
    <style>
        :root {
            --card-line-height: 1.2em;
            --card-padding: 1em;
            --card-radius: 0.5em;
            --color-green: #558309;
            --color-gray: #e2ebf6;
            --color-dark-gray: #c4d1e1;
            --radio-border-width: 2px;
            --radio-size: 1.5em;
        }
        
        body {
            background-color: #f2f8ff;
            color: #263238;
            font-family: 'Noto Sans', sans-serif;
            margin: 0;
            padding: 2em 6vw;
        }
        
        .grid {
            display: grid;
            grid-gap: var(--card-padding);
            margin: 0 auto;
            max-width: 60em;
            padding: 0;
            
            @media (min-width: 42em) {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        
        .card {
            background-color: #fff;
            border-radius: var(--card-radius);
            position: relative;
            
            &:hover {
                box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.15);
            }
        }
        
        .radio {
            font-size: inherit;
            margin: 0;
            position: absolute;
            right: calc(var(--card-padding) + var(--radio-border-width));
            top: calc(var(--card-padding) + var(--radio-border-width));
        }
        
        @supports(-webkit-appearance: none) or (-moz-appearance: none) { 
            .radio {
                -webkit-appearance: none;
                -moz-appearance: none;
                background: #fff;
                border: var(--radio-border-width) solid var(--color-gray);
                border-radius: 50%;
                cursor: pointer;
                height: var(--radio-size);
                outline: none;
                transition: 
                background 0.2s ease-out,
                border-color 0.2s ease-out;
                width: var(--radio-size); 
                
                &::after {
                    border: var(--radio-border-width) solid #fff;
                    border-top: 0;
                    border-left: 0;
                    content: '';
                    display: block;
                    height: 0.75rem;
                    left: 25%;
                    position: absolute;
                    top: 50%;
                    transform: 
                    rotate(45deg)
                    translate(-50%, -50%);
                    width: 0.375rem;
                }
                
                &:checked {
                    background: var(--color-green);
                    border-color: var(--color-green);
                }
            }
            
            .card:hover .radio {
                border-color: var(--color-dark-gray);
                
                &:checked {
                    border-color: var(--color-green);
                }
            }
        }
        
        .plan-details {
            border: var(--radio-border-width) solid var(--color-gray);
            border-radius: var(--card-radius);
            cursor: pointer;
            display: flex;
            flex-direction: column;
            padding: var(--card-padding);
            transition: border-color 0.2s ease-out;
        }
        
        .card:hover .plan-details {
            border-color: var(--color-dark-gray);
        }
        
        .radio:checked ~ .plan-details {
            border-color: var(--color-green);
        }
        
        .radio:focus ~ .plan-details {
            box-shadow: 0 0 0 2px var(--color-dark-gray);
        }
        
        .radio:disabled ~ .plan-details {
            color: var(--color-dark-gray);
            cursor: default;
        }
        
        .radio:disabled ~ .plan-details .plan-type {
            color: var(--color-dark-gray);
        }
        
        .card:hover .radio:disabled ~ .plan-details {
            border-color: var(--color-gray);
            box-shadow: none;
        }
        
        .card:hover .radio:disabled {
            border-color: var(--color-gray);
        }
        
        .plan-type {
            color: var(--color-green);
            font-size: 1.5rem;
            font-weight: bold;
            line-height: 1em;
        }
        
        .plan-cost {
            font-size: 2.5rem;
            font-weight: bold;
            padding: 0.5rem 0;
        }
        
        .slash {
            font-weight: normal;
        }
        
        .plan-cycle {
            font-size: 2rem;
            font-variant: none;
            border-bottom: none;
            cursor: inherit;
            text-decoration: none;
        }
        
        .hidden-visually {
            border: 0;
            clip: rect(0, 0, 0, 0);
            height: 1px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute;
            white-space: nowrap;
            width: 1px;
        }
        
        .styled-text {
            display: block; /* Mengubah elemen span menjadi block untuk dapat diatur alignment-nya */
            text-align: center; /* Menempatkan teks di tengah */
            font-size: 30px; /* Mengatur ukuran font */
            color: blue; /* Mengatur warna teks */
            margin: 0 auto; /* Menambahkan margin otomatis di kiri dan kanan untuk center jika menggunakan block */
        }
    </style>
    @endpush