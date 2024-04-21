@extends('master.navbarAdmin')
@section('title', 'Yuk Absen | Dashboard Superadmin')
@section('content')

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                    </div>
                    <h2 class="page-title">
                        Form Tambah Akun Siswa
                    </h2>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Akun</h4>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card-body">

                        <form action="{{ route('siswa-akun.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row row-cols-2">
                                <div class="col">
                                    <label>Nama SIswa</label>
                                    <input type="text" class="form-control" name="nama">
                                </div>
                                <div class="col">
                                    <label class="font-weight-bold">NISN</label>
                                    <input type="text" id="NISN" class="form-control" name="NISN"
                                        title="Hanya Angka Diizinkan">
                                </div>
                                <div class="col">
                                    <label class="font-weight-bold">Kelas</label>
                                    <input type="text" id="kelas" class="form-control" name="kelas">
                                </div>
                                <div class="col">
                                    <label>No Handphone</label>
                                    <input type="text" id="HP" class="form-control" name="hp"
                                        title="Hanya Angka Diizinkan">
                                </div>
                                <div class="col">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                                <div class="col">
                                    <label>Passowrd</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <div class="col">
                                    <label>Lokasi PKL</label>
                                    <select class="form-select" id="lokasiSelect" name="lokasi">
                                        <option value="">Pilih Lokasi PKL</option>
                                        @foreach ($lokasiPresensi as $lokasi)
                                            <option value="{{ $lokasi->nama_lokasi }}"
                                                data-guru="{{ $lokasi->guru_pembimbing }}" required>
                                                {{ $lokasi->nama_lokasi }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="text" id="guruPembimbing" class="form-control" name="guru">
                                <input type="hidden" class="form-control" name="role" value="3">
                                <div class="col">
                                    <label>Foto Profil</label>
                                    <input type="file" class="form-control mb-5" name="foto-profil">
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 mt-5 text-center">
                                    <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                                    <button type="reset" class="btn btn-md btn-warning">RESET</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>

@endsection
