<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="data-telur"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Data Telur"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-warning shadow-warning border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3">Data Telur</h6>
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
                                                TANGGAL
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                JUMLAH
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

                                    <a rel="tooltip" class="btn btn-success btn-link ms-5" href="#" data-original-title="Tambah Kandang" data-bs-toggle="modal" data-bs-target="#telurModal">
                                        <div class="ripple-container ">Tambah telur</div>
                                    </a>

                                    <tbody>
                                        @if(isset($isEmpty) && $isEmpty)
                                            <tr class="align-middle text-center text-sm">
                                                <td colspan="5" class="">Tidak ada data tersedia saat ini.</td>
                                            </tr>
                                        @else
                                        @foreach ($getAlldataTelur as $telur )
                                        <tr>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-secondary text-xs font-weight-bold">
                                                    {{ $loop->iteration }}
                                                </p>
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                <p class="text-secondary text-xs font-weight-bold">
                                                    {{ $telur->created_at }}
                                                </p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-secondary text-xs font-weight-bold">
                                                    {{ $telur->stok_telur }} Kg
                                                </p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a rel="tooltip" class="btn btn-success btn-link" href="#" data-original-title="Edit" data-bs-toggle="modal" data-bs-target="#editStokModal{{ $telur->id }}">
                                                    <!-- <i class="material-icons">edit</i> -->
                                                    <div class="ripple-container">Ubah Data</div>
                                                </a>
                                                <!-- <form action="{{ route('data-telur.hapus-stok', ['id' => $telur->id]) }}" id="hapus-form" method="POST" style="display: inline;" >
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-link" data-original-title="Hapus">
                                                        <div class="ripple-container">Hapus</div>
                                                    </button>
                                                </form> -->
                                            </td>
                                            
                                        </tr>

<div class="modal fade" id="editStokModal{{ $telur->id }}" tabindex="-1" aria-labelledby="editStokModalLabel{{ $telur->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStokModalLabel{{ $telur->id }}">Edit </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('data-telur.update', ['id' => $telur->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="stok_telur" class="form-label">Stok telur</label>
                        <input value="{{ $telur->stok_telur }}" type="number" class="form-control" id="stok_telur" name="stok_telur" required pattern="\d*" title="Please enter a valid number">
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

<div class="modal fade" id="telurModal" tabindex="-1" aria-labelledby="telurModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="telurModalLabel">Tambah Kandang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('data-telur.tambah-telur') }}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="stok_telur" class="form-label">Stok Telur</label>
                        <input type="number" class="form-control" id="stok_telur" name="stok_telur" required pattern="\d*" title="Please enter a valid number">
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
