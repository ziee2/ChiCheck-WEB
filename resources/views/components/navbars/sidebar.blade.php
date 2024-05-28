@props(['activePage'])


<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-2 bg-gradient-dark"
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
    <div class="collapse navbar-collapse w-auto h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-0 text-uppercase text-xs text-white font-weight-bolder opacity-8">Pages</h6>
            </li>
            <!-- admin -->
        @if (auth()->user()->level=='Admin')
        <li class="nav-item sidebar-item">
                <a class="nav-link text-white {{ $activePage == 'dashboard' ? ' active bg-gradient-primary' : '' }} "
                href="{{ route('dashboard-admin') }}">
                <span class="nav-link-text ms-1">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'profile' ? ' active bg-gradient-primary' : '' }}  "
                href="{{ route('profile') }}">
                <span class="nav-link-text ms-1">Profile</span>
                </a>    
            </li>   
        <li class="nav-item">
            <a class="nav-link text-white {{ $activePage == 'user-management' ? ' active bg-gradient-primary' : '' }} "
                href="{{ route('user-management') }}">
                <span class="nav-link-text ms-1">Data Akun</span>
            </a>
        </li>
        @endif
        @if (auth()->user()->level=='Owner')
    
        <li class="nav-item">
            <a class="nav-link text-white {{ $activePage == 'dashboard' ? ' active bg-gradient-primary' : '' }} "
            href="{{ route('dashboard') }}">
            <span class="nav-link-text ms-1">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'profile' ? ' active bg-gradient-primary' : '' }}  "
                href="{{ route('profile') }}">
                <span class="nav-link-text ms-1">Profile</span>
                </a>    
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link text-white" data-bs-toggle="collapse" data-bs-target="#scanMenu"
                    aria-expanded="false" aria-controls="scanMenu">
                    <span class="nav-link-text ms-1">Scan Penyakit</span>
                </a>
                <ul id="scanMenu" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar"> 
                    <li class="nav-item sidebar-item">
                        <a href="{{ route('scan') }}" class="sidebar-link nav-link text-white {{ $activePage == 'scan' ? ' active bg-gradient-primary' : '' }}">
                            <span class="nav-link-text ms-2">Scan Penyakit Ayam</span>
                        </a>
                    </li>
                    <li class="nav-item sidebar-item">
                        <a href="{{ route('riwayat-scan') }}" class="sidebar-link nav-link text-white{{ $activePage == 'riwayat-scan' ? ' active bg-gradient-primary' : '' }}">
                            <span class="nav-link-text ms-2">Riwayat Prediksi Penyakit Ayam</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="" class="nav-link text-white" data-bs-toggle="collapse" data-bs-target="#pendataan"
                    aria-expanded="false" aria-controls="pendataan">
                    <span class="nav-link-text ms-1">Pendataan</span>
                </a>
                <ul id="pendataan" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar"> 
                    <li class="nav-item sidebar-item">
                        <a href="{{ route('data-ayam') }}" class="sidebar-link nav-link text-white {{ $activePage == 'data-ayam' ? ' active bg-gradient-primary' : '' }}">
                            <span class="nav-link-text ms-2">Data Ayam</span>
                        </a>
                    </li>
                    <li class="nav-item sidebar-item">
                        <a href="{{ route('data-pakan') }}" class="sidebar-link nav-link text-white{{ $activePage == 'data-pakan' ? ' active bg-gradient-primary' : '' }}">
                            <span class="nav-link-text ms-2">Data Pakan</span>
                        </a>
                    </li>
                    <li class="nav-item sidebar-item">
                        <a href="{{ route('data-telur') }}" class="sidebar-link nav-link text-white{{ $activePage == 'data-telur' ? ' active bg-gradient-primary' : '' }}">
                            <span class="nav-link-text ms-2">Data Telur</span>
                        </a>
                    </li>
                </ul>
            </li>
    
    @endif
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}" class="d-none" id="logout-form">
                    @csrf
                </form>
                <a class="nav-link text-white"
                href="javascript:;" onclick="myFunction()">
                    <span class="nav-link-text ms-1">Logout</span>
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
    const sidebar = document.querySelector("#sidebar");

    toggler.addEventListener("click", function() {
        sidebar.classList.toggle("collapsed");
    });

</script>
</aside>
