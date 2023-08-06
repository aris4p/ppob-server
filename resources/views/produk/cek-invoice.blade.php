@extends('layout.client_main')
@section('body')

<section id="">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4 bg-light">
                    <div class="card-header card text-white bg-danger">
                        <span style="font-size:20px;">Lengkapi Data</span>
                    </div>
                    <form method="GET" action="{{ route('invoice') }}">
                        <div class="card-body">
                            <div class="form-group">
                                <input name="no_invoice" type="text" class="form-control" placeholder="Masukkan No.Invoice (Contoh: INVXXX)" aria-label="no_invoice">
                            </div>
                        </div>
                        <div class="card-footer">
                            <input class="btn btn-danger"  type="submit" >
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection