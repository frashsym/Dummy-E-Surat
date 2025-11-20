<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Tampilkan semua data role.
     */
    public function index()
    {
        $roles = Role::orderBy('id', 'desc')->paginate(5);
        return view('role.role', compact('roles'));
    }

    /**
     * Simpan data role baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_role' => 'required|string|max:255',
        ]);

        Role::create($request->only(['nama_role']));

        return redirect()->route('role.role')->with('success', 'Role berhasil ditambahkan!');
    }

    /**
     * Update data role di database.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_role' => 'required|string|max:255',
        ]);

        $role = Role::findOrFail($id);
        $role->update($request->only(['nama_role']));

        return redirect()->route('role.role')->with('updated', 'Role berhasil diperbarui!');
    }

    /**
     * Hapus data role dari database.
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('role.role')->with('deleted', 'Role berhasil dihapus!');
    }
}
