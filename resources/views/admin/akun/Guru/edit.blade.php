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
                            <form method="POST" action="{{ route('guru-akun.update', $user->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <img id="avatar-preview" class="avatar avatar-xl" name="foto_profil"
                                            src="{{ asset('storage/foto-profil/' . $user->profil) }}">
                                    </div>
                                    <div class="col-auto">
                                        <label for="avatar">
                                            <button type="button" class="btn btn-primary"
                                                onclick="openFileExplorer()">Ganti Foto Profil</button>
                                        </label>
                                        <input type="file" id="avatar" class="form-control d-none" name="foto-profil">
                                    </div>
                                </div>

                                <h3 class="card-title mt-4">Biodata</h3>
                                <div class="row g-3">
                                    <div class="col-md">
                                        <div class="form-label">Nama Lengkap</div>
                                        <input type="text" class="form-control" name="nama"
                                            value="{{ old('nama', $user->nama) }}">
                                        @error('nama')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md">
                                        <div class="form-label">NIP</div>
                                        <input type="text" class="form-control" name="NIP"
                                            value="{{ old('NIP', $user->NIP) }}">
                                        @error('NIP')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md">
                                        <div class="form-label">No. Handphone</div>
                                        <input type="text" class="form-control" name="HP"
                                            value="{{ old('HP', $user->HP) }}">
                                        @error('HP')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <h3 class="card-title mt-4">Email</h3>
                                <p class="card-subtitle">This contact will be shown to others publicly, so choose it
                                    carefully.</p>
                                <div>
                                    <div class="row g-2">
                                        <div class="col-auto">
                                            <input type="text" class="form-control w-auto" name="email"
                                                value="{{ old('email', $user->email) }}">
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
                <div class="card-footer bg-transparent mt-auto">
                    <div class="btn-list justify-content-end">
                        <a href="{{ route('guru-akun.index') }}" class="btn">
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>

    <script>
        document.getElementById('avatar').addEventListener('change', function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = document.getElementById('avatar-preview');
                    img.src = e.target.result;
                    img.style.display = 'block';
                };
                reader.readAsDataURL(this.files[0]);
            }
        });

        function openFileExplorer() {
            console.log('Button clicked!'); // For debugging
            document.getElementById('avatar').click();
        }
    </script>

@endsection
