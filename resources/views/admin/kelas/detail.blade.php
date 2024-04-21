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
                            <h2 class="mb-4">Data Kelas</h2>
                            <h3 class="card-title">Detail Profil Kelas</h3>
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <img id="avatar-preview" class="rounded img-fluid" style="width: 60%; margin: 0 auto;"
                                        src="{{ asset('storage/foto-kelas/' . $kelas->profil) }}">
                                </div>
                            </div>

                            <h3 class="card-title mt-4">Biodata</h3>
                            <div class="row g-3">
                                <div class="col-md">
                                    <div class="form-label">Nama Kelas</div>
                                    <div>{{ $kelas->kelas }}</div>
                                </div>
                                <div class="col-md">
                                    <div class="form-label">Wali Kelas</div>
                                    <div class="mt-1 small text-muted">{{ $kelas->wali_kelas }}</div>
                                </div>
                                <div class="col-md">
                                    <div class="form-label">NIP</div>
                                    <div class="mt-1 small text-muted">{{ $kelas->NIP }}</div>
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
