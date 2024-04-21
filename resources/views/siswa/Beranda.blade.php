@extends('master.navbarSiswa')

@section('title', 'Yuk Absen | Dashboard Superadmin')

@section('content')

    @php
        use App\Models\LokasiPresensi;

        $user = Auth::user();
        $namaLokasi = $user->lokasi_presensi;

        // Temukan lokasi presensi berdasarkan nama_lokasi
        $lokasiPresensi = LokasiPresensi::where('nama_lokasi', $namaLokasi)->first();

        $zonaWaktu = $lokasiPresensi->zona_waktu;
        date_default_timezone_set($zonaWaktu);

    @endphp


    @php
        use App\Models\Absensi;

        $user = Auth::user();
        $namaLokasi = $user->lokasi_presensi;

        // Temukan lokasi presensi berdasarkan nama_lokasi
        $lokasiPresensi = LokasiPresensi::where('nama_lokasi', $namaLokasi)->first();

        $zonaWaktu = $lokasiPresensi->zona_waktu;
        date_default_timezone_set($zonaWaktu);

        // Periksa apakah sudah absen hari ini
        $absensi = Absensi::where('NISN', Auth::user()->NISN)
            ->where('tanggal', date('d F Y'))
            ->first();
    @endphp

    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <div class="card hidden-center">
                        <div class="card-header hidden-center">Presensi</div>
                        <div class="card-body">
                            <div class="parent-date">
                                <div class="ms-4" id="tanggal"></div>
                                <div class="ms-4" id="bulan"></div>
                                <div class="ms-4" id="tahun"></div>
                            </div>

                            <div class="parent-clock">
                                <div id="jam"></div>
                                <div>:</div>
                                <div id="menit"></div>
                                <div>:</div>
                                <div id="detik"></div>
                            </div>
                            @if ($lokasiPresensi)
                                @if ($absensi)
                                    @if ($absensi->status == 'absen')
                                        <button type="button" class="btn btn-warning mt-4" disabled>Anda Sudah
                                            Absen</button>
                                    @elseif ($absensi->status == 'izin')
                                        <button type="button" class="btn btn-warning mt-4" disabled>Anda Sudah
                                            Izin</button>
                                    @elseif ($absensi->status == 'Absen Terkonfirmasi')
                                        <button type="button" class="btn btn-warning mt-4" disabled>Anda Sudah
                                            Absen</button>
                                    @elseif ($absensi->status == 'Izin Terkonfirmasi')
                                        <button type="button" class="btn btn-warning mt-4" disabled>Anda Sudah
                                            Izin</button>
                                    @else
                                        <form class="text-center " action="{{ route('absen') }}" method="get">
                                            @csrf
                                            <!-- Input untuk latitude dan longitude siswa -->
                                            <input type="hidden" id="latitude_siswa1" name="latitude-siswa">
                                            <input type="hidden" id="longitude_siswa1" name="longitude-siswa">
                                            <!-- Input untuk latitude dan longitude PKL -->
                                            <input type="hidden" name="latitude-PKL"
                                                value="{{ $lokasiPresensi->latitude }}">
                                            <input type="hidden" name="longitude-PKL"
                                                value="{{ $lokasiPresensi->longitude }}">
                                            <input type="hidden" name="radius-PKL" value="{{ $lokasiPresensi->radius }}">
                                            <input type="hidden" name="zonawaktu-PKL"
                                                value="{{ $lokasiPresensi->zona_waktu }}">
                                            <input type="hidden" name="tanggal" value="{{ date('d F Y') }}">
                                            <input type="hidden" name="jam" value="<?php echo date('H:i:s', strtotime($zonaWaktu)); ?>">
                                            <button type="submit" class="btn btn-primary mt-4">Absen</button>
                                        </form>
                                    @endif
                                @else
                                    <form class="text-center " action="{{ route('absen') }}" method="get">
                                        @csrf
                                        <!-- Input untuk latitude dan longitude siswa -->
                                        <input type="hidden" id="latitude_siswa2" name="latitude-siswa">
                                        <input type="hidden" id="longitude_siswa2" name="longitude-siswa">
                                        <!-- Input untuk latitude dan longitude PKL -->
                                        <input type="hidden" name="latitude-PKL" value="{{ $lokasiPresensi->latitude }}">
                                        <input type="hidden" name="longitude-PKL" value="{{ $lokasiPresensi->longitude }}">
                                        <input type="hidden" name="radius-PKL" value="{{ $lokasiPresensi->radius }}">
                                        <input type="hidden" name="zonawaktu-PKL"
                                            value="{{ $lokasiPresensi->zona_waktu }}">
                                        <input type="hidden" name="tanggal" value="{{ date('d F Y') }}">
                                        <input type="hidden" name="jam" value="<?php echo date('H:i:s', strtotime($zonaWaktu)); ?>">
                                        <button type="submit" class="btn btn-primary mt-4">Absen</button>
                                    </form>
                                @endif
                            @else
                                <p>Anda belum ditugaskan ke lokasi presensi tertentu.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="col-md-2"></div>
                    <div class="card hidden-center">
                        <div class="card-header hidden-center">Izin</div>
                        <div class="card-body">
                            <div class="parent-date">
                                <div class="ms-4" id="tanggal-izin"></div>
                                <div class="ms-4" id="bulan-izin"></div>
                                <div class="ms-4" id="tahun-izin"></div>
                            </div>

                            <div class="parent-clock">
                                <div id="jam-izin"></div>
                                <div>:</div>
                                <div id="menit-izin"></div>
                                <div>:</div>
                                <div id="detik-izin"></div>
                            </div>
                            @if ($absensi)
                                @if ($absensi->status == 'masuk')
                                    <button type="button" class="btn btn-warning mt-4" disabled>Anda Sudah Absen</button>
                                @elseif ($absensi->status == 'izin')
                                    <button type="button" class="btn btn-warning mt-4" disabled>Anda Sudah Izin</button>
                                @else
                                    <form class="text-center" action="{{ route('izin') }}" method="get">
                                        @csrf
                                        <!-- Input untuk latitude dan longitude siswa -->
                                        <input type="hidden" id="latitude_siswa3" name="latitude-siswa">
                                        <input type="hidden" id="longitude_siswa3" name="longitude-siswa">
                                        <!-- Input untuk latitude dan longitude PKL -->
                                        <input type="hidden" name="latitude-PKL"
                                            value="{{ $lokasiPresensi->latitude }}">
                                        <input type="hidden" name="longitude-PKL"
                                            value="{{ $lokasiPresensi->longitude }}">
                                        <input type="hidden" name="radius-PKL" value="{{ $lokasiPresensi->radius }}">
                                        <input type="hidden" name="zonawaktu-PKL"
                                            value="{{ $lokasiPresensi->zona_waktu }}">
                                        <input type="hidden" name="tanggal" value="{{ date('d F Y') }}">
                                        <input type="hidden" name="jam" value="<?php echo date('H:i:s', strtotime($zonaWaktu)); ?>">
                                        <button type="submit" class="btn btn-warning mt-4">Izin</button>
                                    </form>
                                @endif
                            @else
                                <form class="text-center" action="{{ route('izin') }}" method="get">
                                    @csrf
                                    <!-- Input untuk latitude dan longitude siswa -->
                                    <input type="hidden" id="latitude_siswa4" name="latitude-siswa">
                                    <input type="hidden" id="longitude_siswa4" name="longitude-siswa">
                                    <!-- Input untuk latitude dan longitude PKL -->
                                    <input type="hidden" name="latitude-PKL" value="{{ $lokasiPresensi->latitude }}">
                                    <input type="hidden" name="longitude-PKL" value="{{ $lokasiPresensi->longitude }}">
                                    <input type="hidden" name="radius-PKL" value="{{ $lokasiPresensi->radius }}">
                                    <input type="hidden" name="zonawaktu-PKL"
                                        value="{{ $lokasiPresensi->zona_waktu }}">
                                    <input type="hidden" name="tanggal" value="{{ date('d F Y') }}">
                                    <input type="hidden" name="jam" value="<?php echo date('H:i:s', strtotime($zonaWaktu)); ?>">
                                    <button type="submit" class="btn btn-warning mt-4">Izin</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>


    <script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;

                    var latitudeElement1 = document.getElementById('latitude_siswa1');
                    var longitudeElement1 = document.getElementById('longitude_siswa1');
                    if (latitudeElement1 && longitudeElement1) {
                        latitudeElement1.value = latitude;
                        longitudeElement1.value = longitude;
                    }
                    var latitudeElement2 = document.getElementById('latitude_siswa2');
                    var longitudeElement2 = document.getElementById('longitude_siswa2');
                    if (latitudeElement2 && longitudeElement2) {
                        latitudeElement2.value = latitude;
                        longitudeElement2.value = longitude;
                    }

                    var latitudeElement3 = document.getElementById('latitude_siswa3');
                    var longitudeElement3 = document.getElementById('longitude_siswa3');
                    if (latitudeElement3 && longitudeElement3) {
                        latitudeElement3.value = latitude;
                        longitudeElement3.value = longitude;
                    }

                    var latitudeElement4 = document.getElementById('latitude_siswa4');
                    var longitudeElement4 = document.getElementById('longitude_siswa4');
                    if (latitudeElement4 && longitudeElement4) {
                        latitudeElement4.value = latitude;
                        longitudeElement4.value = longitude;
                    }
                });
            } else {
                console.log("Geolocation is not supported by this browser.");
            }
        }

        // Menjalankan getLocation saat DOM dimuat
        document.addEventListener("DOMContentLoaded", function() {
            getLocation();
        });
    </script>
    <script>
        window.setTimeout("waktuMasuk()", 1000);

        namaBulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
            "November", "Desember"
        ]

        function waktuMasuk() {
            const waktu = new Date();
            setTimeout("waktuMasuk()", 1000);

            document.getElementById("tanggal").innerHTML = waktu.getDate();
            document.getElementById("bulan").innerHTML = namaBulan[waktu.getMonth()];
            document.getElementById("tahun").innerHTML = waktu.getFullYear();
            document.getElementById("jam").innerHTML = waktu.getHours();
            document.getElementById("menit").innerHTML = waktu.getMinutes();
            document.getElementById("detik").innerHTML = waktu.getSeconds();

            document.getElementById("tanggal-izin").innerHTML = waktu.getDate();
            document.getElementById("bulan-izin").innerHTML = namaBulan[waktu.getMonth()];
            document.getElementById("tahun-izin").innerHTML = waktu.getFullYear();
            document.getElementById("jam-izin").innerHTML = waktu.getHours();
            document.getElementById("menit-izin").innerHTML = waktu.getMinutes();
            document.getElementById("detik-izin").innerHTML = waktu.getSeconds();
        }
    </script>

@endsection
