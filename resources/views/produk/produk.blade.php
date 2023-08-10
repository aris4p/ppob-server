@extends('layout.client_main')
@section('body')

<section class="mt-4 mb-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card pt-4 pb-4 bg-light">
                    <div class="container">
                        <img style="border-radius:20px;width:100%;" src="{{ asset('gambar_produk/'.$produk->gambar) }}" loading="lazy" alt="" class="text-center">
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
                
                <form action="#" method="post">
                    
                    {{-- @csrf {{ route("pembayaran") }} --}}
                    <input type="hidden" value="{{ $produk->id }}" name="id" id="produk_id">
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
                    <div class="card bg-light mb-4">
                        <div class="card-header card text-white bg-danger">
                            <span style="font-size:20px;">Pilih Nominal</span>
                        </div>
                        <div class="card-body">
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
                            
                            <div class="row">
                                
                                <div class="col-md-4 col-lg-4 col-sm-4">
                                    
                                    <label>
                                        <input type="hidden" value="{{ $produk->nama }}" name="produk_name" id="produk_name">
                                        {{-- <input type="radio" name="product" id="{{ $produk->name }}"  class="card-input-element" data-amount="{{ $produk->harga }}" value="{{ $produk->harga }}" /> --}}
                                        <input type="radio" name="product" id="product"  class="card-input-element" data-amount="{{ $produk->harga }}" value="{{ $produk->harga }}" />
                                        
                                        <div class="card card-input">
                                            <div class="card-header mx-auto">{{ $produk->nama }}</div>
                                            <div class="card-body mx-auto" id="harga">
                                                Rp.{{number_format( $produk->harga ) }}
                                            </div>
                                        </div>
                                        
                                    </label>
                                    
                                </div>
                            </div>
                            
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
                                    <div class="card-header">
                                        <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                                            E-Wallet
                                        </a>
                                    </div>
                                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                @foreach ($result as $pembayaran)
                                                @if ($pembayaran->group == "E-Wallet")
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
                                </div>
                                
                                <div class="card " id="deletebank">
                                    <div class="card-header">
                                        <a class="card-link" data-toggle="collapse" href="#collapseOne">
                                            Bank
                                        </a>
                                    </div>
                                    <div id="collapseOne" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
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
                                </div>
                                
                                
                                
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
            
            
            
            // Mendapatkan semua radio button dengan nama "deleteElement"
            let radioButtons = document.getElementsByName('product');
            
            // 02 Proses menampilkan data     
            $('body').on('click', '#btnPesan', function(e){
                e.preventDefault();
                let idproduct = $('#produk_id').val();
                let email =  $('#email').val();
                let nohp =  $('#nohp').val();
                let namaproduct =  $('#produk_name').val();
                let harga =  $('#product').val();
                const selectedRadioButton =  document.querySelector('input[name="pembayaran"]:checked');
                let metodepembayaran = selectedRadioButton.value;
                document.getElementById('modalEmail').innerHTML = email;
                document.getElementById('modalHp').innerHTML = nohp;
                document.getElementById('modalNamaproduk').innerHTML = namaproduct;
                document.getElementById('modalHarga').innerHTML = harga;
                document.getElementById('modalMetodepembayaran').innerHTML = metodepembayaran;
                
                $('#modalPesan').modal('show');
                // 03 proses pembayaran
                $('#btnpesan').click(function(){
                    const selectedRadioButton = document.querySelector('input[name="pembayaran"]:checked');
                    $.ajax({
                        url: "{{ route('pembayaran') }}",
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
                            
                            let no_invoice =  response.invoice_id;
                            window.location.href = "{{ route('invoice') }}?no_invoice="+no_invoice;
                            
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
            
            
            
            // Menghapus bank jika harga dibawah 10Rb
            function parseHarga() {
                
                const selectedProduct = document.querySelector('input[name="product"]:checked');
                let hargas = selectedProduct ? selectedProduct.parentElement.querySelector('.card-body.mx-auto#harga').innerText : "";
                var str = hargas;
                
                // Menghapus karakter "Rp." dari string
                var cleanedStr = str.replace("Rp.", "").replace(",", "");
                
                // Mengubah string menjadi integer
                var integerValue = parseInt(cleanedStr);
                
                return integerValue;
            }
            
            let deletedElement;
            function deleteElement() {
                let element = document.getElementById('deletebank');
                deletedElement = element.cloneNode(true);
                element.remove();
            }
            
            function restoreElement() {
                if (deletedElement) {
                    var container = document.getElementById('accordion');
                    container.appendChild(deletedElement);
                    // Setelah elemen dikembalikan, set deletedElement kembali ke null
                    deletedElement = null;
                } else {
                    
                }
            }
            
            
            
            
            // Tambahkan event listener untuk setiap radio button
            for (var i = 0; i < radioButtons.length; i++) {
                radioButtons[i].addEventListener('click', function() {
                    // Panggil fungsi deleteElement jika radio button dipilih
                    let integer = parseHarga();
                    
                    
                    
                    
                    // Lakukan aksi sesuai dengan nilai value yang dipilih
                    if (integer < 9999) {
                        deleteElement();
                    } else if (integer > 10000) {
                        restoreElement();
                    }
                });
            }
            
            function updateTotalFee() {
                
                $('.total_fee').each(function(index, element) {
                    let type = $(element).find(".kode").val();
                    let flatss = $(element).find(".flat").val();
                    let percentss = $(element).find(".percent").val();
                    let flats = parseFloat(flatss);
                    let percents = parseFloat(percentss);
                    let selectedAmount = $("input[name='product']:checked").data("amount");
                    
                    let amount = parseInt(selectedAmount);
                    if (isNaN(flats)) {
                        // Jika flats bukan angka, atur nilai default ke 0
                        flats = 0;
                    }
                    
                    if (isNaN(percents)) {
                        // Jika percents bukan angka, atur nilai default ke 0
                        percents = 0;
                    }
                    
                    // Jumlah yang ingin dihitung (misalnya, nilai dari suatu variabel amount)
                    // Ganti nilainya sesuai kebutuhan, atau ambil dari input tertentu
                    
                    // Menghitung nilai dari persentase berdasarkan input persen
                    let percentFee = (amount * percents) / 100;
                    if (type === "redirect") {
                        
                        if (percentFee < 1000) {
                            percentFee = 1000;
                        }
                    }
                    
                    // Menghitung total jumlah yang diinginkan
                    let jumlah = amount + flats + percentFee;
                    
                    $(element).find(".total").text(isNaN(jumlah)? "Rp. 0" : "Rp. " +jumlah.toLocaleString("en-US"));
                });
            }
            
            
            // Initially, update the total_fee with the default selected product's data-amount
            updateTotalFee();
            
            // Event listener to update the total_fee when the product radio buttons are clicked
            $("input[name='product']").on("change", function() {
                updateTotalFee();
            });
            
        });
        
    </script>
    
    @endsection
    
    