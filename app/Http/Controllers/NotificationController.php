<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification; // Pastikan ini mengarah ke model notifikasi Laravel

class NotificationController extends Controller
{
    public function getUnread()
    {
        // Misalkan mengambil notifikasi dari basis data
        $notifications = auth()->user()->notifications;

        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead($id)
    {
        // Misalkan mengambil notifikasi dari database
        $notifications = auth()->user()->notifications;

        return view('notifications.index', compact('notifications'));
    }

    // Add this new method to display notifications and mark them as read
    public function index()
    {
        $user = auth()->user();
        $notifications = $user->notifications()->paginate(10); // Fetch all notifications, paginated

        // Mark all unread notifications as read
        $user->unreadNotifications->markAsRead();

        return view('notifications.index', compact('notifications'));
    }
}
