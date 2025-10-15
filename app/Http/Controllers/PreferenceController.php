<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PreferenceController extends Controller
{
    public function show()
    {
        return view('preferensi');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'lokasi_tujuan' => ['required', 'string', 'max:255'],
            'budget_maksimum' => ['required', 'integer', 'min:0'],
            'durasi_liburan_hari' => ['required', 'integer', 'min:1'],
            'jenis_liburan' => ['required', 'in:pantai,gunung,kota,budaya,alam,kuliner'],
            'aktivitas_favorit' => ['array'],
            'aktivitas_favorit.*' => ['in:kuliner,adventure,belanja,budaya,hiking,snorkeling'],
            'jumlah_orang' => ['required', 'integer', 'min:1'],
        ]);

        // Simpan ke session sebagai placeholder integrasi rekomendasi AI
        $request->session()->put('preferensi', $validated);

        return redirect()->route('preferensi')->with('status', 'Preferensi berhasil dikirim. Rekomendasi akan segera ditampilkan.');
    }
}