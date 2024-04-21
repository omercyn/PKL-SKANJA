<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use Illuminate\Support\Facades\DB;

class DaftarHadirController extends Controller
{
    public function index()
    {
        $filter = Absensi::paginate(10);

        $kelass = Absensi::select('kelas')->distinct()->get();

        return view('admin.Absensi.daftar', compact('filter', 'kelass'));
    }

    public function filterData(Request $request)
    {
        $kelas = $request->input('kelas');

        $query = Absensi::query();
        if ($kelas && $kelas != 'Semua') {
            $query->where('kelas', $kelas);
        }

        // Ambil data hasil filter
        $filter = $query->paginate(10);

        $kelass = Absensi::select('kelas')->distinct()->get();

        return view('admin.absensi.daftar', compact('filter', 'kelass'));
    }

    public function showBukti($id)
    {
        $absensi = Absensi::findOrFail($id);
        return view('Admin.absensi.Bukti', compact('absensi'));
    }
}
