@props(['activePage'])


<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="profile"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Profile'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="mt-3 card card-body mx-3 mx-md-4 mt-n6">
                <div class="row gx-4 mb-2">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <img src="{{ asset('storage/profile_pictures/' . Auth::user()->image) }}" alt="profile_image"
                                class="w-100 border-radius-lg shadow-sm">
                            </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                            {{ auth()->user()->username }}
                            </h5>
                            <p class="mb-0 font-weight-normal text-sm">
                            {{ auth()->user()->level }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                        <div class="nav-wrapper position-relative end-0">
                            <ul class="nav nav-pills nav-fill p-1" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link mb-0 px-0 py-1 "
                                        href="{{ route('user-profile') }}"
                                        role="tab" aria-selected="false">
                                        <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                                        <span class="ms-1">Ubah Profile</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                        <div class="col-12 col-xl-12">
                            <div class="card card-plain h-100">
                                <div class="card-header pb-0 p-3">
                                    <div class="row">
                                        <div class="col-md-8 d-flex align-items-center">
                                            <h6 class="mb-3q">Informasi Profile</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-3">

                                    <ul class="list-group">
                                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong
                                                class="text-dark">Username: </strong> &nbsp; {{ auth()->user()->username }}</li>
                                        <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                class="text-dark">Email: </strong> &nbsp; {{ auth()->user()->email }}</li>
                                        <!-- <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                class="text-dark">Password:</strong> &nbsp; {{ auth()->user()->password }}</li> -->
                                        <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                class="text-dark">Nomor handphone:</strong> &nbsp; {{ auth()->user()->no_hp }}</li>
                                        <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                class="text-dark">Alamat:</strong> &nbsp; {{ auth()->user()->location }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <x-footers.auth></x-footers.auth> -->
    </div>
    <x-plugins></x-plugins>

</x-layout>
