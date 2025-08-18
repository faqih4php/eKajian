<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\RequestKajian;
use App\Models\JadwalKajian;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requestKajians = RequestKajian::all();
        $total = RequestKajian::count();
        $belumDisetujui = RequestKajian::where('status', 'Menunggu')->count();
        $diterima = RequestKajian::where('status', 'Diterima')->count();
        $ditolak = RequestKajian::where('status', 'Ditolak')->count();

        return view('admin.home', compact('requestKajians', 'total', 'belumDisetujui', 'diterima', 'ditolak'));
    }

    public function indexGuest()
    {
        $jadwalKajians = JadwalKajian::with('jabatan', 'jenis_kajian');
        return view('guest.home', compact('jadwalKajians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
