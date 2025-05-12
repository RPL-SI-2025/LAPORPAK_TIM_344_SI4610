<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\LaporanPublikController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\TrackReportController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KondisiJalanController;
use App\Http\Controllers\NotificationController;

// Landing page
Route::get('/', [LandingController::class, 'index'])->name('landing');

// Public laporan submission
Route::post('/lapor', [LaporanPublikController::class, 'submit'])->name('submit.laporan');
Route::get('/laporan/masuk', [LaporanPublikController::class, 'index'])->name('laporan.masuk');

// Statistik
//Route::get('/statistik', [StatistikController::class, 'index'])->name('statistik');

// Tracking routes
Route::get('/track', [TrackReportController::class, 'showTrackPage'])->name('track.show');
Route::post('/track/search', [TrackReportController::class, 'search'])->name('track.search');

// Authenticated Routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/user', [DashboardController::class, 'user'])->name('user.dashboard');

    // Kondisi Jalan
    Route::get('/kondisi-jalan', [KondisiJalanController::class, 'index'])->name('petakondisi.index');
    
    Route::post('/notifications/mark-as-read', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    })->name('notifications.read');
    Route::get('/laporan/{laporan}', [LaporanController::class, 'show'])->name('laporan.show');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

    // Profile Page (user only)
    Route::get('/profile', function () {
        return view('profile.profil');
    })->name('profile.index');
    Route::get('/profile/show', function () {
        return redirect()->route('profile.index');
    })->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Laporan Routes
    Route::get('/notifications/unread', [NotificationController::class, 'getUnread']);
Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead']);
    

    // Admin Routes
    Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/{laporan}', [LaporanController::class, 'detail'])->name('laporan.detail');
        Route::put('/laporan/{laporan}/status', [LaporanController::class, 'updateStatus'])->name('laporan.updateStatus');
        Route::get('/pengguna', [UserController::class, 'index'])->name('user.index');
        Route::post('/pengguna/{id}/update-status', [UserController::class, 'updateStatus'])->name('user.updateStatus');
    });

    // Form laporan
    Route::get('/lapor', function () {
        return view('profile.form_laporan');
    })->name('profile.form_laporan');
});

require __DIR__.'/auth.php';
