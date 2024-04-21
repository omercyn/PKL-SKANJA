<?php

namespace App\Http\Controllers;

use App\Models\LokasiPresensi;
use App\Models\User;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AbsensiController extends Controller
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
            return view('siswa.absen.absen', compact('latitudeSiswa', 'longitudeSiswa', 'latitudePKL', 'longitudePKL', 'radius', 'jam', 'guruPembimbing'));
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
            'longitude_absen' => 'required|numeric',
            'latitude_absen' => 'required|numeric',
            'tanggal' => 'required|date',
            'jam' => 'required|string|max:255',
            'image' => 'required', // Sesuaikan validasi dengan data gambar
        ]);

        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->input('image')));

        $imageName = Str::random(20) . '.jpg';

        // Simpan gambar ke storage (misalnya, folder 'public')
        Storage::disk('bukti')->put($imageName, $imageData);

        // Simpan referensi nama file gambar ke database
        $absensi = Absensi::create([
            'nama' => $request->input('nama'),
            'guru_pembimbing' => $request->input('guru'),
            'NISN' => $request->input('NISN'),
            'kelas' => $request->input('kelas'),
            'longitude_absen' => $request->input('longitude_absen'),
            'latitude_absen' => $request->input('latitude_absen'),
            'jam' => $request->input('jam'),
            'tanggal' => $request->input('tanggal'),
            'status' => "Absen",
            'foto_absen' => $imageName, // Simpan nama file gambar di database
        ]);

        session()->flash('success', 'Absensi berhasil disimpan!');
        return redirect()->route('siswa');
    }
}
