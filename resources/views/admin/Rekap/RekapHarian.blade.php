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
                            Data Absensi Harian
                        </h2>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <form action="{{ route('filter.rekap') }}" method="GET">
                                <label for="kelas">Filter berdasarkan Kelas:</label>
                                <select name="kelas" id="filter">
                                    <option value="Semua">Semua Kelas</option>
                                    @foreach ($kelass as $kelas)
                                        <option value="{{ $kelas->kelas }}">{{ $kelas->kelas }}</option>
                                    @endforeach
                                </select>
                                <button type="submit">Filter</button>
                            </form>
                            <form action="{{ url('export') }}" method="GET">
                                <select name="type">
                                    <option value="Semua">Pilih Tipe File</option>
                                    <option value="xlsx">.xlsx</option>
                                    <option value="csv">.csv</option>
                                    <option value="xls">.xls</option>
                                </select>
                                <!-- Tambahkan input hidden untuk mengirimkan filter kelas -->
                                <input type="hidden" name="kelas" value="{{ request('kelas') }}">
                                <button class="btn btn-success" type="submit">Export</button>
                            </form>
                            <a href="{{ route('export.pdf', ['kelas' => request('kelas')]) }}" class="btn btn-danger">Export
                                PDF</a>
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
                                <h3 class="card-title">Tabel Absensi PKL</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap datatable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama Siswa</th>
                                            <th class="text-center">NISN Siswa</th>
                                            <th class="text-center">Kelas</th>
                                            <th class="text-center">Tanggal</th>
                                            <th class="text-center">Jam</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Bukti</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($filter as $item)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $item->nama }}</td>
                                                <td class="text-center">{{ $item->NISN }}</td>
                                                <td class="text-center">{{ $item->kelas }}</td>
                                                <td class="text-center">{{ $item->tanggal }}</td>
                                                <td class="text-center">{{ $item->jam }}</td>
                                                <td class="text-center">
                                                    @if ($item->status == 'Absen')
                                                        <span class="badge badge-light">Absen Belum Terkonfirmasi</span>
                                                    @elseif ($item->status == 'Absen Terkonfirmasi')
                                                        <span class="badge bg-green">Absen Terkonfirmasi</span>
                                                    @elseif ($item->status == 'Izin')
                                                        <span class="badge badge-light">Izin Belum Terkonfirmasi</span>
                                                    @elseif ($item->status == 'Izin Terkonfirmasi')
                                                        <span class="badge bg-orange">Absen Terkonfirmasi</span>
                                                    @else
                                                        <span class="badge bg-red">Tidak Hadir</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($item->foto_absen)
                                                        <img src="{{ asset('storage/bukti/' . $item->foto_absen) }}"
                                                            style="width: 45px; height: 45px;" alt="Bukti">
                                                    @else
                                                        Tidak ada bukti
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    {{ $filter->onEachSide(1)->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
