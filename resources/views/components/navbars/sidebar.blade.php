@props(['activePage'])


<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 d-flex text-wrap align-items-center" href=" {{ route('dashboard') }} ">
            <img src="{{ asset('assets') }}/img/chicheck_logo.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-2 font-weight-bold text-white">ChiCheck</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Pages</h6>
            </li>
            

    <!-- <li class="nav-item">
        <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown link
            </a>

            <ul class="nav-item dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
        </div>
    </li> -->

    <!-- <li class="nav-item sidebar-item">
        <a href="#" class="ms-0 nav-link text-white sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard"
            aria-expanded="false" aria-controls="dashboard">
            <i class="fa-solid fa-sliders pe-2"></i>
            Pendataan
        </a>
        <ul id="dashboard" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar"> 
            <li class="nav-item sidebar-item">
                <a href="{{ route('scan') }}" class="sidebar-link nav-link text-white {{ $activePage == 'scan' ? ' active bg-gradient-primary' : '' }}  ">
                <span class="nav-link-text ms-1">Scanner</span></a>
            </li>
            <li class="nav-item sidebar-item">
                <a href="{{ route('scan') }}" class="sidebar-link nav-link text-white {{ $activePage == 'scan' ? ' active bg-gradient-primary' : '' }}  ">
                <span class="nav-link-text ms-1">Riwayat SScan</span></a>
            </li>
        </ul>
    </li> -->


    
    
    @if (auth()->user()->level=='Admin')
    <li class="nav-item sidebar-item">
            <a class="nav-link text-white {{ $activePage == 'dashboard' ? ' active bg-gradient-primary' : '' }} "
            href="{{ route('dashboard-admin') }}">
            <!-- <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">dashboard</i>
            </div> -->
            <span class="nav-link-text ms-1">Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-white {{ $activePage == 'user-management' ? ' active bg-gradient-primary' : '' }} "
            href="{{ route('user-management') }}">
            <!-- <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i style="font-size: 1rem;" class="fas fa-lg fa-list-ul text-center"></i>
            </div> -->
            <span class="nav-link-text ms-1">User Management</span>
        </a>
    </li>
    @endif
    @if (auth()->user()->level=='Owner')

    
    
    <li class="nav-item">
        <a class="nav-link text-white {{ $activePage == 'dashboard' ? ' active bg-gradient-primary' : '' }} "
        href="{{ route('dashboard') }}">
        <!-- <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">dashboard</i>
        </div> -->
        <span class="nav-link-text ms-1">Dashboard</span>
    </a>
</li>


<!-- <li class="nav-item sidebar-item">
    <a href="#" class="ms-0 nav-link text-white sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard"
        aria-expanded="false" aria-controls="dashboard">
        <i class="fa-solid fa-sliders pe-2"></i>
        Scan
    </a>
    <ul id="dashboard" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar"> 
        <li class="nav-item sidebar-item">
            <a href="{{ route('scan') }}" class="sidebar-link nav-link text-white {{ $activePage == 'scan' ? ' active bg-gradient-primary' : '' }}  ">
            <span class="nav-link-text ms-1">Scanner</span></a>
        </li>
        <li class="nav-item sidebar-item">
            <a class="sidebar-link nav-link text-white {{ $activePage == 'riwayat-scan' ? ' active bg-gradient-primary' : '' }}  "
            href="{{ route('riwayat-scan') }}">
                    <span class="nav-link-text ms-1">Riwayat Scan</span>
            </a>
        </li>
    </ul>
</li> -->


