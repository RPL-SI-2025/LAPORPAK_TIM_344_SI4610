<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Report tracking routes (public)
Route::get('/lacak-laporan', [ReportController::class, 'index'])->name('lacak-laporan');

// Define the route for searching the report by nomor_laporan
Route::post('/report/search', [ReportController::class, 'search'])->name('report.search');

// Define the route to show report details by nomor_laporan
Route::get('/report/{nomor_laporan}', [ReportController::class, 'show'])->name('report.show');

// Halaman untuk form pelacakan laporan
Route::get('/lacak-laporan', [TrackReportController::class, 'showTrackPage'])->name('lacak-laporan');

// Proses pencarian laporan
Route::post('/report/search', [TrackReportController::class, 'searchReport'])->name('report.search');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return view('dashboard.user');
    })->name('dashboard');

    // Admin routes
    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])
        ->middleware('admin')
        ->name('admin.dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
