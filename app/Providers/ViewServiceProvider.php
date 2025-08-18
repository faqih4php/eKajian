<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\RequestKajian;
use App\Models\JadwalKajian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            $pendingRequest = RequestKajian::where('status', 'Menunggu')->orderBy('created_at')->get(['id', 'name', 'tema_kajian', 'lokasi', 'jenis_kajian_id', 'waktu_kajian']);
            $view->with('pendingRequest', $pendingRequest);
        });
    }
}
