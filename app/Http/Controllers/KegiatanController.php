<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Absensi;
use App\Models\Jurnal;
use Illuminate\Support\Facades\Auth;

class KegiatanController extends Controller
{
    public function index(): View
    {
      $nama = Auth::user()->nama;
      $tanggal = today()->format('Y-m-d');

      $absen = Absensi::where('guru_pembimbing', $nama)
        ->whereDate('created_at', $tanggal)
        ->with('user')
        ->get();

        $status = 'masuk';

      return view('guru.kegiatan.kegiatan', compact('absen', 'status'));
    }

    public function konfirmasi(Request $request)
    {

        if ($request->submit_type === 'show_table') {
            $nama = Auth::user()->nama;
            $tanggal = today()->format('Y-m-d');

            $absen = Absensi::where('guru_pembimbing', $nama)
              ->whereDate('created_at', $tanggal)
              ->with('user')
              ->get();

            return view('guru.kegiatan.kegiatan', ['absen' => $absen]);
        }

        // Pengecekan jika tombol "Konfirmasi" diklik
        if ($request->submit_type === 'konfirmasi') {
            // Lakukan validasi data jika diperlukan
            $request->validate([
                'id' => 'required|exists:absensis,id',
                'kegiatan' => 'required',
                'guru_pembimbing' => 'required',
                'siswa' =>'required|exists:absensis,nama',
                'tanggal' => 'required',
                // Tambahkan validasi lain jika diperlukan
            ]);
        // Ambil data absen berdasarkan ID
        $absen = Absensi::findOrFail($request->id);

        // Lakukan pengecekan jika absen sudah terkonfirmasi
        if ($absen->status === 'Absen Terkonfirmasi' || $absen->status === 'Izin Terkonfirmasi') {
            return redirect()->back()->with('error', 'Absen sudah terkonfirmasi sebelumnya.');
        } else {
            // Ubah status menjadi 'Terkonfirmasi' tergantung pada status saat ini
            if ($absen->status === 'Absen' || $absen->status === 'Sakit' || $absen->status === 'Dispensasi' || $absen->status === 'Izin') {
                $absen->update(['status' => 'Absen Terkonfirmasi']);
            } else {
                $absen->update(['status' => 'Izin Terkonfirmasi']);
            }



         // Cari data jurnal berdasarkan tanggal dan guru pembimbing
         $jurnal = Jurnal::where('tanggal', $request->tanggal)
         ->where('guru_pembimbing', $absen->guru_pembimbing)
         ->first();

         if ($jurnal) {
            // Periksa apakah siswa sudah ada dalam entri jurnal
            $siswaArray = explode(',', $jurnal->siswa);
            if (!in_array($request->siswa, $siswaArray)) {
                // Jika siswa belum ada, tambahkan ke entri jurnal yang sudah ada
                $siswaArray[] = $request->siswa;
                $jurnal->siswa = implode(',', $siswaArray);
                $jurnal->save();
            }
        } else {
                // Jika jurnal belum ada, buat jurnal baru
                Jurnal::create([
                    'kegiatan' => $request->input('kegiatan'),
                    'tanggal' => $request->input('tanggal'),
                    'guru_pembimbing' => $request->input('guru_pembimbing'),
                    'siswa' => $request->siswa,
                    // Kolom lain yang dibutuhkan
                ]);
            }
            $status = 'success';

            // Redirect kembali dengan pesan sukses
            return redirect()->back()->with(['success' => 'Absen berhasil dikonfirmasi.', 'status' => 'success']);
        }
    }
}

    public function showBukti($id)
    {
        $absensi = Absensi::findOrFail($id);
        return view('guru.Bukti', compact('absensi'));
    }

}
