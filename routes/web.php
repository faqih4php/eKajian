<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JadwalKajianController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\JenisKajianController;
use App\Http\Controllers\RequestKajianNotificationController;
use App\Http\Controllers\RequestKajianController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function() {
    Route::get('/', [AuthController::class, 'welcome'])->name('welcome');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/guest', [HomeController::class, 'indexGuest'])->name('guest.index');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Home routes must be accessible only to authenticated users to avoid redirect loops
    Route::get('/home-admin', [HomeController::class, 'index'])->name('home.index');

    Route::middleware(['auth', 'role:admin|super-admin'])->group(function () {


        Route::get('/request-kajian', [RequestKajianController::class, 'index'])->name('request-kajian.index');
        Route::get('/request-kajian/show/{requestKajian}', [RequestKajianController::class, 'show'])->name('request-kajian.show');
        Route::get('/request-kajian/{requestKajian}/edit', [RequestKajianController::class, 'edit'])->name('request-kajian.edit');
        Route::put('/request-kajian/{requestKajian}/', [RequestKajianController::class, 'update'])->name('request-kajian.update');
        Route::delete('/request-kajian/delete/{requestKajian}', [RequestKajianController::class, 'destroy'])->name('request-kajian.destroy');
        Route::put('/request-kajian/approve/{requestKajian}', [RequestKajianController::class, 'approve'])->name('request-kajian.approve');
        Route::put('/request-kajian/reject/{requestKajian}', [RequestKajianController::class, 'reject'])->name('request-kajian.reject');

        // !jadwal kajian routes
        Route::get('/jadwal-kajian/create', [JadwalKajianController::class, 'create'])->name('jadwal-kajian.create');
        Route::post('/jadwal-kajian', [JadwalKajianController::class, 'store'])->name('jadwal-kajian.store');
        Route::get('/jadwal-kajian/show/{jadwalKajian}', [JadwalKajianController::class, 'show'])->name('jadwal-kajian.show');
        Route::get('/jadwal-kajian/edit/{jadwalKajian}', [JadwalKajianController::class, 'edit'])->name('jadwal-kajian.edit');
        Route::put('/jadwal-kajian/{jadwalKajian}', [JadwalKajianController::class, 'update'])->name('jadwal-kajian.update');
        Route::delete('/jadwal-kajian/{jadwalKajian}', [JadwalKajianController::class, 'destroy'])->name('jadwal-kajian.destroy');

        Route::resource('jabatans', JabatanController::class);
        Route::resource('jenis-kajian', JenisKajianController::class);

        // Route::resource('jadwal-kajian', JadwalKajianController::class);
    });

    Route::middleware(['auth', 'role:super-admin'])->group(function () {
        Route::resource('user', UserController::class);
    });
});


    // !request kajian routes
    Route::get('/request-kajian/create', [RequestKajianController::class, 'create'])->name('request-kajian.create');
    Route::post('/request-kajian', [RequestKajianController::class, 'store'])->name('request-kajian.store');

    // !jadwal kajian route
    Route::get('/jadwal-kajian', [JadwalKajianController::class, 'index'])->name('jadwal-kajian.index');
