<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    /**
     * Tampilkan semua data surat.
     */
    public function index()
    {
        $surats = Surat::all();
        return view('surat.surat', compact('surats'));
    }

    /**
     * Simpan data surat baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'jenis_surat' => 'required|string|max:100',
            'perihal' => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'tanggal_diterima' => 'nullable|date',
            'pengirim' => 'nullable|string|max:255',
            'penerima' => 'nullable|string|max:255',
            'isi_singkat' => 'nullable|string',
            'lampiran' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:50',
            'user_id' => 'nullable|integer|exists:users,id',
        ]);

        Surat::create($request->only([
            'nomor_surat',
            'jenis_surat',
            'perihal',
            'tanggal_surat',
            'tanggal_diterima',
            'pengirim',
            'penerima',
            'isi_singkat',
            'lampiran',
            'status',
            'user_id',
        ]));

        return redirect()->route('surat.surat')->with('success', 'Surat berhasil ditambahkan!');
    }

    /**
     * Tampilkan satu data surat berdasarkan ID.
     */
    public function show($id)
    {
        $surat = Surat::findOrFail($id);
        return view('surat.show', compact('surat'));
    }

    /**
     * Update data surat di database.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'jenis_surat' => 'required|string|max:100',
            'perihal' => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'tanggal_diterima' => 'nullable|date',
            'pengirim' => 'nullable|string|max:255',
            'penerima' => 'nullable|string|max:255',
            'isi_singkat' => 'nullable|string',
            'lampiran' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:50',
            'user_id' => 'nullable|integer|exists:users,id',
        ]);

        $surat = Surat::findOrFail($id);
        $surat->update($request->only([
            'nomor_surat',
            'jenis_surat',
            'perihal',
            'tanggal_surat',
            'tanggal_diterima',
            'pengirim',
            'penerima',
            'isi_singkat',
            'lampiran',
            'status',
            'user_id',
        ]));

        return redirect()->route('surat.surat')->with('success', 'Surat berhasil diperbarui!');
    }

    /**
     * Hapus data surat (soft delete).
     */
    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);
        $surat->delete();

        return redirect()->route('surat.surat')->with('success', 'Surat berhasil dihapus!');
    }
}
