<x-layout bodyClass="bg-gray-200">
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12"></div>
        </div>
    </div>
    <main class="main-content mt-0">
        <div class="page-header align-items-start min-vh-100" 
            style="background-image: url('https://images.unsplash.com/photo-1471623817296-aa07ae5c9f47?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
            <span class="mask bg-gradient-dark opacity-1"></span>
            <div class="container mt-6">
                <div class="row">
                    <div class="col-lg-10 col-md-12 col-12 mx-auto d-flex justify-content-between align-items-center" 
                        style="background: #fff; border-radius: 10px; padding: 20px;">
                        <!-- Login Form -->
                        <div class="card z-index-0 fadeIn3 fadeInBottom w-50 me-2">
                            <div class="card-header p-0 position-relative mt-n8 mx-5 z-index-2">
                                <div class="bg-gradient-warning shadow-warning border-radius-lg py-3 pe-1">
                                    <h4 class="text-white font-weight-bolder text-center m-auto"><span class="fs-2">SIGN-IN</span><span class="fs-6 ms-3">Akun milikmu</span></h4>
                                </div>
                            </div>
                            <div class="card-body mt-5">
                                <form role="form" method="POST" action="{{ route('login') }}" class="text-start" novalidate>
                                    @csrf
                                    @if (Session::has('status'))
                                    <div class="alert alert-success alert-dismissible text-white" role="alert">
                                        <span class="text-sm">{{ Session::get('status') }}</span>
                                        <button type="button" class="btn-close text-lg py-3 opacity-10" 
                                            data-bs-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @endif
                                    <div class="input-group input-group-outline mt-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email">
                                    </div>
                                    @error('email')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                    <div class="input-group input-group-outline mt-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                    @error('password')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-warning w-100 my-4 mb-2">Login</button>
                                    </div>
                                    <p class="mt-4 text-sm text-center">
                                        Belum memiliki akun? 
                                        <a href="{{ route('register') }}" class="text-warning text-gradient font-weight-bold">Sign Up</a>
                                    </p>
                                    <p class="text-sm text-center">
                                        Lupa Password? Atur ulang passwordmu 
                                        <a href="{{ route('verify') }}" class="text-warning text-gradient font-weight-bold">Disini</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                        <!-- Description Section -->
                        <div class="card z-index-0 fadeIn3 fadeInBottom w-50 ms-2">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-warning shadow-warning border-radius-lg py-3 pe-1">
                                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Tentang</h4>
                                    <p class="text-white text-center">Website ChiCheck</p>
                                </div>
                            </div>
                            <div class="card-body">
                                <ul class="text-dark">
                                    <li class="mb-3">
                                        <strong>Melakukan Scanning Penyakit Ayam</strong>
                                        <p>Untuk Mengetahui Penyakit Ayam, kami menyediakan website ini yang nantinya bisa menggunakan foto kotoran ayam untuk melakukan scanning penyakit ayam.</p>
                                    </li>
                                    <li class="mb-3">
                                        <strong>Melakukan Pendataan Untuk Efisiensi Sistem Manajemen</strong>
                                        <p>Memudahkan sistem manajemen dengan dengan menggunakan fitur pendataan yang ada di website kami. Guna mempermudah dan memberikan efisiensi pendataan dari manajemen peternakan ayam.</p>
                                    </li>
                                    <li class="mb-3">
                                        <strong>Riwayat Scanning Penyakit Ayam</strong>
                                        <p>Fitur ini dapat digunakan ketika anda ingin melihat history penyakit ayam yang sudah di scanning oleh anda.</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.guest></x-footers.guest>
        </div>
    </main>
    @push('js')
    <script src="{{ asset('assets') }}/js/jquery.min.js"></script>
    <script>
        $(function() {
            var text_val = $(".input-group input").val();
            if (text_val === "") {
                $(".input-group").removeClass('is-filled');
            } else {
                $(".input-group").addClass('is-filled');
            }
        });
    </script>
    @endpush
</x-layout>
