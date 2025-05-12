<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        // Misalkan mengambil notifikasi dari database
        $notifications = auth()->user()->notifications;

        return view('notifications.index', compact('notifications'));
    }
}
