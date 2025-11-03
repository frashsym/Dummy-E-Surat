<?php

namespace App\Http\Controllers;

use App\Models\Karir;
use Illuminate\Http\Request;

class KarirController extends Controller
{
    /**
     * Tampilkan semua data karir.
     */
    public function index()
    {
        $karirs = Karir::orderBy('id', 'desc')->paginate(10);
        return view('karir.karir', compact('karirs'));
    }

    /**
     * Simpan data karir baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_karir' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Karir::create($request->only(['nama_karir', 'deskripsi']));

        return redirect()->route('karir.karir')->with('success', 'Karir berhasil ditambahkan!');
    }

    /**
     * Update data karir di database.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_karir' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        $karir = Karir::findOrFail($id);
        $karir->update($request->only(['nama_karir', 'deskripsi']));

        return redirect()->route('karir.karir')->with('updated', 'Karir berhasil diperbarui!');
    }

    /**
     * Hapus data karir dari database.
     */
    public function destroy($id)
    {
        $karir = Karir::findOrFail($id);
        $karir->delete();

        return redirect()->route('karir.karir')->with('deleted', 'Karir berhasil dihapus!');
    }
}
