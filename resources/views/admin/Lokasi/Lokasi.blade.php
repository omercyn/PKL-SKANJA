@extends('master.navbarAdmin')
@section('title', 'Yuk Absen | Dashboard Superadmin')
@section('content')

    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <h2 class="page-title">
                            Data lokasi PKL
                        </h2>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="{{ route('lokasi.create') }}">
                                <button type="button" class="btn btn-primary">
                                    Tambah Data
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">
                    <div class="col-12">
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Tabel Lokasi PKL</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap datatable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama Lokasi</th>
                                            <th class="text-center">Alamat Lokasi</th>
                                            <th class="text-center">Nama Pembimbing</th>
                                            <th class="text-center">Latitude</th>
                                            <th class="text-center">Longitude</th>
                                            <th class="text-center">Radius</th>
                                            <th class="text-center">Jam Masuk</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lokasi as $item)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $item->nama_lokasi }}</td>
                                                <td class="text-center">{{ $item->alamat_lokasi }}</td>
                                                <td class="text-center">{{ $item->guru_pembimbing }}</td>
                                                <td class="text-center">{{ $item->latitude }}</td>
                                                <td class="text-center">{{ $item->longitude }}</td>
                                                <td class="text-center">{{ $item->radius }}
                                                    <span>Meter</span>
                                                </td>
                                                <td class="text-center">
                                                    @if ($item->zona_waktu == 'Asia/Jakarta')
                                                        {{ $item->jam_masuk }} WIB
                                                    @elseif ($item->zona_waktu == 'Asia/Makassar')
                                                        {{ $item->jam_masuk }} WITA
                                                    @elseif ($item->zona_waktu == 'Asia/Jayapura')
                                                        {{ $item->jam_masuk }} WIT
                                                    @else
                                                        {{ $item->jam_masuk }}
                                                    @endif
                                                </td>

                                                <td>
                                                    <form method="POST" action="{{ route('lokasi.destroy', $item->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" onclick="swalDeleteConfirmation(this.form);">
                                                            Hapus Akun
                                                        </button>
                                                    </form>
                                                    <a href="{{ route('lokasi.edit', $item->id) }}">
                                                        <button type="button">Edit</button>
                                                    </a>
                                                    <a href="{{ route('lokasi.show', $item->id) }}">
                                                        <button type="button">Detail</button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>

    <script>
        function swalDeleteConfirmation(form) {
            return Swal.fire({
                title: "Hapus Lokasi PKL?",
                text: "Anda yakin ingin menghapus lokasi ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form directly
                    form.submit();
                } else {
                    return false;
                }
            });
        }
    </script>
@endsection
