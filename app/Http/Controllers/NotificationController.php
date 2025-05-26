<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $notifications = Notification::query()
            ->where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($notifications);
    }

    // Test method to check JSON storage
    public function testNotification()
    {
        // Delete any existing notifications
        Notification::truncate();

        // Create a notification with array data
        $notification = new Notification();
        $notification->user_id = 1;
        $notification->type = 'info';
        $notification->data = [
            'title' => 'Test Notification',
            'message' => 'Testing data format',
            'laporan_id' => 1,
            'nomor_laporan' => 'TEST-001',
            'status' => 'diajukan',
            'updated_at' => now()->toISOString()
        ];
        $notification->save();

        // Get the notification from database
        $storedNotification = Notification::first();

        return response()->json([
            'original' => $notification->getOriginal('data'),
            'stored' => $storedNotification->data,
            'is_array' => is_array($storedNotification->data)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNotificationRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = $request->user()->id;

            $notification = Notification::make($data);
            $notification->save();

            return response()->json($notification, 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNotificationRequest $request, Notification $notification)
    {
        try {
            $data = $request->validated();
            $notification->update($data);

            return response()->json($notification);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notification $notification)
    {
        try {
            $notification->delete();

            return response()->json(null, 204);
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
