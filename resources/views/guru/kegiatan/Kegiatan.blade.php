@extends('master.NavbarGuru')
@section('title', 'Yuk Absen | Dashboard Superadmin')
@section('content')

    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                    </div>
                    <h2 class="page-title">
                        Form Absensi Kegiatan Siswa PKL
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Tamabh Kegiatan</h4>
        </div>
        <div class="card-body">
            <form id="konfirmasiForm" method="POST" action="{{ route('konfirmasi') }}">
                @csrf
                <div class="row row-cols-2">
                    <div class="col">
                        <label>Kegiatan PKL</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="kegiatan" rows="5"
                            placeholder="Masukkan Description Product" required></textarea>
                    </div>
                    <div class="col">
                        <label>Tanggal</label>
                        <input type="text" class="form-control" name="tanggal" value="{{ date('d F Y') }}" required>
                        <input type="text" class="form-control" name="guru_pembimbing" value="{{ Auth::user()->nama }}"
                            required>

                    </div>
                </div>
                <div class="col">
                    <!-- Tombol "Lanjutkan" diubah menjadi submit -->
                    <button type="submit" class="btn btn-primary" id="showTableBtn" name="submit_type"
                        value="show_table">Lanjutkan</button>
                </div>

                <div class="row justify-content-center">
                    <div id="tableContainer" class="text-center" style="display: none">
                        <table class="table table-striped text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto Siswa</th>
                                    <th>Nama Siswa</th>
                                    <th>NISN</th>
                                    <th>Status</th>
                                    <th>Bukti</th>
                                    <th>Aksi</th> <!-- Kolom tambahan untuk tombol konfirmasi -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($absen as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">
                                            @if ($item->user->profil)
                                                <img style="width: 45px; height: 45px;"
                                                    src="{{ asset('storage/Foto-Profil/' . $item->user->profil) }}"
                                                    width="50">
                                            @else
                                                <span>Tidak ada Foto profil</span>
                                            @endif
                                        </td>
                                        <td class="text-center nama-siswa" onclick="selectSiswa(this)">
                                            {{ $item->nama }}
                                        </td>
                                        <td class="text-center">{{ $item->NISN }}</td>
                                        <td class="text-center">
                                            @if ($item->status === 'Absen Terkonfirmasi')
                                                <button class="badge badge-successs" disabled>Terkonfirmasi</button>
                                            @elseif ($item->status === 'Izin Terkonfirmasi')
                                                <button class="badge badge-successs" disabled>Terkonfirmasi</button>
                                            @else
                                                {{ $item->status }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->foto_absen)
                                                <img src="{{ asset('storage/' . $item->foto_absen) }}"
                                                    style="width: 45px; height: 45px;" alt="Bukti">
                                            @else
                                                Tidak ada bukti
                                            @endif
                                        </td>
                                        <td class="text-center"> <!-- Kolom tambahan untuk tombol konfirmasi -->
                                            <!-- Tombol "Konfirmasi" hanya ditampilkan jika status belum terkonfirmasi -->
                                            @if ($item->status !== 'Terkonfirmasi')
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                <input type="hidden" id="siswa_list"
                                                    name="siswa"value="{{ $item->nama }}" required>
                                                <button type="submit" form="konfirmasiForm" class="btn btn-primary"
                                                    name="submit_type" value="konfirmasi">Konfirmasi</button>
                                                <a href="{{ route('lihat_bukti', $item->id) }}"
                                                    class="btn btn-primary">Lihat
                                                    Bukti</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
            </form>
        </div>
    </div>
    </div>
    </div>

    @if ($status === 'success')
        <script>
            document.getElementById("tableContainer").style.display = "block";
        </script>
    @else
        <script>
            document.getElementById("tableContainer").style.display = "none";
        </script>
    @endif
    <script>
        // Script JavaScript diubah sedikit untuk menonaktifkan tombol submit pada saat klik
        document.getElementById("showTableBtn").addEventListener("click", function() {
            if (validateForm()) {
                this.disabled = true;
                document.getElementById("tableContainer").style.display = "block";
            }
        });

        function validateForm() {
            const requiredFields = document.querySelectorAll(".form-control[required]");
            for (const field of requiredFields) {
                if (field.value === "") {
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Harap isi semua kolom yang tersedia',
                        icon: 'error',
                    });
                    field.focus();
                    return false;
                }
            }
            return true;
        }
    </script>

@endsection
