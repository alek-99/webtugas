<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PanduanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\NotifikasiController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/syarat', [PanduanController::class, 'syarat'])->name('syarat');
Route::get('/kebijakan', [PanduanController::class, 'kebijakan'])->name('kebijakan');
Route::get('/panduan', [PanduanController::class, 'panduan'])->name('panduan');
Route::get('/detailpanduan', [PanduanController::class, 'detailPanduan'])->name('detailpanduan');
Route::get('/hubungidev', [PanduanController::class, 'hubungidev'])->name('hubungidev');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('matakuliahs', MataKuliahController::class);
    Route::resource('jadwals', JadwalController::class);
    Route::resource('tugass', TugasController::class);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
 Route::get('/notifikasi/create', [NotifikasiController::class, 'create'])->name('notifikasi.create');
    Route::post('/notifikasi/send', [NotifikasiController::class, 'send'])->name('notifikasi.send');
    Route::get('/notifikasi/{id}', [NotifikasiController::class, 'show'])->name('notifikasi.show');
    Route::delete('/notifikasi/{id}', [NotifikasiController::class, 'destroy'])->name('notifikasi.destroy');
});
Route::get('/test-email', function () {
    Mail::raw('Tes kirim email Laravel via Gmail SMTP', function($msg) {
        $msg->to('alamat-email-tujuan@gmail.com')->subject('Uji Kirim Email');
    });

    return '✅ Email sudah dikirim! Cek inbox kamu.';
});

require __DIR__.'/auth.php';
