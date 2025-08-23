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
        $jenisKajians = JenisKajian::all();
        $jadwalKajians = JadwalKajian::with('jabatan', 'jenis_kajian')->get();
        return view('admin.jadwal-kajian.base', compact('jadwalKajians', 'jenisKajians'));
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
        $jenisKajians = JenisKajian::all();
        return view('admin.jadwal-kajian.edit', compact('jadwalKajian', 'jenisKajians'));
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
            'jenis_kajian_id' => 'required|exists:jenis_kajians,id',
            'tgl_kajian' => 'required|date'
        ], [
            'name.required' => 'Nama harus diisi',
            'name.max' => 'Nama maximal 100 karakter',
            'tema_kajian.required' => 'Tema kajian harus diisi untuk memberi info',
            'tema_kajian.max' => 'Tema kajian maximal 255 karakter',
            'lokasi.required' => 'Lokasi harus diisi',
            'lokasi.max' => 'Lokasi maximal 255 karakter',
            'jenis_kajian_id.required' => 'Jenis kajian harus dipilih',
            'tgl_kajian.required' => 'Waktu kajian harus diisi',
            'tgl_kajian.date' => 'Format tanggal harus YYYY-MM-DD HH:mm'
        ]);

        try {
            $data['status'] = $data['status'] ?? 'Menunggu';
            $data['waktu_kajian'] = \Carbon\Carbon::parse($data['tgl_kajian'])->format('Y-m-d H:i:s');
            unset($data['tgl_kajian']);
        } catch (\Exception $e) {
            return redirect()->back()
                    ->withInput()->with('error', 'Format tanggal kajian tidak valid, gunakan format YYYY-MM-DD HH:mm');
        }

        $jadwalKajian->update($data);
        // return redirect()->route('jadwal-kajian.index')->with('success', 'Data berhasil di perbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalKajian $jadwalKajian)
    {
        $jadwalKajian->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function dropEvents(Request $request, JadwalKajian $jadwalKajian)
    {
        $data = $request->validate([
            'tgl_kajian' => 'required|date'
        ], [
            'tgl_kajian.required' => 'Tanggal kajian harus diisi',
            'tgl_kajian.date' => 'Format tanggal harus YYYY-MM-DD HH:mm'
        ]);

        try {
            $data['waktu_kajian'] = \Carbon\Carbon::parse($data['tgl_kajian'])->format('Y-m-d H:i:s');
            unset($data['tgl_kajian']);
        } catch (\Exception $e) {
            return redirect()->back()
                    ->withInput()->with('error', 'Format tanggal kajian tidak valid, gunakan format YYYY-MM-DD HH:mm');
        }

        $requestKajian->update($data);
        return redirect()->back();
    }

    public function getEvents()
    {
        $events = JadwalKajian::with('jenis_kajian')->get()->map(function($kajian) {
            // Tentukan warna berdasarkan jenis kajian
            $colors = [
                'dark' => '6B6C9D',
                'primary' => '#696cff',   // Biru
                'success' => '#71dd37',   // Hijau
                'danger' => '#ff3e1d',    // Merah
                'warning' => '#ffab00',   // Kuning
                'info' => '#03c3ec',       // Biru Muda
                'pink' => '#c900cc',
                'blue' => '#132599',
                'purple' => '#181265'
            ];

            // Ambil warna random jika jenis kajian > jumlah warna
            $jenisKajian = [
                'Bada Subuh' => $colors['dark'],
                'Bada Dhuha' => $colors['primary'],
                'Bada Dhuhur' => $colors['danger'],
                'Bada Ashar' => $colors['warning'],
                'Bada Maghrib' => $colors['success'],
                'Bada Isya' => $colors['info'],

            ];

            return [
                'id' => $kajian->id,
                'name' => $kajian->name,
                'title' => $kajian->tema_kajian ?? 'Tidak ada tema',
                'start' => $kajian->waktu_kajian,
                'end' => $kajian->waktu_kajian,
                'backgroundColor' => $jenisKajian,
                'borderColor' => $jenisKajian,
                'extendedProps' => [
                    'lokasi' => $kajian->lokasi,
                    'jenis_kajian_id' => $kajian->jenis_kajian_id,
                    'jenis_kajian' => $kajian->jenis_kajian->name,
                ]
            ];
        });

        return response()->json($events);

    }
}
