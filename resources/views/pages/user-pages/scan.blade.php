    <x-layout bodyClass="g-sidenav-show bg-gray-200">
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
                                        <h6 class="text-white text-capitalize ps-3">Scan Kotoran Ayam</h6>
                                    </div>
                                </div>
                                
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible text-white" role="alert">
                                    <span class="text-sm">{{ session('status') }}</span>
                                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if (session('error'))
                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                                    errorModal.show();
                                });
                            </script>
                            @endif


                                <div class="card-body px-0 pb-2">
                                    <div class="table-responsive p-0">
                                        <table class="table align-items-center mb-0">
                                            <div class="container">
                                                <div class="row justify-content-center flex-column flex-lg-row-reverse justify-between items-center py-1 text-center text-lg-right my-5">
                                                    <div class="col-lg-8">
                                                        <h1 class="font-weight-bold display-4 mb-4 mb-lg-5">
                                                            Solusi Pintar Untuk 
                                                            <span class="text-orange">Kesehatan</span> Ayam 
                                                            Anda
                                                        </h1>
                                                        <p class="mb-4 mb-lg-4">
                                                        Kami menggabungkan teknologi kecerdasan buatan dengan analisis kotoran ayam untuk mendeteksi penyakit secara cepat dan akurat. Lindungi kawanan ayam Anda dengan menggunakan aplikasi canggih ini!
                                                        </p>
                                                    </div>

                                                    <form id="upload-form" action="{{ route('predict') }}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                                        <div class="mb-1 col-lg-8">
                                                            <input type="file" name="image" id="image-upload-input" style="display:none;" accept="image/*" >
                                                            <label for="image-upload-input" class="btn btn-warning btn-lg text-white me-auto fw-bold">Unggah Gambar</label>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div id="preview-container" class="row justify-content-center my-5 mx-auto" style="display: none;">
                                                                <p class="fw-bold text-warning text-center mb-5">Disease Prediction</p>
                                                                <div class="frame mx-auto" style="width: 500px; height: 350px; overflow: hidden; border-radius: 8px">
                                                                    <img class="" id="preview-image" alt="" style="width: 100%; height:100%; object-fit:cover;">
                                                                </div>
                                                                <button id="analyze-button" class= "mt-4 btn btn-warning btn-lg text-white fw-bold" type="submit">Analyze Image</button>
                                                                <a class="mt-4 btn btn-warning btn-lg text-white fw-bold" href=" {{ route('scan') }} ">
                                                                    <span class="ms-2 font-weight-bold text-white">Batal</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>
                                                    
                                        <!-- loading model -->
                                        <div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadingModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body text-center">
                                                        <div class="spinner-border text-primary" role="status">
                                                            <span class="visually-hidden">Loading...</span>
                                                        </div>
                                                        <p class="mt-3">Sedang Melakukan Scanning...</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- Error Modal -->
                                    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body text-center">
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ session('error') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                                    <script>
                                                        document.getElementById('image-upload-input').addEventListener('change', function(event){
                                                            var fileInput = event.target;
                                                            var file = fileInput.files[0];
                                                            
                                                            if (file) {
                                                                var reader = new FileReader();
                                                                reader.onload = function(e) {
                                                                    var previewImage = document.getElementById('preview-image');
                                                                    previewImage.src = e.target.result;
                                                                    document.getElementById('preview-container').style.display = 'block';

                                                                }
                                                
                                                                reader.readAsDataURL(file);
                                                            }
                                                        });

                                                        document.getElementById('upload-form').addEventListener('submit', function() {
                                                            var loadingModal = new bootstrap.Modal(document.getElementById('loadingModal'));
                                                            loadingModal.show();
                                                        });

                                                        document.getElementById('preview-container').scrollIntoView({ behavior: 'smooth' });
                                                        
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
