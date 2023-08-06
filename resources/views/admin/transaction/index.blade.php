@extends('layout.admin_main')
@section('body')

<div class="pagetitle">
    <h1>{{ $title }}</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
@if ($message = Session::get('Success') )
<div class="alert alert-success alert-block">
    <strong>{{ $message }}</strong>
</div>
@endif

<section class="section dashboard">
    <!-- Table with hoverable rows -->
    <table class="table table-striped" style="width:100%" >
        @php
        $no=1;
        @endphp
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Produk</th>
                <th scope="col">Invoice</th>
                <th scope="col">Reference</th>
                <th scope="col">Email</th>
                <th scope="col">No Hp</th>
                <th scope="col">Amount</th>
                <th scope="col">Status</th>
              
                
            </tr>
        </thead>
        {{-- <tbody>
            @foreach ($products as $product)
            
            <tr>
                <th scope="row">{{ $no++ }}</th>
                <td>{{ $product->nama }}</td>
                <td>{{ $product->qty }}</td>
                <td>Rp. {{ number_format($product->harga) }}</td>
                
                
                <td >
                    
                    <a href="{{ route ('product-edit', ['id'=>$product->id]) }}" class="btn btn-sm btn-warning idProduct" id="idProduct" data-bs-toggle="modal" data-bs-target="#basicModal">Edit</a>
                    <form action="{{ route('delete-product', $product->id)}}" method="post" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Apakah yakin ingin menghapus?')" type="submit" value="Hapus" />Hapus</button>
                    </form>
                </td>
                
            </tr>
            
            
            @endforeach
        </tbody> --}}
    </table>
    
  
</section>

<script src="//code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
<script type="text/javascript"
src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript"
src="//cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.11.3/af-2.3.7/b-2.1.1/cr-1.5.5/date-1.1.1/fc-4.0.1/fh-3.2.1/kt-2.6.4/r-2.2.9/rg-1.1.4/rr-1.2.8/sc-2.0.5/sb-1.3.0/sp-1.4.0/sl-1.3.4/sr-1.0.1/datatables.min.js">
</script>
<script>
   
    
    //membuat datatables
    var table = $('.table').DataTable({
        processing: true,
        autoWidth: false,
        responsive: true,
        lengthChange: true,
        processing: true,
        serverSide: true,
        dom: 'lfrtip',
        //mengambil data dengan dana controller
        ajax: "{{ route('transaction') }}",
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            orderable: false,
            searchable: false
        },
        {
            data: 'product_id',
            name: 'product_id'
          
        },
        {
            data: 'invoice',
            name: 'invoice',
            orderable: true,
            searchable: true
        },
        {
            data: 'reference',
            name: 'reference',
            orderable: false,
            searchable: false
        },
        {
            data: 'email',
            name: 'email',
            orderable: false,
            searchable: false
        },
        {
            data: 'nohp',
            name: 'nohp',
            orderable: false,
            searchable: false
        },
        {
            data: 'amount',
            name: 'amount',
            orderable: false,
            searchable: false
        },
        {
            data: 'status',
            name: 'status',
            orderable: false,
            searchable: false
        },
        ]
    });
    

    
    // // Tambah Data
    // $('body').on('click', '.tombol-tambah-produk', function(e){
    //     $('#tambah-produk').modal('show');
    //     $('.tombol-simpan').click(function(){
    //         simpan();
    //     });
    // });
    
    
    // //edit Produk
    // $('body').on('click', '.editProduk', function(e){
    //     var id = $(this).data('id');
    //     $.ajax({
    //         url: "product-control/"+ id + '/edit',
    //         type: 'GET',
    //         success:function(response){
    //             $('#tambah-produk').modal('show');
    //             $('#nama').val(response.result.nama);
    //             $('#qty').val(response.result.qty);
    //             $('#harga').val(response.result.harga);
    //             $('#gambar').val(response.result.gambar);
                
    //             console.log(response.result);
    //             $('.tombol-simpan').click(function(){
    //                 simpan(id);
    //             });
    //         }
            
    //     });
    // });
    
    
    
    // // tutup modal
    // $('.close').click(function(){
    //     $("#tambah-produk").modal('hide');
    // });
    // $('#tambah-produk').on('hidden.bs.modal', function(){
    //     $('#nama').val('');
    //     $('#qty').val('');
    //     $('#harga').val('');
        
    //     $('.alert-danger').addClass('d-none');
    //     $('.alert-danger').html('');
        
    //     $('.alert-success').addClass('d-none');
    //     $('.alert-success').html('');
    // });
    
    // // function simpan dan update
    // function simpan(id = '') {
    //     if (id == '') {
    //         var var_url = "{{ route('product-control.store') }}";
    //         var var_type = 'POST';
    //     } else {
    //         var var_url = 'product-control/'+id;
    //         var var_type = 'PUT';
    //     }
    //     $.ajax({
    //         url: var_url,
    //         type: var_type,
    //         data: {
              
    //             nama: $('#nama').val(),
    //             qty: $('#qty').val(),
    //             harga: $('#harga').val(),
    //             gambar: $('#gambar').val()
                
    //         },
           
    //         success: function(response) {
    //             if (response.errors) {
    //                 $('.alert-danger').removeClass('d-none').find('ul').remove();
    //                 $('.alert-danger').append("<ul>");
    //                     $.each(response.errors, function(key, value) {
    //                         $('.alert-danger').find('ul').append("<li>" + value + "</li>");
    //                     });
    //                     $('.alert-danger').append("</ul>");
    //                 } else {
    //                     $('.alert-success').removeClass('d-none').html(response.Success);
    //                 }
    //                 $('.table').DataTable().ajax.reload();
    //             }
    //         });
    //     }
        
        
    //     //delete produk
    //     // Delete record
    //     $('body').on('click','.deleteProduk',function(){
    //         var id = $(this).data('id');
    //         console.log(id);
    //         var deleteConfirm = confirm("Are you sure?");
    //         if (deleteConfirm == true) {
    //             // AJAX request
    //             $.ajax({
    //                 url: "{{ route('delete-product') }}",
    //                 type: 'post',
    //                 data: {_token: CSRF_TOKEN,id: id},
    //                 success: function(response){
    //                     if(response.success == 1){
    //                         // Reload DataTable
    //                         table.ajax.reload();
    //                     }else{
    //                         alert("Invalid ID.");
    //                     }
    //                 }
    //             });
    //         }
            
    //     });
        
    //     let formSubmitted = false;
    //     function checkForm(form)
    //     {
    //         if(formSubmitted) {
    //             return false;
    //         }
    //         form.saveBtn.disabled = true;
    //         formSubmitted = true;
    //         return true;
    //     }
        
    </script>
    
    @endsection
    