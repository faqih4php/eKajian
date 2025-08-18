<?php

namespace App\Http\Controllers;

use App\Models\JadwalKajian;
use App\Models\Jabatan;
use App\Models\JenisKajian;
use App\Models\RequestKajian;
use Illuminate\Http\Request;

class JadwalKajianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwalKajians = JadwalKajian::with('jabatan', 'jenis_kajian')->get();
        return view('admin.jadwal-kajian.base', compact('jadwalKajians'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jabatans = Jabatan::all();
        $jenisKajians = JenisKajian::all();
        return view('admin.jadwal-kajian.create', compact('jabatans', 'jenisKajians'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, RequestKajian $requestKajian)
    {
        $data = $request->validate([
            'name' => 'required|max:100',
            'tema_kajian' => 'required|max:255',
            'lokasi' => 'required|max:255',
            'jenis_kajian_id' => 'required|exists:jenis_kajians,id',
            'tgl_kajian' => 'required|date'
        ], [
            'name.required' => "Nama harus diisi",
            'name.max' => 'Nama maximal 100 karakter',
            'tema_kajian.required' => 'Tema kajian harus diisi untuk memberi info',
            'tema_kajian.max' => 'Tema kajian maximal 255 karakter',
            'lokasi.required' => 'Lokasi harus diisi',
            'lokasi.max' => 'Lokasi maximal 255 karakter',
            'jenis_kajian_id.required' => 'Jenis kajian harus dipilih',
            'tgl_kajian.required' => 'Waktu kajian harus diisi',
            'tgl_kajian.date' => 'Format tanggal harus YYYY-MM-DD HH:mm'
        ]);

        $data['waktu_kajian'] = \Carbon\Carbon::parse($data['tgl_kajian'])->format('Y-m-d H:i:s');
        unset($data['tgl_kajian']);
        // if ($requestKajian->status === 'Diterima') {}
        JadwalKajian::create($data);
        return redirect()->route('jadwal-kajian.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(JadwalKajian $jadwalKajian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalKajian $jadwalKajian)
    {
        $jadwalKajian = JadwalKajian::findOrFail($jadwalKajian->id);
        return view('admin.jadwal-kajian.edit', compact('jadwalKajian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JadwalKajian $jadwalKajian)
    {
        $data = $request->validate([
            'name' => 'required|max:100',
            'tema_kajian' => 'required|max:255',
            'lokasi' => 'required|max:255',
            'nomer' => 'required|regex:/^\d{12,}$/',
            'jenis_kajian_id' => 'required|exists:jenis_kajians,id',
            'tgl_kajian' => 'required|date'
        ], [
            'name.required' => 'Nama harus diisi',
            'name.max' => 'Nama maximal 100 karakter',
            'tema_kajian.required' => 'Tema kajian harus diisi untuk memberi info',
            'tema_kajian.max' => 'Tema kajian maximal 255 karakter',
            'lokasi.required' => 'Lokasi harus diisi',
            'lokasi.max' => 'Lokasi maximal 255 karakter',
            'nomer.required' => 'Nomer harus diisi',
            'nomer.regex' => 'Nomer minimal 12 angka',
            'jenis_kajian_id.required' => 'Jenis kajian harus dipilih',
            'tgl_kajian.required' => 'Waktu kajian harus diisi',
            'tgl_kajian.date' => 'Format tanggal harus YYYY-MM-DD HH:mm'
        ]);

        $data['waktu_kajian'] = $data['tgl_kajian'];
        unset($data['tgl_kajian']);

        $jadwalKajian->update($data);
        return redirect()->route('jadwal-kajian.index')->with('success', 'Data berhasil di perbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalKajian $jadwalKajian)
    {
        $jadwalKajian->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    // public function getEvents()
    // {
    //     $jadwalKajians = JadwalKajian::all();
    //     $events = [];

    //     foreach ($jadwalKajians as $kajian)
    //     {
    //         $events[] = [
    //             'id' => $kajian->id,
    //             'title' => $kajian->tema_kajian,
    //             'start' => \Carbon\Carbon\::parse($kajian->waktu_kajian)->toIso8601String(),
    //             'allDay' => false,
    //             'extendedProps' => [
    //                 'location' => $kajian->lokasi,
    //             ],
    //         ];
    //     }
    // }

}
