<?php

namespace App\Http\Controllers;

use App\Models\JenisKajian;
use Illuminate\Http\Request;

class JenisKajianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenisKajians = JenisKajian::all();
        return view('admin.jenis-kajian.base', compact('jenisKajians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jenis-kajian.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:100'
        ], [
            'name.required' => 'Nama jenis kajian harus diisi',
            'name.max' => 'Nama jenis kajian maximal 100 karakter'
        ]);

        JenisKajian::create($data);
        return redirect()->route('jenis-kajian.index')->with('success', 'Data berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisKajian $jenisKajian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisKajian $jenisKajian)
    {
        return view('admin.jenis-kajian.edit', compact('jenisKajian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JenisKajian $jenisKajian)
    {
        $data = $request->validate([
            'name' => 'required|max:100'
        ], [
            'name.required' => 'Nama jenis kajian harus diisi',
            'name.max' => 'Nama jenis kajian maximal harus 100 karakter'
        ]);

        $jenisKajian->update($data);
        return redirect()->route('jenis-kajian.index')->with('success', 'Data berhasil di ubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisKajian $jenisKajian)
    {
        $jenisKajian->delete();
        return redirect()->route('jenis-kajian.index')->with('success', 'Data berhasil di hapus');
    }
}
