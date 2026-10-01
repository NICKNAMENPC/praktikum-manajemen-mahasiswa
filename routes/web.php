<?php

use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProfileController;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

Route::get('/dashboard', function () {
    $totalMahasiswa = Mahasiswa::count();
    $totalAdmin = User::where('role', 'admin')->count();
    $totalUser = User::where('role', 'user')->count();
    $latestMahasiswa = Mahasiswa::latest()->take(5)->get();

    return view('dashboard', compact('totalMahasiswa', 'totalAdmin', 'totalUser', 'latestMahasiswa'));
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    // Both Admin and User can view list of Mahasiswa
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');

    // Admin only routes: Create, Store, Edit, Update, Destroy
    Route::middleware('role:admin')->group(function () {
        Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
        Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
        Route::get('/mahasiswa/{mahasiswa}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
        Route::put('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
        Route::delete('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
    });

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
