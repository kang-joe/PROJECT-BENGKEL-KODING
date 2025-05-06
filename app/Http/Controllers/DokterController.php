<?php

namespace App\Http\Controllers;

use App\Models\Periksa;
use App\Models\Obat;
use App\Models\User;
use App\Models\DetailPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DokterController extends Controller
{
    public function dashboard()
    {
        $dokter = User::find(Auth::id());
        $namaDokter = $dokter->name;
        return view('dokter.dashboard', compact('namaDokter'));
    }

    public function showPeriksa()
    {
        $periksas = Periksa::with(['pasien', 'dokter', 'detailPeriksa'])
            ->where('id_dokter', Auth::id())
            ->get();
        
        return view('dokter.periksa', compact('periksas'));
    }
    

    public function showObat()
    {
        $obats = Obat::all();
        return view('dokter.obat', compact('obats'));
    }

    public function editObat($id)
    {
        $obat = Obat::findOrFail($id);
        $obats = Obat::all(); // Ambil semua obat untuk ditampilkan di tabel
        return view('dokter.obat', compact('obat', 'obats'));
    }
    
    public function storeObat(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:255',
            'harga' => 'required|numeric',
        ]);
    
        Obat::create([
            'nama_obat' => $request->nama_obat,
            'kemasan' => $request->kemasan,
            'harga' => $request->harga,
        ]);
    
        return redirect()->route('dokter.obat')->with('success', 'Obat berhasil ditambahkan.');
    }
    
    public function updateObat(Request $request, $id)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:255',
            'harga' => 'required|numeric',
        ]);
    
        $obat = Obat::findOrFail($id);
        $obat->update([
            'nama_obat' => $request->nama_obat,
            'kemasan' => $request->kemasan,
            'harga' => $request->harga,
        ]);
    
        return redirect()->route('dokter.obat')->with('success', 'Obat berhasil diperbarui.');
    }
    
    public function destroyObat($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();
    
        return redirect()->route('dokter.obat')->with('success', 'Obat berhasil dihapus.');
    }
    

    public function editPeriksa($id)
    {
        $periksa = Periksa::with('detailPeriksa.obat')->findOrFail($id);
        $obats = Obat::all();
        $selectedObatIds = $periksa->detailPeriksa->pluck('id_obat')->toArray();

        return view('dokter.periksaEdit', compact('periksa', 'obats', 'selectedObatIds'));
    }

    public function updatePeriksa(Request $request, $id)
{
    // Validasi input obat yang dipilih
    $request->validate([
        'id_obat' => 'required|array',
        'id_obat.*' => 'exists:obats,id', // Pastikan obat yang dipilih ada di database
    ]);
    
    // Ambil data periksa berdasarkan ID
    $periksa = Periksa::findOrFail($id);
    
    // Tambahkan obat-obat baru ke detailPeriksa tanpa menghapus obat lama
    foreach ($request->id_obat as $id_obat) {
        $obat = Obat::findOrFail($id_obat);
        
        // Cek apakah obat sudah ada di detailPeriksa
        $existingDetail = $periksa->detailPeriksa()->where('id_obat', $obat->id)->first();
        
        // Jika obat belum ada, tambahkan ke detailPeriksa
        if (!$existingDetail) {
            $periksa->detailPeriksa()->create([
                'id_obat' => $obat->id,
                'harga_obat' => $obat->harga, // Simpan harga obat ke detailPeriksa
            ]);
        }
    }
    
    // Hitung total biaya periksa berdasarkan semua obat yang ada
    $totalHarga = $periksa->detailPeriksa()->sum('harga_obat');
    
    // Update kolom biaya_periksa pada tabel periksas
    $periksa->update([
        'biaya_periksa' => $totalHarga
    ]);
    
    // Log untuk debugging (Opsional)
    \Log::info('Total Harga: ' . $totalHarga);
    
    // Redirect dengan pesan sukses
    return redirect()->route('dokter.periksa')->with('success', 'Obat berhasil ditambahkan.');
}

    

    public function hapusDetailObat($id)
    {
        $detail = DetailPeriksa::findOrFail($id);
        $id_periksa = $detail->id_periksa;

        $detail->delete();

        return redirect()->route('dokter.periksa.edit', $id_periksa)->with('success', 'Obat berhasil dihapus.');
    }
}
