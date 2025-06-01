<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification; // Pastikan ini mengarah ke model notifikasi Laravel

class NotificationController extends Controller
{
    public function getUnread()
    {
        $user = auth()->user();
        $notifications = $user->unreadNotifications;
        return view('notifikasi.index', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $user = auth()->user();
        $notification = $user->notifications()->find($id);
        if ($notification) {
            $notification->markAsRead();
        }
        return redirect()->route('notifikasi.index');
    }

    // Tampilkan semua notifikasi dan tandai sebagai sudah dibaca
    public function index()
    {
        $user = auth()->user();
        $notifications = $user->notifications()->paginate(10);
        $user->unreadNotifications->markAsRead();
        return view('notifikasi.index', compact('notifications'));
    }
}