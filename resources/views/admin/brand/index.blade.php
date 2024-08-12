@extends('layout.admin_main')
@section('body')

<div class="pagetitle">
    <h1>{{ $title }}</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('product') }}">Home</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
@if ($message = Session::get('Success') )
<div class="alert alert-success alert-block">
    <strong>{{ $message }}</strong>
</div>
@endif
<div class="mb-3">
    <button type="button" class="btn btn-primary tombol-tambah-produk" data-bs-toggle="modal" data-bs-target="#tambah-produk">
        Tambah
    </button>
</div>
<section class="section dashboard">
    <!-- Table with hoverable rows -->
    <table class="table table-striped" style="width:100%" >
        @php
        $no=1;
        @endphp
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama brand</th>
                <th scope="col">Aksi</th>
                
            </tr>
        </thead>
        <tbody>
            @forelse ($brands as $data)
            <tr>
                <th scope="row">{{ $no++ }}</th>
                <td scope="row">
                    <img src="{{ Storage::url($data->gambar) }}" alt="Gambar" width="100">
                </td>
                <td>{{ $data->nama }}</td>
                <td>
                    <a href="{{ route('brand.edit', $data->id) }} " class="btn btn-sm btn-warning iddata" id="iddata" data-bs-toggle="modal" data-bs-target="#basicModal">Edit</a>
                    <form action="{{ route('brand.edit', $data->id) }}" method="post" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Apakah yakin ingin menghapus?')" type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Data tidak ada</td>
            </tr>
            @endforelse
        </tbody>        
    </table>
    
    <!-- Modal Tambah data -->
    <!-- Modal Tambah Data -->
    <form action="javascript:void(0)" class="form-horizontal" id="form-simpan" enctype='multipart/form-data'>
        @csrf
        <div class="modal fade" id="tambah-brand" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Brand</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger d-none"></div>
                        <div class="alert alert-success d-none"></div>
                        <div class="row mb-3">
                            <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="kategori" name="kategori">
                                    <option value="pulsa">Pulsa</option>
                                    <option value="game">Game</option>
                                    <option value="voucher">Voucher</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" name="nama">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="gambar" name="gambar">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary tombol-simpan">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    {{-- End Tambah Modal --}}
    
    
    <!-- Edit Modal -->
    <form id="form-tambah-brand" action="javascript:void(0)" class="form-horizontal" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="tambah-brand" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Brand</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger d-none"></div>
                        <div class="alert alert-success d-none"></div>
                        <div class="row mb-3">
                            <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="kategori" name="kategori">
                                    <option value="pulsa">Pulsa</option>
                                    <option value="game">Game</option>
                                    <option value="voucher">Voucher</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" name="nama">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="gambar" name="gambar">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary tombol-simpan">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    
    <!-- End Table with hoverable rows -->
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready(function() {
        
        $('.tombol-tambah-produk').on('click', function() {
            $('#tambah-brand').modal('show');
        });
        // Tangani submit form
        $('#form-simpan').on('submit', function(e) {
            e.preventDefault(); // Mencegah form submit secara default
            
            // Ambil data form
            var formData = new FormData(this);
            
            // Kirim data form melalui AJAX
            $.ajax({
                type: 'POST',
                url: '{{ route('brand.store') }}', // Ganti dengan route atau URL yang sesuai untuk menyimpan data
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    $('.tombol-simpan').prop('disabled', true); // Disable tombol submit saat proses
                },
                success: function(response) {  
                    
                    
                    if (response.success) {
                        console.log(response.success);
                        toastr.success("Data Berhasil Ditambahkan", "Berhasil")
                        
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": true,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": true,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        $('#tambah-brand').modal('hide'); // Tutup modal
                        // Refresh halaman atau tambahkan data ke tabel tanpa refresh
                    } else {
                        $('.alert-danger').removeClass('d-none').text(response.message);
                    }
                },
                error: function(response) {
                    toastr["error"]("Data Gagal Ditambahkan", "Gagal")
                    
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    
                },
                complete: function() {
                    $('.tombol-simpan').prop('disabled', false); // Enable kembali tombol submit
                }
            });
        });
    });
</script>
@endsection
