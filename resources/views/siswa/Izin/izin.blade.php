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
    @endphp
    <style>
        .container {
            position: relative;
            overflow: text;
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
            <h1 class="text-center">Form Izin</h1>

            <form action="{{ route('Izinn.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row row-cols-2">
                    <div class="col">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" value="{{ Auth::user()->nama }}" readonly>
                    </div>
                    <div class="col">
                        <label>Kelas</label>
                        <input type="text" class="form-control" name="kelas" value="{{ Auth::user()->kelas }}"
                            readonly>
                    </div>
                    <div class="col">
                        <label>NISN</label>
                        <input type="text" class="form-control" name="NISN" value="{{ Auth::user()->NISN }}" readonly>
                    </div>
                    <div class="col">
                        <label>Keterangan</label>
                        <select name="keterangan" class="form-select" aria-label="Default select example">
                            <option selected>Pilih keterangan</option>
                            <option value="izin">Izin</option>
                            <option value="sakit">Sakit</option>
                            <option value="Dispensasi">Dispensasi</option>
                        </select>
                    </div>
                    <div class="col">
                        <label class="font-weight-bold">Bukti</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="bukti">
                    </div>
                    <div class="col">
                        <input type="hidden" name="tanggal" value="{{ request()->input('tanggal') }}">
                        <input type="hidden" id="guruPembimbing" name="guru" class="form-control"
                            value="{{ $guruPembimbing ?? 'Tidak ada guru pembimbing yang tersedia' }}">
                    </div>
                    <div class="col">
                        <input type="hidden" name="latitude" id="latitude">
                    </div>
                    <div class="col">
                        <input type="hidden" name="longitude" id="longitude">
                    </div>

                    <input type="hidden" name="jam" value="{{ request()->input('jam') }}">
                    <br>
                    <div class="col-xs-12 col-sm-12 col-md-12 mt-5 text-center">
                        <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                        <a href="{{ route('siswa') }}">
                            <button class="btn btn-md btn-warning">KEMBALI</button>
                        </a>
                    </div>
            </form>
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
    </script>
@endsection
