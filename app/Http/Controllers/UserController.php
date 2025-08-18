<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.base', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:7'
        ], [
            'name.required' => 'Nama admin harus diisi',
            'name.max' => 'Nama maksimal 100 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Maaf email anda sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 7 karakter'
        ]);

        try {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            return redirect()
                ->route('user.index')
                ->with('success', 'Admin berhasil di tambahkan');
        } catch(\Exception $e){
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menambahkan admin.' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $data = $request->valdiate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
            'password' => 'nullable|string|min:7'
        ], [
            'name.required' => 'Nama admin harus diisi',
            'name.max' => 'Nama maksimal 100 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Maaf email anda sudah terdaftar',
            'roles.required' => 'Peran harus dipilih',
            'password.min' => 'Password minimal 7 karakter'
        ]);

        try {
            $updateData = [
                'name' => $data['name'],
                'email' => $data['email'],
            ];

            if (!empty($data['password'])) {
                $updateData['password'] = Hash::make($data['password']);
            }

            $user->update($updateData);
            $user->syncRoles($data['roles']);

            return redirect()
                ->route('user.index')
                ->with('success', 'Admin berhasil di update');
        } catch(\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat mengupdate admin.' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()
                ->route('user.index')
                ->with('success', 'Admin berhasil dihapus');
        } catch(\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menghapus admin.' . $e->getMessage());
        }
    }
}
