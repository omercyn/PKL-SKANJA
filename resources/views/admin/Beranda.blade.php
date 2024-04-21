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
                        <div class="page-pretitle">
                        </div>
                        <h2 class="page-title">
                            Dashboard Admin
                        </h2>
                    </div>
                    <!-- Page body -->
                    <div class="page-body">
                        <div class="container-xl">
                            <div class="row row-deck row-cards">
                                <div class="col-12">
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-lg-3">
                                            <div class="card card-sm">
                                                <div class="card-body">
                                                    <div class="row align-items-center">
                                                        <div class="col-auto">
                                                            <span
                                                                class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                                                <img src="{{ asset('static/illustrations/teacher.png') }}"
                                                                    alt="">
                                                            </span>
                                                        </div>
                                                        <div class="col">
                                                            <div class="font-weight-medium">
                                                                Guru Aktif
                                                            </div>
                                                            <div class="text-muted">
                                                                Jumlah Guru
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-3">
                                            <div class="card card-sm">
                                                <div class="card-body">
                                                    <div class="row align-items-center">
                                                        <div class="col-auto">
                                                            <span
                                                                class="bg-green text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                                                                <img src="{{ asset('static/illustrations/reading.png') }}"
                                                                    alt="">
                                                            </span>
                                                        </div>
                                                        <div class="col">
                                                            <div class="font-weight-medium">
                                                                Siswa Aktif
                                                            </div>
                                                            <div class="text-muted">
                                                                Jumlah Siswa Aktif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-3">
                                            <div class="card card-sm">
                                                <div class="card-body">
                                                    <div class="row align-items-center">
                                                        <div class="col-auto">
                                                            <span
                                                                class="bg-twitter text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                                                <img src="{{ asset('static/illustrations/teacher.png') }}"
                                                                    alt="">
                                                            </span>
                                                        </div>
                                                        <div class="col">
                                                            <div class="font-weight-medium">
                                                                Jumlah Guru
                                                            </div>
                                                            <div class="text-muted">
                                                                Jumlah Guru
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-3">
                                            <div class="card card-sm">
                                                <div class="card-body">
                                                    <div class="row align-items-center">
                                                        <div class="col-auto">
                                                            <span
                                                                class="bg-facebook text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                                                                <img src="{{ asset('static/illustrations/reading.png') }}"
                                                                    alt="">
                                                            </span>
                                                        </div>
                                                        <div class="col">
                                                            <div class="font-weight-medium">
                                                                Jumlah Siswa
                                                            </div>
                                                            <div class="text-muted">
                                                                Jumlah Siswa
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
                    </div>
                </div>
            </div>
        </div>

    @endsection
