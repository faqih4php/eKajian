<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jabatans = Jabatan::all();
        return view('admin.jabatans.base', compact('jabatans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jabatans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:100'
        ], [
            'name.required' => 'Nama jabatan harus diisi',
            'name.max' => 'Nama jabatan maximal 100 karakter'
        ]);

        Jabatan::create($data);
        return redirect()->route('jabatans.index')->with('success', 'Data berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jabatan $jabatan)
    {
        return view('admin.jabatans.edit', compact('jabatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jabatan $jabatan)
    {
        $data = $request->validate([
            'name' => 'required|max:100'
        ], [
            'name.required' => 'Nama jabatan harus diisi',
            'name.max' => 'Nama jabatan maximal 100 karakter'
        ]);

        $jabatan->update($data);
        return redirect()->route('jabatans.index')->with('success', 'Data berhasil di ubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jabatan $jabatan)
    {
        $jabatan->delete();
        return redirect()->route('jabatans.index')->with('success', 'Data berhasil di hapus');
    }
}
