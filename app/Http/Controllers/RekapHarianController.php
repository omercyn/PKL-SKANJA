<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Kelas;
use Illuminate\Support\Facades\DB;
use App\Exports\ExportAbsen;
Use Excel;
Use Pdf;

class RekapHarianController extends Controller
{
    public function index()
    {
        $filter = Absensi::whereDate('created_at', today())->paginate(10);

        $kelass = Kelas::select('kelas')->distinct()->get();

        return view('admin.Rekap.rekapHarian', compact('filter', 'kelass'));
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

        $kelass = Kelas::select('kelas')->distinct()->get();

        return view('admin.Rekap.rekapHarian', compact('filter', 'kelass'));
    }

    public function export_excel(Request $request)
    {
        // Default extension dan format ekspor


        // Validasi tipe ekstensi file
        if ($request->type == "xlsx") {
            $extension = "xlsx";
            $exportFormat = \Maatwebsite\Excel\Excel::XLSX;
        } elseif ($request->type == "csv") {
            $extension = "csv";
            $exportFormat = \Maatwebsite\Excel\Excel::CSV;
        } elseif ($request->type == "xls") {
            $extension = "xls";
            $exportFormat = \Maatwebsite\Excel\Excel::XLS;
        } else {
            $extension = "xlsx";
            $exportFormat = \Maatwebsite\Excel\Excel::XLSX;
        }

        // Nama file ekspor
        $filename = 'Rekap Absen Tanggal ' . date('d F Y') . '.' . $extension;

        // Inisialisasi query
        $query = Absensi::query();

        // Cek apakah ada filter kelas
        if ($request->has('kelas') && $request->kelas != 'Semua') {
            // Filter data berdasarkan kelas
            $query->where('kelas', $request->kelas);
        }

        // Ambil data sesuai query
        $data = $query->get();

        // Mengekspor data
        return Excel::download(new ExportAbsen($data), $filename, $exportFormat);
    }

    public function pdf_generator_get(Request $request){
        $kelas = $request->input('kelas');

        $query = Absensi::whereDate('created_at', today());

        if ($kelas && $kelas != 'Semua') {
            $query->where('kelas', $kelas);
        }

        $absensi = $query->get();

        $data = [
            'title' => 'REKAP ABSENSI PKL',
            'date' => date('d F Y'),
            'absensi' => $absensi,
        ];

        $filename = 'REKAP ABSENSI PKL ' . date('d F Y') . '.pdf';

        $pdf = PDF::loadView('admin.Rekap.myPDF', $data);

        return $pdf->download($filename);
    }
}
