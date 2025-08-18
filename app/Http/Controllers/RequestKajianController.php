<?php

namespace App\Http\Controllers;

use App\Models\RequestKajian;
use Illuminate\Http\Request;
use App\Models\JadwalKajian;
use App\Notifications\RequestKajianNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Models\Jabatan;
use App\Models\JenisKajian;

class RequestKajianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requestKajians = RequestKajian::with('jabatan', 'jenis_kajian')->get();
        $total = RequestKajian::count();
        $belumDisetujui = RequestKajian::where('status', 'Menunggu')->count();
        $diterima = RequestKajian::where('status', 'Diterima')->count();
        $ditolak = RequestKajian::where('status', 'Ditolak')->count();
        return view('admin.request_kajian.base', compact('requestKajians', 'total', 'belumDisetujui', 'diterima', 'ditolak'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jabatans = Jabatan::all();
        $jenisKajians = JenisKajian::all();
        $jadwalKajian = JadwalKajian::all();
        $requestKajian = RequestKajian::all();
        return view('admin.request_kajian.create', compact('requestKajian', 'jabatans', 'jenisKajians', 'jadwalKajian'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, JadwalKajian $jadwalKajian)
    {
        $data = $request->validate([
            'name' => 'required|max:100',
            'tema_kajian' => 'nullable|max:500',
            'lokasi' => 'required|max:255',
            'nomer' => 'required|regex:/^\d{12,}$/',
            'jabatan' => 'required|exists:jabatans,id',
            'jenis_kajian' => 'required|exists:jenis_kajians,id',
            'tgl_kajian' => 'required|date',
            'status' => 'nullable|in:Menunggu,Diterima,Ditolak'
        ],[
            'name.required' => 'Nama harus diisi',
            'name.max' => 'Nama maximal 100 karakter',
            'tema_kajian' => 'Tema kajian maximal 500 karakter',
            'lokasi.required' => 'Lokasi harus diisi',
            'lokasi.max' => 'Lokasi maximal 255 karakter',
            'nomer.required' => 'Nomer pemohon harus diisi',
            'nomer.regex' => 'Nomer pemohon harus terdiri dari minimal 12 digit angka',
            'jabatan.required' => 'Jabatan harus di pilih',
            'jenis_kajian.required' => 'Jenis Kajian harus di pilih',
            'tgl_kajian.required' => 'Tanggal kajian harus diisi',
            'tgl_kajian.date' => 'Format tanggal kajian tidak valid, gunakan format YYYY-MM-DD HH:mm'
        ]);

        try {
            $data['status'] = $data['status'] ?? 'Menunggu';
            $data['waktu_kajian'] = \Carbon\Carbon::parse($data['tgl_kajian'])->format('Y-m-d H:i:s');
            unset($data['tgl_kajian']);
        } catch (\Exception $e) {
            return redirect()->back()
                    ->withInput()->with('error', 'Format tanggal kajian tidak valid, gunakan format YYYY-MM-DD HH:mm');
        }
        
        // cek apakah jadwal kajian sudah ada
        $jadwalKajian = JadwalKajian::where('waktu_kajian', $data['waktu_kajian'])->first();
        if ($jadwalKajian) {
            return redirect()->back()->withInput()->with('error', 'Jadwal Kajian sudah tersedia, harap pilih tanggal atau jam yang lain');
        }

        $requestKajian = RequestKajian::create([
            'name' => $data['name'],
            'tema_kajian' => $data['tema_kajian'] ?? null,
            'lokasi' => $data['lokasi'],
            'nomer' => $data['nomer'],
            'jabatan_id' => $data['jabatan'],
            'jenis_kajian_id' => $data['jenis_kajian'],
            'waktu_kajian' => $data['waktu_kajian'],
            'status' => $data['status'],
        ]);

        // create notif setelah request kajian dibuat
        $notification = new RequestKajianNotification($requestKajian);

        // Jika yang membuat data adalah admin atau super-admin, kirim ke dia sendiri
        // kalau guest, kirim ke semua user dengan role admin atau super admin
        if (Auth::check() && Auth::user()->hasAnyRole(['admin', 'super-admin'])) {
            Auth::user()->notify($notification);
        }else {
            $recipients = User::role(['admin', 'super-admin'])->get();

            Notification::send($recipients, $notification);
        }

        if (Auth::check() && Auth::user()->hasRole(['admin', 'super-admin'])) {
            return redirect()->route('request-kajian.index')->with('success', 'Permohonan berhasil dibuat');
        }

        return redirect()->route('guest.index')->with('success', 'Permohonan berhasil dibuat, tunggu konfirmasi dari admin');
    }

    /**
     * Display the specified resource.
     */
    public function show(RequestKajian $requestKajian)
    {
        $jabatans = Jabatan::all();
        $jenis_kajian = JenisKajian::all();
        return view('admin.request_kajian.DataRequestKajian.show', compact('requestKajian', 'jabatans', 'jenis_kajian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RequestKajian $requestKajian)
    {
        $jabatan = Jabatan::all();
        $jenis_kajian = JenisKajian::all();
        return view('admin.request_kajian.edit', compact('requestKajian', 'jabatan', 'jenis_kajian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RequestKajian $requestKajian)
    {
        $data = $request->validate([
            'name' => 'required|max:100',
            'tema_kajian' => 'nullable|max:500',
            'lokasi' => 'required|max:255',
            'nomer' => 'required|regex:/^\d{12,}$/',
            'jabatan' => 'required|exists:jabatans,id',
            'jenis_kajian' => 'required|exists:jenis_kajians,id',
            'tgl_kajian' => 'required|date_format:Y-m-d\TH:i',
            'status' => 'nullable|in:Menunggu,Diterima,Ditolak'
        ],[
            'name.required' => 'Nama harus diisi',
            'name.max' => 'Nama maximal 100 karakter',
            'tema_kajian.max' => 'Tema kajian maximal 500 karakter',
            'lokasi.required' => 'Lokasi anda harus diisi',
            'lokasi.max' => 'Lokasi maximal 255 karakter',
            'nomer.required' => 'Nomer pemohon harus diisi',
            'nomer.regex' => 'Nomer pemohon harus terdiri dari minimal 12 digit angka',
            'jabatan.required' => 'Jabatan harus di pilih',
            'jenis_kajian.required' => 'Jenis Kajian harus di pilih',
            'tgl_kajian.required' => 'Tanggal kajian harus diisi',
            'tgl_kajian.date_format' => 'Format tanggal kajian tidak valid, gunakan format Y-m-d H:i:s'
        ]);

        $data['waktu_kajian'] = $data['tgl_kajian'];
        unset($data['tgl_kajian']);

        $requestKajian->update($data);

        return redirect()->route('request-kajian.index')->with('success', 'Permohonan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RequestKajian $requestKajian)
    {
        $requestKajian->delete();
        return redirect()->route('request-kajian.index')->with('success', 'Data berhasil di hapus');
    }

    public function approve(RequestKajian $requestKajian, JadwalKajian $jadwalKajian)
    {
        $requestKajian = RequestKajian::findOrFail($requestKajian->id);
        $requestKajian->update(['status' => 'Diterima']);

        $jadwal = JadwalKajian::create([
            'request_kajian_id' => $requestKajian->id,
            'name' => $requestKajian->name,
            'tema_kajian' => $requestKajian->tema_kajian,
            'lokasi' => $requestKajian->lokasi,
            'jenis_kajian_id' => $requestKajian->jenis_kajian_id,
            'waktu_kajian' => $requestKajian->waktu_kajian
        ]);

        $user = Auth::user();

        if ($user && $user->hasAnyRole(['admin', 'super-admin'])) {
            $user->notifications()
                ->where('data->id', $requestKajian->id)
                ->delete(); // Remove the notification for the request
        }
        return redirect()->back()->with('success', 'Permohonan berhasil di setujui, dan di tambahkan ke jadwal kajian');
    }

    public function reject(RequestKajian $requestKajian, JadwalKajian $jadwalKajian)
    {
        $requestKajian->update(['status' => 'Ditolak']);

        $user = Auth::user();
        if ($user && $user->hasAnyRole(['admin', 'super-admin'])) {
            $user->notifications()
                ->where('data->id', $requestKajian->id)
                ->delete(); // Remove the notification for the request
        }
        return redirect()->route('request-kajian.index')->with('success', 'Permohonan berhasil di tolak');
    }
}
