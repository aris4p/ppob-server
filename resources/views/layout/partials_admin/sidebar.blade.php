 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->
      
        
        
        
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Produk</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('tambah-product') }}">
                        <i class="bi bi-circle"></i><span>Tambah</span>
                    </a>
                </li>
            </ul>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('product') }}">
                        <i class="bi bi-circle"></i><span>Data Produk</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav -->
        
        <li class="nav-item">
        <a class="nav-link " href="{{ route('transaction') }}">
                <i class="bi bi-grid"></i>
                <span>Transaction</span>
            </a>
        </li><!-- Transaction Nav -->

    </aside>
