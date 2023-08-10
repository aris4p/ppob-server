   <!-- ======= Header ======= -->
        
   <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('home') }}" class="logo d-flex align-items-center">
                <img src="{{ asset("assets/img/logo-wetoko.png") }}" alt="wetoko">
                <span class="d-none d-lg-block">WeToko</span>
            </a>
        </div><!-- End Logo -->
        <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('cek-invoice') }}">Cek Invoice</a>
              </li>
            
            </ul>
          </div>
    </div>
</nav><!-- End Header -->