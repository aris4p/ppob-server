@extends('layout.client_main')
@section('body')

<section class="mt-4 mb-5">
  <div class="container">
    <div class="card bg-light">
      <div class="card-header card text-white bg-danger">
        <span style="font-size:22px;">Invoice #{{ $transaction->invoice }}</span>
      </div>
      <div class="card-body">
        <div class="alert alert-warning" role="alert">
          <span style="font-size:20px;" id="epoch">
            <i class="fa-solid fa-circle-info"></i> sssss </span>
          </div>
          <div class="row">
            <div class="col-lg-3 mb-4">
              <div class="card">
                <img style="width:100%;" src="{{ $items->image_url }}" loading="lazy" alt="{{ $items->name }}" class="text-center">
              </div>
            </div>
            <div class="col-lg">
              <div class="card bg-light">
                <div class="card-header">
                  <h3>Detail Transaksi</h3>
                  <input type="hidden" id="epochTime" value="{{ $result->expired_time }}">
                </div>
                <div class="card-body">
                  <table width="100%">
                    <tbody>
                      @if ( $result->payment_method  === "QRIS" || $result->payment_method  === "QRISC" )
                      <tr>
                        <td colspan="2" style="text-align: center"><img src="{{ $result->qr_url }}" width="200px"></td>
                      </tr>
                      @else   
                      @endif                  
                      <tr>
                        <th>Produk</th>
                        <td>{{ $items->name }}</td>
                      </tr>
                      <tr>
                        <th>Email</th>
                        <td>{{ $result->customer_email }}</td>
                      </tr>
                      <tr>
                        <th>Metode Pembayaran</th>
                        <td>{{ $result->payment_name }}</td>
                        
                      </tr>
                      <tr>
                        <th>Kode Referensi</th>
                        <td>{{ $result->reference }}</td>
                      </tr>
                      
                      <tr>
                        <th>Total Bayar</th>
                        <td>
                          <mark style=" background-color: red;color: white;">Rp.{{ number_format($result->amount) }}</mark>
                        </td>
                      </tr>
                      <tr>
                        <th>Status Bayar</th>
                        <td>{{ $result->status }}</td>
                      </tr>
                      @if ($result->status != "PAID")

                      @if ($result->payment_method  === "OVO")
                      <tr>
                        <td>
                          <input type="hidden" id="urlCheckout" value={{ $result->checkout_url }}>
                          <button class="btn btn-primary mt-3" onclick="processPayment()">Lanjutkan Pembayaran</button>
                        </td>
                      </tr>
                      @endif
                      @else
                      <tr> 
                        <td rowspan="2">
                          <span class="btn btn-primary">SUDAH TERBAYAR</span>
                        </td>
                      </tr> 
                      
                      @endif
                    </tbody>
                  </table>
                  <p class="small mt-4">*Cek SPAM pada email jika detail akun tidak masuk.</p>
                </div>
              </div>
              <div class="card mt-4 bg-light">
                <div class="card-header">
                  <h3>Instruksi Pembayaran</h3>
                </div>
                @foreach ($result->instructions as $instruksi )
                <div class="card-body">
                  <span style="font-size:20px;">{{ $instruksi->title }}</span>
                  <ul>
                    @foreach ($instruksi->steps as $steps)
                    
                    <li>{!! $steps !!}</li>
                    @endforeach
                  </ul>
                  
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script>
    // Waktu epoch yang akan dikonversi
    var epochTime = document.getElementById("epochTime").value;
    
    // Membuat objek Date dari waktu epoch
    var dateObj = new Date(epochTime * 1000);
    
    // Opsi format waktu
    var options = {
      year: 'numeric',
      month: 'long',
      day: 'numeric',
      hour: 'numeric',
      minute: 'numeric',
      second: 'numeric',
      timeZoneName: 'long'
    };
    
    // Mengkonversi waktu ke waktu lokal
    var localTime = dateObj.toLocaleString('id-ID', options);
    
    // Menampilkan waktu lokal
    console.log(localTime);
    // Menampilkan waktu lokal
    document.getElementById("epoch").innerHTML="Silahkan Bayar Sebelum : "+localTime;
    
    
    function processPayment(){
      let halPayment = document.getElementById("urlCheckout").value;
      
      window.open(halPayment, "_blank");
      
    }
    
  </script>
  
  
  @endsection
  