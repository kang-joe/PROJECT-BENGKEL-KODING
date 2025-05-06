<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Periksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasienController extends Controller
{
    public function dashboard()
    {
        $pasien = Auth::user();
        $namaPasien = $pasien->name ?? $pasien->nama; // sesuaikan dengan kolom yg digunakan
        return view('pasien.dashboard', compact('namaPasien'));
    }

    public function showPeriksa()
    {
        $dokters = User::where('role', 'dokter')->get();
        return view('pasien.periksa', compact('dokters'));
    }

    public function storePeriksa(Request $request)
    {
        $request->validate([
            'id_dokter' => 'required|exists:users,id',
            'catatan' => 'nullable|string',
        ]);

        Periksa::create([
            'id_pasien' => Auth::id(),
            'id_dokter' => $request->id_dokter,
            'tgl_periksa' => now(),
            'catatan' => $request->catatan,
            'biaya_periksa' => 150000,
        ]);

        return redirect()->route('pasien.riwayat')->with('success', 'Data periksa berhasil dikirim.');
    }

    public function showRiwayat()
    {
        $periksas = \App\Models\Periksa::with(['dokter', 'detailPeriksa.obat'])
            ->where('id_pasien', Auth::id())
            ->latest()
            ->get();
    
        return view('pasien.riwayat', compact('periksas'));
    }
}