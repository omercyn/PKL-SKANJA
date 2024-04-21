<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LokasiPresensi;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\hash;

class LokasiCOntroller extends Controller
{
    public function index(): View
    {
        $lokasi = LokasiPresensi::orderBy('id','asc')->paginate(10);

        // Render view with LokasiPresensis
        return view('admin.lokasi.lokasi', compact('lokasi'));
    }

    public function create(): View
    {
        return view('admin.lokasi.Tambah');
    }

    public function store(Request $request): RedirectResponse
    {
        // Validate form
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'radius' => 'required',
            'jam' => 'required',
            'guru' => 'required',
            'zona' => 'required',
        ]);


        try {
            LokasiPresensi::create([
                'nama_lokasi' => $request->input('nama'),
                'alamat_lokasi' => $request->input('alamat'),
                'guru_pembimbing' => $request->input('guru'),
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
                'radius' => $request->input('radius'),
                'jam_masuk' => $request->input('jam'),
                'zona_waktu' => $request->input('zona'),
            ]);

            session()->flash('success', 'Data Berhasil Disimpan!');

            return redirect()->route('lokasi.index');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());

            return redirect()->back()->withInput($request->input());
        }
    }

    public function destroy($id): RedirectResponse
    {
        $LokasiPresensi = LokasiPresensi::findOrFail($id);
        Storage::delete('public/foto-LokasiPresensi/'. $LokasiPresensi->profil);
        $LokasiPresensi->delete();
        return redirect()->route('lokasi.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function edit($id)
    {
        $lokasi = LokasiPresensi::find($id);
        return view('admin.lokasi.edit', compact('lokasi'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $validatedData = $request->validate([
            'nama_lokasi' => 'required',
            'alamat_lokasi' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'radius' => 'required',
            'jam_masuk' => 'required',
            'zona_waktu' => 'required',
        ]);

        try {
            $lokasi = LokasiPresensi::findOrFail($id);
            $lokasi->update($validatedData);

            return redirect()->route('lokasi.index')->with('success', 'Data Berhasil Dirubah!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return back()->withInput();
        }
    }

    public function show($id)
    {
        $lokasi = LokasiPresensi::find($id);
        return view('admin.lokasi.detail', compact('lokasi'));
    }

}


