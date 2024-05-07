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
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                    <h6 class="text-white text-capitalize ps-3">Riwayat Scann Kotoran Ayam</h6>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <div class="container">
                                            <div class="row justify-content-center flex-column flex-lg-row-reverse justify-between items-center py-6 text-center text-lg-right my-5">
                                                @foreach($getAllPredictions as $predik)
                                                        <div class="col-lg-6">
                                                        <div class="row row-cols-1 row-cols-md-2 g-4">
                                                            <div class="col">
                                                                <div class="card">  
                                                                    <img src="{{ $predik->img_url }}" class="card-img-top" alt="...">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title">{{ $predik->penyakit }}</h5>
                                                                            <p class="card-text">{{ $predik->solusi }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                @endforeach

                                                
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
