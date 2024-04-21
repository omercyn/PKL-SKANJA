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
                            Data Akun Guru
                        </h2>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="{{ route('guru-akun.create') }}">
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
                                <h3 class="card-title">Tabel Akun Guru</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap datatable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">NIP</th>
                                            <th class="text-center">Hp</th>
                                            <th class="text-center">Email</th>
                                            <th colspan="text-center">Foto Profil</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user as $item)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $item->nama }}</td>
                                                <td class="text-center">{{ $item->NIP }}</td>
                                                <td class="text-center">{{ $item->HP }}</td>
                                                <td class="text-center">{{ $item->email }}</td>
                                                <td class="text-center">
                                                    @if ($item->profil)
                                                        <img src="{{ asset('storage/foto-profil/' . $item->profil) }}"
                                                            width="50">
                                                    @else
                                                        <span>Tidak ada Foto Profil</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form method="POST"
                                                        action="{{ route('guru-akun.destroy', $item->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" onclick="swalDeleteConfirmation(this.form);">
                                                            Hapus Akun
                                                        </button>
                                                    </form>
                                                    <a href="{{ route('guru-akun.edit', $item->id) }}">
                                                        <button type="button">Edit</button>
                                                    </a>
                                                    <a href="{{ route('guru-akun.show', $item->id) }}">
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
                title: "Hapus Akun?",
                text: "Anda yakin ingin menghapus akun ini?",
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
