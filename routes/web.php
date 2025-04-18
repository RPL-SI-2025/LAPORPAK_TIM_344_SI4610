<?php

use Illuminate\Support\Facades\Route;

Route::get('/status-laporan', function () {
    return view('statuslaporan');
});
