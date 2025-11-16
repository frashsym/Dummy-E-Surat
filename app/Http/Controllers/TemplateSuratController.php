<?php

namespace App\Http\Controllers;

use App\Models\TemplateSurat;
use Illuminate\Http\Request;

class TemplateSuratController extends Controller
{
    /**
     * Tampilkan semua template surat.
     */
    public function index()
    {
        $templates = TemplateSurat::orderBy('id', 'desc')->paginate(5);
        return view('surat.surat', compact('templates'));
    }

    /**
     * Simpan template surat baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_template'   => 'required|string|max:255',
            'html_template'   => 'required|string',
            'editable_fields' => 'required|array',
        ]);

        TemplateSurat::create([
            'nama_template'   => $request->nama_template,
            'html_template'   => $request->html_template,
            'editable_fields' => $request->editable_fields,
        ]);

        return redirect()->route('user.template.index')->with('success', 'Template surat berhasil ditambahkan!');
    }

    /**
     * Tampilkan satu template berdasarkan ID.
     */
    // public function show($id)
    // {
    //     $template = TemplateSurat::findOrFail($id);
    //     return view('surat.surat.show', compact('template'));
    // }

    /**
     * Update data template surat.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_template'   => 'required|string|max:255',
            'html_template'   => 'required|string',
            'editable_fields' => 'required|array',
        ]);

        $template = TemplateSurat::findOrFail($id);

        $template->update([
            'nama_template'   => $request->nama_template,
            'html_template'   => $request->html_template,
            'editable_fields' => $request->editable_fields,
        ]);

        return redirect()->route('user.template.index')->with('updated', 'Template surat berhasil diperbarui!');
    }

    /**
     * Hapus template surat.
     */
    public function destroy($id)
    {
        $template = TemplateSurat::findOrFail($id);
        $template->delete();

        return redirect()->route('user.template.index')->with('deleted', 'Template surat berhasil dihapus!');
    }
}
