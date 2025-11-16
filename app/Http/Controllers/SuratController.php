<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuratController extends Controller
{
    /**
     * Tampilkan semua data surat.
     */

    public function index()
    {
        $user = Auth::user();

        // SUPERADMIN → full akses
        if ($user->role->nama_role === 'Superadmin') {
            $surats = Surat::with(['pengirimUser', 'penerimaUser'])
                ->orderBy('tanggal_surat', 'desc')
                ->paginate(5);
        } else {
            // USER BIASA → hanya surat miliknya
            $surats = Surat::with(['pengirimUser', 'penerimaUser'])
                ->where('pengirim_id', $user->id)
                ->orWhere('penerima_id', $user->id)
                ->orderBy('tanggal_surat', 'desc')
                ->paginate(5);
        }

        // List user untuk dropdown (SUPERADMIN boleh semua, user lain hanya dirinya sendiri)
        if ($user->role->nama_role === 'Superadmin') {
            $users = User::select('id', 'name')->orderBy('name')->get();
        } else {
            $users = User::where('id', $user->id)->select('id', 'name')->get();
        }

        return view('surat.surat', compact('surats', 'users'));
    }

    /**
     * Simpan data surat baru ke database.
     */
    public function store(Request $request, $templateId)
    {
        $request->validate([
            'header_logo' => 'nullable|string|max:255',
            'header_info' => 'nullable|string',

            'nomor' => 'nullable|string|max:255',
            'perihal' => 'nullable|string|max:255',
            'jenis' => 'nullable|string|max:100',

            'kepada_yth' => 'nullable|string|max:255',
            'tujuan' => 'nullable|string|max:255',

            'tanggal_surat' => 'nullable|date',
            'tanggal_diterima' => 'nullable|date',

            'pengirim' => 'nullable|string|max:255',
            'penerima' => 'nullable|string|max:255',

            'isi_html' => 'required|string',

            'lampiran' => 'nullable|string|max:255',

            'status' => 'nullable|string|max:50',
        ]);

        Surat::create([
            'template_id' => $templateId, // simpan id template
            'header_logo' => $request->header_logo,
            'header_info' => $request->header_info,
            'nomor' => $request->nomor,
            'perihal' => $request->perihal,
            'jenis' => $request->jenis,
            'kepada_yth' => $request->kepada_yth,
            'tujuan' => $request->tujuan,
            'tanggal_surat' => $request->tanggal_surat,
            'tanggal_diterima' => $request->tanggal_diterima,
            'pengirim' => $request->pengirim,
            'penerima' => $request->penerima,
            'isi_html' => $request->isi_html,
            'lampiran' => $request->lampiran,
            'status' => $request->status ?? 'draft',
        ]);

        return redirect()->route('user.surat.index')
            ->with('success', 'Surat berhasil ditambahkan!');
    }

    /**
     * Update data surat di database.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor' => 'required|string|max:255',
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
            'nomor',
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

        if (Auth::User()->role->nama_role === 'Dosen' || Auth::user()->role->nama_role === 'Mahasiswa') {
            if ($surat->user_id !== Auth::id()) {
                abort(403, 'Anda hanya bisa mengedit surat yang Anda buat sendiri.');
            }
        }

        return redirect()->route('user.surat.index')->with('updated', 'Surat berhasil diperbarui!');
    }

    /**
     * Hapus data surat (soft delete).
     */
    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);
        $surat->delete();

        return redirect()->route('user.surat.index')->with('deleted', 'Surat berhasil dihapus!');
    }
}