<li class="nav-item sidebar-item">
    <a href="#" class="ms-0 nav-link text-white sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard"
        aria-expanded="false" aria-controls="dashboard">
        Data
    </a>
    <ul id="dashboard" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar"> 
        <li class="nav-item sidebar-item">
            <a href="{{ route('scan') }}" class="sidebar-link nav-link text-white {{ $activePage == 'scan' ? ' active bg-gradient-primary' : '' }}  ">
                <span class="nav-link-text ms-1">Data Ayam</span>
            </a>
        </li>
        <li class="nav-item sidebar-item">
            <a class="sidebar-link nav-link text-white {{ $activePage == 'riwayat-scan' ? ' active bg-gradient-primary' : '' }}  "
            href="{{ route('riwayat-scan') }}">
                    <span class="nav-link-text ms-1">Data Pakan</span>
            </a>
        </li>
        <li class="nav-item sidebar-item">
            <a class="sidebar-link nav-link text-white {{ $activePage == 'riwayat-scan' ? ' active bg-gradient-primary' : '' }}  "
            href="{{ route('riwayat-scan') }}">
                    <span class="nav-link-text ms-1">Data Telur</span>
            </a>
        </li>
    </ul>
</li>


                    <li class="nav-item sidebar-item">
                        <a href="#" class="nav-link text-white sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#auth"
                            aria-expanded="false" aria-controls="auth">
                            Auth
                        </a>
                        <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">


                            <!-- <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Login</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Register</a>
                            </li> -->
                            <li class="nav-item">
                                        <a class="nav-link text-white {{ $activePage == 'scan' ? ' active bg-gradient-primary' : '' }}  "
                                        href="{{ route('scan') }}">
                                        <span class="nav-link-text ms-1">Scanner</span>
                                    </a>
                            </li>
                            <li class="nav-item">
                                    <a class="nav-link text-white {{ $activePage == 'riwayat-scan' ? ' active bg-gradient-primary' : '' }}  "
                                    href="{{ route('riwayat-scan') }}">
                                        <span class="nav-link-text ms-1">Riwayat Scan</span>
                                    </a>
                            </li>



                        </ul>
                    </li>
            
    <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'scan' ? ' active bg-gradient-primary' : '' }}  "
                href="{{ route('scan') }}">
                <span class="nav-link-text ms-1">Scanner</span>
            </a>
    </li>
    <li class="nav-item">
            <a class="nav-link text-white {{ $activePage == 'riwayat-scan' ? ' active bg-gradient-primary' : '' }}  "
            href="{{ route('riwayat-scan') }}">
                <span class="nav-link-text ms-1">Riwayat Scan</span>
            </a>
    </li>
    <li class="nav-item">
            <a class="nav-link text-white {{ $activePage == 'data-ayam' ? ' active bg-gradient-primary' : '' }}  "
            href="{{ route('data-ayam') }}">
            <!-- <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">receipt_long</i>
                </div> -->
                <span class="nav-link-text ms-1">Data Ayam</span>
            </a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-white {{ $activePage == 'data-pakan' ? ' active bg-gradient-primary' : '' }}  "
        href="{{ route('data-pakan') }}">
        <!-- <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">receipt_long</i>
        </div> -->
        <span class="nav-link-text ms-1">Data Pakan</span>
    </a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-white {{ $activePage == 'data-telur' ? ' active bg-gradient-primary' : '' }}  "
            href="{{ route('data-telur') }}">
            <!-- <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">receipt_long</i>
            </div> -->
            <span class="nav-link-text ms-1">Data Telur</span>
        </a>
    </li>
    @endif
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'profile' ? ' active bg-gradient-primary' : '' }}  "
                href="{{ route('profile') }}">
                <!-- <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">person</i>
                </div> -->
                <span class="nav-link-text ms-1">Profile</span>
                </a>    
            </li>   
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" class="d-none" id="logout-form">
                        @csrf
                    </form>
                    <a class="nav-link text-white "
                    href="javascript:;">
                    <!-- <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-user me-sm-1"></i>
                    </div> -->
                    <span class="d-sm-inline d-none" onclick="myFunction()">LogOut</span>
                </a>
            </li>
        </ul>
    </div>
    
    <script>
    function myFunction() {
        var confirmation = confirm("Apakah Anda yakin ingin keluar?");
        if (confirmation) {
            document.getElementById('logout-form').submit();
        }
    }

    const toggler = document.querySelector(".btn");
    toggler.addEventListener("click",function(){
        document.querySelector("#sidebar").classList.toggle("collapsed");
    });
</script>
</aside>
