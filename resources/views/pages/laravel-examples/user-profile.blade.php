<x-layout bodyClass="g-sidenav-show bg-gray-200">

    <x-navbars.sidebar activePage="user-profile"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='User Profile'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <!-- <div class="page-header min-height-300 border-radius-xl mt-4"
                style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
                <span class="mask  bg-gradient-primary  opacity-6"></span>
            </div> -->
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

                </div>
                
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h6 class="mb-3">Ubah Profile</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        @if (session('status'))
                        <div class="row">
                            <div class="alert alert-success alert-dismissible text-white" role="alert">
                                <span class="text-sm">{{ Session::get('status') }}</span>
                                <button type="button" class="btn-close text-lg py-3 opacity-10"
                                    data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        @endif
                        @if (Session::has('demo'))
                                <div class="row">
                                    <div class="alert alert-danger alert-dismissible text-white" role="alert">
                                        <span class="text-sm">{{ Session::get('demo') }}</span>
                                        <button type="button" class="btn-close text-lg py-3 opacity-10"
                                            data-bs-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                                @endif
                                
                        <!-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif -->
                        
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Password</label>
                                <!-- <a class="form-control border border-2 p-2"  href="">Change Password</a> -->
                                <button type="button" class="btn btn-primary form-control border border-2 p-2" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                    Change Password
                                </button>
                            </div>
                            
                            <form method='POST' action='{{ route('user-profile.update') }}' enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                <div class="mb-3 col-md-6 ">
                                    <label for="image">Foto Profil</label>
                                    <input type="file" name="image" id="image">
                                </div>
                                <div class="mb-3 col-md-6 ">
                                    <label class="form-label">Email address</label>
                                    <input type="email" name="email" class="form-control border border-2 p-2" value='{{ old('email', auth()->user()->email) }}' readonly>
                                    @error('email')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                            
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Username</label>
                                    <input type="text" name="username" class="form-control border border-2 p-2" value='{{ old('username', auth()->user()->username) }}'>
                                    @error('username')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Nomor HandPhone</label>
                                    <input type="number" name="no_hp" class="form-control border border-2 p-2" value='{{ old('no_hp', auth()->user()->no_hp) }}'>
                                    @error('no_hp') 
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                

                                <div class="form-group">
                                    <label for="provinsi_id">Provinsi</label>
                                    <select class="form-control" id="provinsi_id" name="provinsi_id">
                                        <option value="">Pilih Provinsi</option>
                                        @foreach($provinsis as $provinsi)
                                            <option value="{{ $provinsi->id }}" {{ $provinsi->id == old('provinsi_id', auth()->user()->provinsi_id) ? 'selected' : '' }}>{{ $provinsi->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kabupaten_id">Kabupaten</label>
                                    <select class="form-control" id="kabupaten_id" name="kabupaten_id">
                                        <option value="">Pilih Kabupaten</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kecamatan_id">Kecamatan</label>
                                    <select class="form-control" id="kecamatan_id" name="kecamatan_id">
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="desa_id">Desa</label>
                                    <select class="form-control" id="desa_id" name="desa_id">
                                        <option value="">Pilih Desa</option>
                                    </select>
                                </div>



                            </div>
                            <button type="submit" class="btn bg-gradient-dark">Simpan</button>
                            <a href="{{ route('profile') }}" class="btn bg-gradient-dark">Kembali</a>
                        </form>

                    </div>
                    </div>
                </div>
            </div>



                <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <form method="POST" action="{{route('user-profile.changePassword') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="current_password" class="form-label">Password Saat Ini</label>
                                    <input id="current_password" type="password" name="current_password" required class="form-control">
                                    @error('current_password') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password Baru</label>
                                    <input id="password" type="password" name="password" required class="form-control">
                                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                                    <input id="password_confirmation" type="password" name="password_confirmation" required class="form-control">
                                </div>

                                <button type="submit" class="btn btn-primary">Ubah Password</button>
                            </form>

                            </div>
                        </div>
                    </div>
                </div>


        </div>
        <x-footers.auth></x-footers.auth>
    </div>
    <x-plugins></x-plugins>

</x-layout>

<script>
    $(document).ready(function() {
        $('#provinsi_id').on('change', function() {
            var provinsiID = $(this).val();
            if(provinsiID) {
                $.ajax({
                    url: '/get-kabupatens/' + provinsiID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        console.log(data);
                        $('#kabupaten_id').empty();
                        $('#kabupaten_id').append('<option value="">Pilih kabupaten</option>');
                        $.each(data, function(key, value) {
                            $('#kabupaten_id').append('<option value="'+ key +'">'+ value.nama +'</option>');
                        });
                    }
                });
            } else {
                $('#kabupaten_id').empty();
                $('#kabupaten_id').append('<option value="">Pilih kabupaten0</option>');
            }
        });

        $('#kabupaten_id').on('change', function() {
            var kabupatenID = $(this).val();
            if(kabupatenID) {
                $.ajax({
                    url: '/get-kecamatans/' + kabupatenID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        console.log(data);
                        $('#kecamatan_id').empty();
                        $('#kecamatan_id').append('<option value="">Pilih kecamatan</option>');
                        $.each(data, function(key, value) {
                            $('#kecamatan_id').append('<option value="'+ key +'">'+ value.nama +'</option>');
                        });
                    }
                });
            } else {
                $('#kecamatan_id').empty();
                $('#kecamatan_id').append('<option value="">Pilih 0kecamatan</option>');
            }
        });

        $('#kecamatan_id').on('change', function() {
            var kecamatanID = $(this).val();
            if(kecamatanID) {
                $.ajax({
                    url: '/get-desas/' + kecamatanID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        console.log(data);
                        $('#desa_id').empty();
                        $('#desa_id').append('<option value="">Pilih Desa</option>');
                        $.each(data, function(key, value) {
                            $('#desa_id').append('<option value="'+ key +'">'+ value.nama +'</option>');
                        });
                    }
                });
            } else {
                $('#desa_id').empty();
                $('#desa_id').append('<option value="">Pilih Desa</option>');
            }
        });
    });
</script>