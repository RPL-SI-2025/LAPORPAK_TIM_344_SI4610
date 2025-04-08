<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/lacak-laporan', [ReportController::class, 'index'])->name('track.report');
Route::get('/cari-laporan', [ReportController::class, 'track'])->name('report.search');