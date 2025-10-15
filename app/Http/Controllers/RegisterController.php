<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pengguna' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:penggunas,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        Pengguna::create([
            'nama_pengguna' => $validated['nama_pengguna'],
            'email' => $validated['email'],
            'kata_sandi' => Hash::make($validated['password']),
        ]);

        return redirect()->route('login')->with('status', 'Akun berhasil dibuat. Silakan masuk.');
    }
}