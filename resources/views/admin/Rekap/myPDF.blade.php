<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        table {
            width: 100%;
            border-spacing: 0;
        }

        table.absen {
            font-size: 0.875rem;
        }

        table.absen tr {
            background-color: rgb(96 165 250);
        }

        table.absen th {
            color: #ffffff;
            padding: 0.5rem;
        }

        table tr.items {
            background-color: rgb(241 245 249);
        }

        table tr.items td {
            padding: 0.5rem;
        }

        /* Gaya untuk garis kop */
        .header-line {
            border: none;
            border-top: 2px solid black;
            margin: 5px 0;
        }

        .sub-header-line {
            border: none;
            border-top: 1px solid black;
            margin: 5px 0;
        }

        /* Gaya untuk judul */
        .title {
            text-align: center;
            /* Posisikan judul di tengah */
        }
    </style>
</head>

<body>
    @php

        function hari_ini()
        {
            $hari = date('D');

            switch ($hari) {
                case 'Sun':
                    $hari_ini = 'Minggu';
                    break;

                case 'Mon':
                    $hari_ini = 'Senin';
                    break;

                case 'Tue':
                    $hari_ini = 'Selasa';
                    break;

                case 'Wed':
                    $hari_ini = 'Rabu';
                    break;

                case 'Thu':
                    $hari_ini = 'Kamis';
                    break;

                case 'Fri':
                    $hari_ini = 'Jumat';
                    break;

                case 'Sat':
                    $hari_ini = 'Sabtu';
                    break;

                default:
                    $hari_ini = 'Tidak di ketahui';
                    break;
            }

            return $hari_ini;
        }

    @endphp
    <div class="title">
        <h1>{{ $title }}</h1>
    </div>
    <hr class="header-line">
    <hr class="sub-header-line">
    <p class="">Hari : {{ hari_ini() }}</p>
    <p class="">Tanggal :{{ $date }}</p>

    @if ($absensi->count() > 0)

        <table class="absen">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NISN</th>
                    <th>Kelas</th>
                    <th>Pembimbing</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $counter = 1;
                @endphp
                @foreach ($absensi as $value)
                    <tr class="items">
                        <td>{{ $counter }}</td>
                        <td>{{ $value->nama }}</td>
                        <td>{{ $value->NISN }}</td>
                        <td>{{ $value->kelas }}</td>
                        <td>{{ $value->guru_pembimbing }}</td>
                        <td>{{ $value->tanggal }}</td>
                        <td>{{ $value->jam }}</td>
                        <td>{{ $value->status }}</td>
                    </tr>
                    @php
                        $counter++;
                    @endphp
                @endforeach
            </tbody>
        </table>
    @else
        <table class="absen">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NISN</th>
                    <th>Kelas</th>
                    <th>Pembimbing</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr class="items">
                    <td colspan="8" style="text-align: center;">Tidak ada data.</td>
                </tr>
            </tbody>
        </table>
    @endif

</body>

</html>
