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
    public function store(Request $request, Jadwalkajian $jadwalKajian, RequestKajian $requestKajian)
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

        $jadwalKajian = JadwalKajian::where('waktu_kajian', $data['tgl_kajian'])->first();
        if($jadwalKajian){
            return redirect()->back()->withInput()->with('error', 'Jadwal Kajian sudah tersedia, harap pilih tanggal atau jam yang lain');
        }

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
        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
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

        $jadwalKajian->update($data);
        return redirect()->back();
    }

    public function getEvents(Request $request)
    {
        $filters = $request->input('filters', []);
        $events = JadwalKajian::with('jenis_kajian')->when($filters, function($query, $filters) {
            $query->whereIn('jenis_kajian_id', $this->mapFilters($filters));
        })->get()->map(function($kajian) {
            // Tentukan warna berdasarkan jenis kajian
            $colors = [
                1 => [
                    'bg' => '#2b2c40',
                    'text' => '#fff'
                ],
                2 => [
                    'bg' => '#696cff',
                    'text' => '#fff'
                ],   // Biru
                3 => [
                    'bg' => '#ff3e1d',
                    'text' => '#fff'
                ],   // Hijau
                4 => [
                    'bg' => '#ffab00',
                    'text' => '#fff'
                ],    // Merah
                5 => [
                    'bg' => '#71dd37',
                    'text' => '#fff'
                ],   // Kuning
                6 => [
                    'bg' => '#03c3ec',
                    'text' => '#fff'
                ],       // Biru Muda
                7 => [
                    'bg' => '#1da1f2',
                    'text' => '#fff'
                ],
                8 => [
                    'bg' => '#0077b5',
                    'text' => '#fff'
                ],
                9 => [
                    'bg' => '#3b5998',
                    'text' => '#fff'
                    ]
            ];

            $color = $colors[$kajian->jenis_kajian_id] ?? '#696cff';

            return [
                'id' => $kajian->id,
                'title' => $kajian->tema_kajian,
                'start' => $kajian->waktu_kajian,
                'end' => $kajian->waktu_kajian,
                'color' => $color['bg'],
                'extendedProps' => [
                    'name' => $kajian->name,
                    'lokasi' => $kajian->lokasi,
                    'jenis_kajian_id' => $kajian->jenis_kajian_id,
                    'jenis_kajian' => $kajian->jenis_kajian->name,
                ]
            ];
        });

        return response()->json($events);

    }

    private function mapFilters($filters)
    {
        return [
            'subuh' => 1,
            'dhuha' => 2,
            'dhuhur' => 3,
            'ashar' => 4,
            'maghrib' => 5,
            'isya' => 6,
            'jumat' => 7,
            'fitri' => 8,
            'adha' => 9,
        ][$filters] ?? [];
    }
}
