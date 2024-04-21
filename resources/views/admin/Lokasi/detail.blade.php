@extends('master.navbarAdmin')
@section('title', 'Yuk Absen | Dashboard Superadmin')
@section('content')

    <div class="page-header d-print-none">
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="row g-0">
                    <div class="col d-flex flex-column">
                        <div class="card-body">
                            <h2 class="mb-4">Data Lokasi PKL</h2>
                            <h3 class="card-title">Detail Lokasi</h3>
                            <h3 class="card-title mt-4">Biodata</h3>
                            <div class="row g-3">
                                <div class="col-md">
                                    <div class="form-label">Nama </div>
                                    <div>{{ $lokasi->nama_lokasi }}</div>
                                </div>
                                <div class="col-md">
                                    <div class="form-label">Alamat lokasi</div>
                                    <div class="mt-1 small text-muted">{{ $lokasi->alamat_lokasi }}</div>
                                </div>
                                <div class="col-md">
                                    <div class="form-label">guru_pembimbing</div>
                                    <div class="mt-1 small text-muted">{{ $lokasi->guru_pembimbing }}</div>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md">
                                    <div class="form-label">latitude</div>
                                    <div>{{ $lokasi->latitude }}</div>
                                </div>
                                <div class="col-md">
                                    <div class="form-label">longitude </div>
                                    <div class="mt-1 small text-muted">{{ $lokasi->longitude }}</div>
                                </div>
                                <div class="col-md">
                                    <div class="form-label">radius</div>
                                    <div class="mt-1 small text-muted">{{ $lokasi->radius }} <span>Meter</span></div>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md">
                                    <div class="form-label">Jam Masuk</div>
                                    <div>{{ $lokasi->jam_masuk }}</div>
                                </div>
                                <div class="col-md">
                                    <div class="form-label">Zona Waktu </div>
                                    <div class="mt-1 small text-muted">
                                        @if ($lokasi->zona_waktu == 'Asia/Jakarta')
                                            WIB
                                        @elseif ($lokasi->zona_waktu == 'Asia/Makassar')
                                            WITA
                                        @elseif ($lokasi->zona_waktu == 'Asia/Jayapura')
                                            WIT
                                        @else
                                            Tidak ada Data
                                        @endif
                                    </div>
                                </div>
                            </div>


                            {{-- <h3 class="card-title mt-4">Password</h3>
                                <input type="password" class="form-control w-auto" name="password"
                                    value="{{ old('password') }}">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div>
                                    <a href="#" class="btn disabled">Set new password (Coming Soon)</a>
                                </div> --}}

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
