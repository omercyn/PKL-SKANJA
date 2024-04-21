<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\lokasipresensi;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\hash;

class SiswaController extends Controller
{
    public function index(): View
    {
        $user = User::orderBy('id','asc')->paginate(10)->where('role', 3);

        // Render view with users
        return view('admin.akun.siswa.siswa', compact('user'));
    }

    public function create(): View
    {
        $lokasiPresensi = LokasiPresensi::all();
        return view('admin.akun.siswa.Tambah', compact('lokasiPresensi'));
    }

    public function store(Request $request): RedirectResponse
    {
        // Validate form
        $request->validate([
            'foto-profil' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'nama' => 'required',
            'NISN' => 'required',
            'kelas' => 'required',
            'hp' => 'required',
            'email' => 'required|unique:users',
            'guru' => 'required',
            'lokasi' => 'required',
            'role' => 'required',
            'password' => 'required',
        ]);

            $image = $request->file('foto-profil');
            $imageName = $image->hashName();
            $extension = $image->getClientOriginalExtension();
            $path = Storage::disk('public')->putFile('foto-profil', $image, ['name' => $imageName . '.' . $extension]);

        try {
            $path = Storage::disk('public')->putFile('foto-profil', $image, ['name' => $imageName . '.' . $extension]);
            User::create([
                'profil' => $imageName,
                'nama' => $request->input('nama'),
                'NISN' => $request->input('NISN'),
                'kelas' => $request->input('kelas'),
                'guru_pembimbing' => $request->input('guru'),
                'lokasi_presensi' => $request->input('lokasi'),
                'HP' => $request->input('hp'),
                'email' => $request->input('email'),
                'role' => $request->input('role'),
                'password' => Hash::make($request->input('password')),
            ]);

            session()->flash('success', 'Data Berhasil Disimpan!');

            return redirect()->route('siswa-akun.index');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());

            return redirect()->back()->withInput($request->input());
        }
    }

    public function destroy($id): RedirectResponse
    {
        $user = User::findOrFail($id);
        Storage::delete('public/foto-profil/'. $user->profil);
        $user->delete();
        return redirect()->route('siswa-akun.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.akun.siswa.edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $validatedData = $request->validate([
            'avatar' => 'nullable|image|mimes:jpeg,png,gif',
        ]);

        $user = User::find(auth()->user()->id);

        if ($request->hasFile('avatar')) {
            $filename = time() . '.' . $request->avatar->getClientOriginalExtension();
            $filepath = Storage::disk('public')->putFile('foto-profil', $request->avatar); // Securely store image

            $user->profil = Str::slug($filename);
            $user->save();
        }


        return back()->with('success', 'Profile updated successfully!');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'NISN' => 'required',
            'kelas' => 'required',
            'HP' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'foto_profil' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($request->hasFile('foto-profil')) {
             $image = $request->file('foto-profil');
            $imageName = $image->hashName();
            $extension = $image->getClientOriginalExtension();
            $path = Storage::disk('public')->putFile('foto-profil', $image, ['name' => $imageName . '.' . $extension]);

            $validatedData['profil'] = $imageName;
        }

        try {
            $user = User::findOrFail($id);
            $user->update($validatedData);

            return redirect()->route('siswa-akun.index')->with('success', 'Data Berhasil Disimpan!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return back()->withInput();
        }
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('admin.akun.siswa.detail', compact('user'));
    }

}


