<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="data-ayam"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Data Ayam"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-warning shadow-warning border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3">Data Ayam</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                NO
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                KANDANG
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                JUMLAH
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                DIPERBARUI DALAM
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ACTION
                                            </th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>

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
                                        <a rel="tooltip" class="btn-link ms-5" href="#" data-original-title="Tambah Kandang" data-bs-toggle="modal" data-bs-target="#kandangModal">
                                            <button class="btn btn-success">Tambah</button>
                                        </a>
                                        <tbody>
                                        @if(isset($isEmpty) && $isEmpty)
                                        <tr class="align-middle text-center text-sm">
                                            <td colspan="5" class="">Tidak ada data tersedia saat ini.</td>
                                        </tr>
                                        @else
                                        @foreach ($getAlldataAyam as $ayam )
                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-secondary text-xs font-weight-bold">
                                                    {{ $loop->iteration }}
                                                </p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-secondary text-xs font-weight-bold">
                                                    {{ $ayam->kandang }}
                                                </p>
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                <p class="text-secondary text-xs font-weight-bold">
                                                    {{ $ayam->stok_ayam }} ekor
                                                </p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-secondary text-xs font-weight-bold">
                                                    {{ $ayam->updated_at }}
                                                </p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a rel="tooltip" class="btn btn-outline-warning" href="#" data-original-title="Edit Stok" data-bs-toggle="modal" data-bs-target="#editStokModal{{ $ayam->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                                                    </svg>
                                                </a>
                                            </td>
                                            
                                        </tr>

                                        
<div class="modal fade" id="editStokModal{{ $ayam->id }}" tabindex="-1" aria-labelledby="editStokModalLabel{{ $ayam->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStokModalLabel{{ $ayam->id }}">Ubah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('data-ayam.update', ['id' => $ayam->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="kandang" class="form-label">Nama Kandang</label>
                        <input value="{{ $ayam->kandang }}" type="text" class="form-control" id="kandang" name="kandang" required>
                    </div>
                    <div class="mb-3">
                        <label for="stok_ayam" class="form-label">Stok</label>
                        <input value="{{ $ayam->stok_ayam }}" type="number" class="form-control" id="stok_ayam" name="stok_ayam" required pattern="\d*" title="Please enter a valid number">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>





                                        @endforeach


                                        @endif
                                </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>

        <div class="modal fade" id="kandangModal" tabindex="-1" aria-labelledby="kandangModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kandangModalLabel">Tambah Kandang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('data-ayam.tambah-kandang') }}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="kandang" class="form-label">kandang</label>
                        <input type="text" class="form-control" id="kandang" name="kandang" required>
                        @error('kandang') 
                        <p class='text-danger inputerror'>{{ $message }} </p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="stok_ayam" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="stok_ayam" name="stok_ayam" required pattern="\d*" title="Please enter a valid number">
                        @error('stok_ayam') 
                        <p class='text-danger inputerror'>{{ $message }} </p>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


    </main>
    <x-plugins></x-plugins>

</x-layout>
