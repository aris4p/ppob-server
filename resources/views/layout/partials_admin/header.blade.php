<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="" class="logo d-flex align-items-center">
        <img src="{{asset('assets/img/logo.png') }}" alt="">
        <span class="d-none d-lg-block justify">Kampungku Digital <br>RT 04</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" action="datauser">
        <input type="text" class="form-control" placeholder="Cari.." name="search" value="{{ request('search') }}">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->


        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            @auth
                @if (Auth()->user()->foto)
                    <img src="{{ asset('assets/img/'.auth()->user()->foto) }}" alt="Profile" class="rounded-circle">
                @else
                    <img src="{{ asset('assets/img/akun.webp')}}" alt="Profile" class="rounded-circle">
                @endif
            @else
            <img src="{{ asset('assets/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
            @endauth
            <span class="d-none d-md-block dropdown-toggle ps-2">@auth {{ Auth()->user()->name }} @else Tamu @endauth</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
                @auth
              <h6>{{ auth()->user()->name }} |

               @if ( auth()->user()->role  == 1 )
                    Admin
               @else
                    Member
               @endif
            </h6>
              @else
              <h6>Tamu</h6>
              @endauth
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
            <form action="/logout" method="post">
                @csrf
                <button type="submit" class="dropdown-item"> <i class="bi bi-box-arrow-right"></i>
                    <span>Keluar</span></button>
            </form>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header>
