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
                        Form Tambah Lokasi PKL
                    </h2>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Lokasi</h4>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card-body">

                        <form action="{{ route('lokasi.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row row-cols-2">
                                <div class="col">
                                    <label>Nama lokasi</label>
                                    <input type="text" class="form-control" name="nama">
                                </div>

                                <div class="col">
                                    <label>Alamat lokasi</label>
                                    <input type="text" class="form-control" name="alamat">
                                </div>
                                <div class="col">
                                    <label>guru pembimbing</label>
                                    <input type="text" class="form-control" name="guru">
                                </div>
                                <div class="col">
                                    <label>Latitude</label>
                                    <input type="text" class="form-control" name="latitude">
                                </div>
                                <div class="col">
                                    <label>longitude</label>
                                    <input type="text" class="form-control" name="longitude">
                                </div>
                                <div class="col">
                                    <label>radius</label>
                                    <input type="text" class="form-control" name="radius">
                                </div>
                                <div class="col">
                                    <label>jam Masuk</label>
                                    <input type="time" class="form-control" name="jam">
                                </div>
                                <div class="col">
                                    <label>jam Masuk</label>
                                    <select class="form-control" name="zona">
                                        <option value="Asia/Jakarta">WIB</option>
                                        <option value="Asia/Makassar">WITA</option>
                                        <option value="Asia/Jayapura">WIT</option>
                                    </select>
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
@endsection
