<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LokasiPresensi;
use App\Models\User;
use App\Models\Absensi;

class IzinController extends Controller
{
    public function index(Request $request)
    {
       // Ambil data dari query string
       $latitudeSiswa = $request->query('latitude-siswa');
       $longitudeSiswa = $request->query('longitude-siswa');
       $latitudePKL = $request->query('latitude-PKL');
       $longitudePKL = $request->query('longitude-PKL');
       $radius = $request->query('radius-PKL');
       $jam = $request->query('jam');

        $namaPengguna = auth()->user()->nama;

        $lokasiUser = User::where('nama', $namaPengguna)->value('lokasi_presensi');

        $guruPembimbing = LokasiPresensi::where('nama_lokasi', $lokasiUser)->value('guru_pembimbing');

        // Validasi data
        if ($latitudeSiswa && $longitudeSiswa && $latitudePKL && $longitudePKL && $radius && $jam) {
            // Jika semua data tersedia, kirim ke view
            return view('siswa.izin.izin', compact('latitudeSiswa', 'longitudeSiswa', 'latitudePKL', 'longitudePKL', 'jam', 'guruPembimbing'));
        } else {
            // Jika ada data yang tidak tersedia, redirect dan tampilkan pesan kesalahan
            return redirect()->route('siswa')->with('error', 'Data tidak lengkap');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'guru' => 'required|string|max:255',
            'NISN' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'tanggal' => 'required|date',
            'jam' => 'required|string|max:255',
            'bukti'      => 'required|file',
            'keterangan' => 'required',
        ]);

        // Upload image to storage
        $bukti = $request->file('bukti');
        $dataBukti = date('YmdHis') . "." . $bukti->getClientOriginalName();
        $path = $bukti->storeAs('bukti', $dataBukti, 'public'); // Simpan ke storage/app/public/bukti

        // Simpan referensi nama file gambar ke database
        $absensi = Absensi::create([
            'nama' => $request->input('nama'),
            'guru_pembimbing' => $request->input('guru'),
            'NISN' => $request->input('NISN'),
            'kelas' => $request->input('kelas'),
            'longitude_absen' => $request->input('longitude'),
            'latitude_absen' => $request->input('latitude'),
            'jam' => $request->input('jam'),
            'tanggal' => $request->input('tanggal'),
            'foto_absen' => $path,
            'status' =>  $request->input('keterangan'),
        ]);

        session()->flash('success', 'Absensi berhasil disimpan!');
        return redirect()->route('siswa');
    }
}
