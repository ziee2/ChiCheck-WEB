<x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.sidebar activePage="riwayat-scan"></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.auth titlePage="Riwayat Scan"></x-navbars.navs.auth>
            <!-- End Navbar -->
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div  class="bg-gradient-warning shadow-warning border-radius-lg pt-4 pb-3">
                                    <h6 class="text-white text-capitalize ps-3">Riwayat Scan Kotoran Ayam</h6>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <div class="container">
                                            <div class="row justify-content-center flex-column flex-lg-row-reverse justify-between items-center py-1 text-center text-lg-right my-1">
                                            @if(isset($isEmpty) && $isEmpty)
                                            <h5>Tidak ada data tersedia saat ini.</h5>
                                            @else
                                                @foreach($getAllPredictions as $predik)

                                                    <div class="card mb-5 col-lg-5 ms-5">
                                                        <img style="width: 10rem; " src="{{ $predik->img_url }}" class="mt-3 rounded mx-auto d-block card-img-top" alt="...">
                                                            <div class="card-body">
                                                                <h5 class="card-title">{{ $predik->penyakit }}</h5>
                                                                <p class="card-text">{{ $predik->solusi }}</p>
                                                                <!-- <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p> -->
                                                            </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                                
                                            </div>
                                            </div>
                                        </div>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <x-footers.auth></x-footers.auth>
            </div>
        </main>
        <x-plugins></x-plugins>

</x-layout>
