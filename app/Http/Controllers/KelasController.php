<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\hash;

class KelasController extends Controller
{
    public function index(): View
    {
        $kelas = Kelas::orderBy('id','asc')->paginate(10);

        // Render view with kelass
        return view('admin.kelas.kelas', compact('kelas'));
    }

    public function create(): View
    {
        return view('admin.kelas.Tambah');
    }

    public function store(Request $request): RedirectResponse
    {
        // Validate form
        $request->validate([
            'foto-kelas' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'kelas' => 'required',
            'wali_kelas' => 'required',
            'NIP' => 'required',
        ]);

            $image = $request->file('foto-kelas');
            $imageName = $image->hashName();
            $extension = $image->getClientOriginalExtension();
            $path = Storage::disk('public')->putFile('foto-kelas', $image, ['name' => $imageName . '.' . $extension]);

        try {
            $path = Storage::disk('public')->putFile('foto-kelas', $image, ['name' => $imageName . '.' . $extension]);
            kelas::create([
                'profil' => $imageName,
                'kelas' => $request->input('kelas'),
                'wali_kelas' => $request->input('wali_kelas'),
                'NIP' => $request->input('NIP'),
            ]);

            session()->flash('success', 'Data Berhasil Disimpan!');

            return redirect()->route('kelas.index');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());

            return redirect()->back()->withInput($request->input());
        }
    }

    public function destroy($id): RedirectResponse
    {
        $kelas = kelas::findOrFail($id);
        Storage::delete('public/foto-kelas/'. $kelas->profil);
        $kelas->delete();
        return redirect()->route('kelas.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function edit($id)
    {
        $kelas = kelas::find($id);
        return view('admin.kelas.edit', compact('kelas'));
    }

    public function updateProfile(Request $request)
    {
        $validatedData = $request->validate([
            'avatar' => 'nullable|image|mimes:jpeg,png,gif',
        ]);

        $kelas = kelas::find(auth()->kelas()->id);

        if ($request->hasFile('avatar')) {
            $filename = time() . '.' . $request->avatar->getClientOriginalExtension();
            $filepath = Storage::disk('public')->putFile('foto-kelas', $request->avatar);

            $kelas->profil = Str::slug($filename);
            $kelas->save();
        }


        return back()->with('success', 'Profile updated successfully!');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $validatedData = $request->validate([
            'kelas' => 'required',
            'NIP' => 'required',
            'wali_kelas' => 'required',
            'foto_kelas' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($request->hasFile('foto-kelas')) {
             $image = $request->file('foto-kelas');
            $imageName = $image->hashName();
            $extension = $image->getClientOriginalExtension();
            $path = Storage::disk('public')->putFile('foto-kelas', $image, ['name' => $imageName . '.' . $extension]);

            $validatedData['profil'] = $imageName;
        }

        try {
            $user = kelas::findOrFail($id);
            $user->update($validatedData);

            return redirect()->route('kelas.index')->with('success', 'Data Berhasil Dirubah!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return back()->withInput();
        }
    }

    public function show($id)
    {
        $kelas = kelas::find($id);
        return view('admin.kelas.detail', compact('kelas'));
    }

}


