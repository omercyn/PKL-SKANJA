@extends('master.navbarSiswa')

@section('title', 'Yuk Absen | Dashboard Superadmin')

@section('content')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.js"
        integrity="sha512-AQMSn1qO6KN85GOfvH6BWJk46LhlvepblftLHzAv1cdIyTWPBKHX+r+NOXVVw6+XQpeW4LJk/GTmoP48FLvblQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @php
        $latitudeSiswa = request()->input('latitude-siswa');
        $longitudeSiswa = request()->input('longitude-siswa');
        $latitudePKL = request()->input('latitude-PKL');
        $longitudePKL = request()->input('longitude-PKL');
        $radius = request()->input('radius-PKL');
        $jam = request()->input('jam');

        // Hitung perbedaan latitude dan longitude
        $deltaLatitude = $latitudeSiswa - $latitudePKL;
        $deltaLongitude = $longitudeSiswa - $longitudePKL;

        // Hitung nilai haversine
        $haversine =
            sin($deltaLatitude / 2) ** 2 + cos($latitudePKL) * cos($latitudeSiswa) * sin($deltaLongitude / 2) ** 2;

        // Hitung jarak tanpa koreksi
        $jarakTanpaKoreksi = 2 * 6371 * asin(sqrt($haversine));

        // Koreksi elipsoid
        $jarak =
            $jarakTanpaKoreksi * (1 - (3 * $haversine) / 4 + (4 * $haversine ** 2) / 21 - (16 * $haversine ** 3) / 315);

        // Koreksi ketinggian (asumsikan ketinggian sama)
        $deltaHeight = 0;
        $jarak *= sqrt(1 - $deltaHeight ** 2 / (6371 ** 2 + $deltaHeight ** 2));

        // Konversi meter ke kilometer
        $jarakTanpaKoreksiKm = $jarakTanpaKoreksi / 1000;
        $jarakKm = $jarak / 1000;
        $jarakM = $jarakKm / 1000;

        $sel = $jarakM - $radius;
    @endphp

    @if ($jarak > $radius)
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Jarak Terlalu Jauh',
                text: 'Jarak ke PKL melebihi radius {{ $sel }} kilometer.'
            }).then(() => {
                window.location.href = "{{ route('siswa') }}";
            });
        </script>
    @else
    @endif
    <style>
        .container {
            position: relative;
            overflow: hidden;
            width: 100%;
            padding-top: 56.25%;
            /* 16:9 Aspect Ratio (divide 9 by 16 = 0.5625) */
        }

        /* Then style the iframe to fit in the container div with full height and width */
        .responsive-iframe {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            width: 100%;
            height: 100%;
        }
    </style>

    <div class="page-body">
        <div class="container-xl">
            <div class="row">

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div id="map">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body text-center" style="margin: auto">

                            <form action="{{ route('absensi.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="camera" id="my_camera" style="width:320px; height:240px;">
                                </div>
                                <div class="mt-4" id="results" style="width:320px; height:240px;">
                                </div>
                                <div class="mt-4" id="my_result" class="mt-3"></div>
                                <input type="hidden" name="nama" value="{{ Auth::user()->nama }}">
                                <input type="hidden" id="guruPembimbing" name="guru" class="form-control"
                                    value="{{ $guruPembimbing ?? 'Tidak ada guru pembimbing yang tersedia' }}">
                                <input type="hidden" name="NISN" value="{{ Auth::user()->NISN }}">
                                <input type="hidden" name="kelas" value="{{ Auth::user()->kelas }}">
                                <!-- Ubah bagian ini untuk mengambil nilai dari cookie -->
                                <input type="hidden" name="longitude_absen"
                                    value="{{ request()->input('longitude-siswa') }}">
                                <input type="hidden" name="latitude_absen"
                                    value="{{ request()->input('latitude-siswa') }}">
                                <input type="hidden" name="tanggal" value="{{ request()->input('tanggal') }}">
                                <input type="hidden" name="jam" value="{{ request()->input('jam') }}">
                                <!-- Akhir perubahan -->
                                <input type="hidden" name="image" class="foto_masuk">
                                <input class="btn btn-primary text-center mt-3" type="button" value="Ambil Gambar"
                                    onClick="take_snapshot()">
                                <button class="btn btn-success text-center mt-3" type="submit">Simpan</button>
                            </form>

                            <br>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script language="JavaScript">
        // MAPS
        let map = L.map('map').setView([{{ $latitudePKL }}, {{ $longitudePKL }}], 13);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var marker = L.marker([{{ $latitudePKL }}, {{ $longitudePKL }}]).addTo(map).bindPopup("Lokasi anda saat ini")
            .openPopup();

        var circle = L.circle([{{ $latitudeSiswa }}, {{ $longitudeSiswa }}], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: 500
        }).addTo(map);

        // WEBCAM JS
        Webcam.set({
            width: 320,
            height: 240,
            dest_width: 320,
            dest_height: 240,
            image_format: 'jpeg',
            jpeg_quality: 100,
        });

        Webcam.attach('#my_camera');

        function take_snapshot() {
            Webcam.snap(function(data_uri) {
                $(".foto_masuk").val(data_uri);
                document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';

                // Setelah mengambil gambar, kirimkan data gambar ke backend
                $.ajax({
                    type: "POST",
                    url: "{{ route('absensi.store') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        image: data_uri, // Kirim data gambar dalam format base64
                        nama: "{{ Auth::user()->nama }}",
                        NISN: "{{ Auth::user()->NISN }}",
                        kelas: "{{ Auth::user()->kelas }}",
                        longitude_absen: "{{ request()->input('longitude-siswa') }}",
                        latitude_absen: "{{ request()->input('latitude-siswa') }}",
                        tanggal: "{{ request()->input('tanggal') }}",
                        jam: "{{ request()->input('jam') }}"
                    },
                    success: function(response) {
                        // Handle success response
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(xhr.responseText);
                    }
                });
            });
        }

        Swal.fire({
            title: "Jarak Terlalu Jauh",
            text: `Jarak ke PKL lebih dari ${radius} kilometer.`,
            icon: "error",
            confirmButtonText: "OK",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "/siswa";
            }
        });
    </script>
@endsection
