<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Tampilkan semua data user.
     */
    public function index()
    {
        $users = User::with('role')
            ->where('role_id', '!=', 4) // 🔥 ngecualiin user dengan ID 4
            ->orderBy('id', 'desc')
            ->paginate(5);

        $roles = Role::orderBy('nama_role')->get();

        return view('user.user', compact('users', 'roles'));
    }

    /**
     * Simpan user baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role_id' => 'nullable|exists:roles,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('user.user')->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Tampilkan satu data user berdasarkan ID.
     */
    public function show($id)
    {
        $user = User::with('role')->findOrFail($id);
        return view('user.show', compact('user'));
    }

    /**
     * Update data user.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,$id",
            'password' => 'nullable|string|min:6',
            'role_id' => 'nullable|exists:roles,id',
        ]);

        $user = User::findOrFail($id);
        $data = $request->only(['name', 'email', 'role_id']);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('user.user')->with('updated', 'User berhasil diperbarui!');
    }

    /**
     * Hapus data user.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.user')->with('deleted', 'User berhasil dihapus!');
    }
}
