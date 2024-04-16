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
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                    <h6 class="text-white text-capitalize ps-3">Scann Kotoran Ayam</h6>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <div class="container">
                                            <div class="row justify-content-center flex-column flex-lg-row-reverse justify-between items-center py-6 text-center text-lg-right my-5">
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
                                                <div class="mb-1 col-lg-8">
                                                    <input type="file" id="image-upload-input" style="display:none;" accept="image/*">
                                                    <label for="image-upload-input" class="btn btn-warning btn-lg text-white me-auto fw-bold">Upload Image</label>
                                                </div>

                                            <div class="col-lg-12">
                                                    <div id="preview-container" class="row justify-content-center my-5 mx-auto" style="display: none;">
                                                        <p class="fw-bold text-warning text-center mb-5">Disease Prediction</p>
                                                        <form action="/predict" method="post" enctype="multipart/form-data">
                                                            {{-- @method('POST') --}}
                                                            @csrf
                                                            <div class="col-lg-6 text-center social-media my-2 pb-5 pb-md-3">
                                                                <input type="text" name="user_id" hidden value="1">
                                                                <div class="frame mx-auto" style="width: 500px; height: 350px; overflow: hidden; border-radius: 8px">
                                                                    <img class="" id="preview-image" name=""image"" alt="" style="width: 100%; height:100%; object-fit:cover;">
                                                                </div>

                                                                <div id="solusi" class="mt-4">
                                                                    <h1>fsdfsfwefe</h1>
                                                                </div>
                                                                <button class= "mt-4 btn btn-warning btn-lg text-white fw-bold" type="submit">Analyze Image</button>
                                                                
                                                            </div>
                                                        </form>
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
