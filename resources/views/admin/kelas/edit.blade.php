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
                            <form method="POST" action="{{ route('kelas.update', $kelas->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <img id="avatar-preview" class="avatar avatar-xl" name="foto_kelas"
                                            src="{{ asset('storage/foto-kelas/' . $kelas->profil) }}">
                                    </div>
                                    <div class="col-auto">
                                        <label for="avatar">
                                            <button type="button" class="btn btn-primary"
                                                onclick="openFileExplorer()">Ganti Foto Profil</button>
                                        </label>
                                        <input type="file" id="avatar" class="form-control d-none" name="foto-kelas">
                                    </div>
                                </div>

                                <h3 class="card-title mt-4">Biodata</h3>
                                <div class="row g-3">
                                    <div class="col-md">
                                        <div class="form-label">Nama Kelas</div>
                                        <input type="text" class="form-control" name="kelas"
                                            value="{{ old('kelas', $kelas->kelas) }}">
                                        @error('kelas')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md">
                                        <div class="form-label">Nama Wali Kelas</div>
                                        <input type="text" class="form-control" name="wali_kelas"
                                            value="{{ old('wali_kelas', $kelas->wali_kelas) }}">
                                        @error('wali_kelas')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md">
                                        <div class="form-label">NIP</div>
                                        <input type="text" class="form-control" name="NIP"
                                            value="{{ old('NIP', $kelas->NIP) }}">
                                        @error('NIP')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
                        <a href="{{ route('admin-akun.index') }}" class="btn">
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
