@extends('master.NavbarGuru')
@section('title', 'Yuk Absen | Dashboard Superadmin')
@section('content')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="container">
                    <h1>Bukti Absen</h1>
                    <img src="{{ asset('storage/' . $absensi->foto_absen) }}" style="width: 450px; height: 450px;"
                        alt="Bukti">
                </div>
            </div>
        </div>
    @endsection
