<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Tampilkan semua data layanan.
     */
    public function index()
    {
        $layanans = Layanan::all();
        return view('layanan.layanan', compact('layanans'));
    }

    /**
     * Simpan data layanan baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Layanan::create($request->only(['nama_layanan', 'deskripsi']));

        return redirect()->route('layanan.layanan')->with('success', 'Layanan berhasil ditambahkan!');
    }

    /**
     * Tampilkan satu data layanan berdasarkan ID.
     */
    public function show($id)
    {
        $layanan = Layanan::findOrFail($id);
        return view('layanan.show', compact('layanan'));
    }

    /**
     * Update data layanan di database.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $layanan = Layanan::findOrFail($id);
        $layanan->update($request->only(['nama_layanan', 'deskripsi']));

        return redirect()->route('layanan.layanan')->with('success', 'Layanan berhasil diperbarui!');
    }

    /**
     * Hapus data layanan dari database.
     */
    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->delete();

        return redirect()->route('layanan.layanan')->with('success', 'Layanan berhasil dihapus!');
    }
}
