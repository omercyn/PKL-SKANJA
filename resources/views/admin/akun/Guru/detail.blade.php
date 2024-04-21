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
                            <h2 class="mb-4">Data Akun</h2>
                            <h3 class="card-title">Detail Profil</h3>
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <img id="avatar-preview" class="rounded img-fluid" style="width: 60%; margin: 0 auto;"
                                        src="{{ asset('storage/foto-profil/' . $user->profil) }}">
                                </div>
                            </div>

                            <h3 class="card-title mt-4">Biodata</h3>
                            <div class="row g-3">
                                <div class="col-md">
                                    <div class="form-label">Nama Lengkap</div>
                                    <div>{{ $user->nama }}</div>
                                </div>
                                <div class="col-md">
                                    <div class="form-label">NIP</div>
                                    <div class="mt-1 small text-muted">{{ $user->NIP }}</div>
                                </div>
                                <div class="col-md">
                                    <div class="form-label">No. Handphone</div>
                                    <div class="mt-1 small text-muted">{{ $user->HP }}</div>
                                </div>
                            </div>

                            <h3 class="card-title mt-4">Email</h3>
                            <div>
                                <div class="row g-2">
                                    <div class="col-auto">
                                        <div class="mt-1 ">{{ $user->email }}</div>
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
