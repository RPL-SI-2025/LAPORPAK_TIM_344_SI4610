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
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\NotificationController;
use App\Models\Laporan;

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

    // Profile Page (user only)
    Route::get('/profile', function () {
        return view('profile.profil');
    })->name('profile.index');
    Route::get('/profile/show', function () {
        return redirect()->route('profile.index');
    })->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Admin Routes
    Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/{laporan}', [LaporanController::class, 'detail'])->name('laporan.detail');
        Route::put('/laporan/{laporan}/status', [LaporanController::class, 'updateStatus'])->name('laporan.updateStatus');
        Route::get('/pengguna', [UserController::class, 'index'])->name('user.index');
        Route::post('/pengguna/{id}/update-status', [UserController::class, 'updateStatus'])->name('user.updateStatus');

        // Admin Feedback Management
        Route::get('/feedback', [App\Http\Controllers\Admin\FeedbackController::class, 'index'])->name('feedback.index');
        Route::get('/feedback/create', [App\Http\Controllers\Admin\FeedbackController::class, 'create'])->name('feedback.create');
        Route::post('/feedback', [App\Http\Controllers\Admin\FeedbackController::class, 'store'])->name('feedback.store');
        Route::get('/feedback/{id}/edit', [App\Http\Controllers\Admin\FeedbackController::class, 'edit'])->name('feedback.edit');
        Route::put('/feedback/{id}', [App\Http\Controllers\Admin\FeedbackController::class, 'update'])->name('feedback.update');
        Route::delete('/feedback/{id}', [App\Http\Controllers\Admin\FeedbackController::class, 'destroy'])->name('feedback.destroy');
    });

    // Form laporan
    Route::get('/lapor', function () {
        return view('profile.form_laporan');
    })->name('profile.form_laporan');

    // feedback
    Route::get('/feedback/{laporan}', [FeedbackController::class, 'index'])->name('users.feedback');
    Route::post('/feedback/submit', [FeedbackController::class, 'submit'])->name('users.feedback.submit');

    // Notification
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications', [NotificationController::class, 'store'])->name('notifications.store');
    Route::put('/notifications/{notification}', [NotificationController::class, 'update'])->name('notifications.update');
    Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
});

// Add test route for notification data
Route::get('/test-notification', [App\Http\Controllers\NotificationController::class, 'testNotification']);

require __DIR__.'/auth.php';
