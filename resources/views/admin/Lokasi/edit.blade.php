@extends('master.navbarAdmin')
@section('title', 'Yuk Absen | Dashboard Superadmin')
@section('content')

    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="col d-flex flex-column">
                    <div class="card-body">
                        <h2 class="mb-4">Data Lokasi PKL</h2>
                        <form method="POST" action="{{ route('lokasi.update', $lokasi->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <h3 class="card-title mt-4">Biodata</h3>
                            <div class="row g-3">
                                <div class="col-md">
                                    <div class="form-label">Nama Lokasi</div>
                                    <input type="text" class="form-control" name="nama_lokasi"
                                        value="{{ old('nama_lokasi', $lokasi->nama_lokasi) }}">
                                </div>
                                <div class="col-md">
                                    <div class="form-label">Alamat Lokasi </div>
                                    <input type="text" class="form-control" name="alamat_lokasi"
                                        value="{{ old('alamat_lokasi', $lokasi->alamat_lokasi) }}">
                                </div>
                                <div class="col-md">
                                    <div class="form-label">Guru Pembimbing</div>
                                    <input type="text" class="form-control" name="guru_pembimbing"
                                        value="{{ old('guru_pembimbing', $lokasi->guru_pembimbing) }}">
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md">
                                    <h3 class="card-title mt-4">Latitude</h3>
                                    <input type="text" class="form-control" name="latitude"
                                        value="{{ old('latitude', $lokasi->latitude) }}">
                                </div>
                                <div class="col-md">
                                    <h3 class="card-title mt-4">longitude</h3>
                                    <input type="text" class="form-control" name="longitude"
                                        value="{{ old('longitude', $lokasi->longitude) }}">
                                </div>
                                <div class="col-md">
                                    <h3 class="card-title mt-4">Radius</h3>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="radius"
                                            value="{{ old('radius', $lokasi->radius) }}">
                                        <span class="input-group-text">meter</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md">
                                    <h3 class="card-title mt-4">Jam Masuk</h3>
                                    <input id="jam_masuk_input" type="time" class="form-control" name="jam_masuk"
                                        value="{{ old('jam_masuk', $lokasi->jam_masuk) }}">
                                </div>
                                <div class="col-md">
                                    <h3 class="card-title mt-4">Zona Waktu</h3>
                                    <select id="zona_waktu_select" class="form-control" name="zona_waktu">
                                        <option value="Asia/Jakarta"
                                            {{ old('zona_waktu', $lokasi->zona_waktu) == 'Asia/Jakarta' ? 'selected' : '' }}>
                                            WIB</option>
                                        <option value="Asia/Makassar"
                                            {{ old('zona_waktu', $lokasi->zona_waktu) == 'Asia/Makassar' ? 'selected' : '' }}>
                                            WITA</option>
                                        <option value="Asia/Jayapura"
                                            {{ old('zona_waktu', $lokasi->zona_waktu) == 'Asia/Jayapura' ? 'selected' : '' }}>
                                            WIT</option>
                                    </select>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent mt-5">
                <div class="btn-list justify-content-end">
                    <a href="{{ route('lokasi.index') }}" class="btn">
                        Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </div>
            </form>
        </div>
    </div>

@endsection
