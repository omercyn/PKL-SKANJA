<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function logout(Request $request)
    {
      // Hapus session
      session()->flush();

      // Lakukan logout
      auth()->logout();

      // Regenerate the session token
      $request->session()->regenerateToken();

      // Redirect to the home page
      return redirect('/');
    }

    public function cek() {
        if (auth()->user()->role === 1) {
            return redirect('/admin');
        } else if (auth()->user()->role === 2) {
            return redirect('/guru');
        } else {
            return redirect('/siswa');
        }
    }
}
