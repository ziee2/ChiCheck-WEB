<x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.sidebar activePage="scan"></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.auth titlePage="Scanner"></x-navbars.navs.auth>
            <!-- End Navbar -->
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-warning shadow-warning border-radius-lg pt-4 pb-3">
                                    <h6 class="text-white text-capitalize ps-3">Hasil Scann Kotoran Ayam</h6>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <div class="container">
                                            <div class="row justify-content-center flex-column flex-lg-row-reverse justify-between items-center py-4 text-center text-lg-right my-1">
                                                <div class="col-lg-6">
                                                    <h1 class="font-weight-bold display-4  mb-lg-2">
                                                        Hasil Scan
                                                    </h1>
                                                    @if($prediction)
                                                    <img class="mb-4 mt-4"src="{{ $prediction->img_url }}" alt="">
                                                    <h3 class="mb-4 mb-lg-4">
                                                        {{  $prediction->penyakit  }}
                                                    </h3>
                                                    <p class="mb-4 mb-lg-4">
                                                        {{ $prediction->deskripsi }}
                                                    </p>
                                                    <p class="mb-4 mb-lg-4">
                                                        {{ $prediction->solusi }}
                                                    </p>
                                                    @else
                                                    <p class="mb-1 mb-lg-4">Tidak ada prediksi terbaru.</p>
                                                    @endif
                                                    <a class="mt-4 btn btn-warning btn-lg text-white fw-bold" href=" {{ route('scan') }} ">
                                                        <span class="ms-2 font-weight-bold text-white">Scan Ulang</span>
                                                    </a>
                                                </div>
                                                </div>
                                            </div>
                                                

                                                <script>
                                                </script>
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
