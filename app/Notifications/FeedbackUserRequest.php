<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\Laporan;

class FeedbackUserRequest extends Notification implements ShouldQueue
{
    use Queueable;

    protected $laporan;

    public function __construct(Laporan $laporan)
    {
        $this->laporan = $laporan;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Admin Telah Memberikan Feedback Perbaikan!')
            ->greeting('Halo, ' . $notifiable->name . '!')
            ->line('Admin telah memberikan feedback untuk laporan #' . $this->laporan->nomor_laporan . '.')
            ->line('Silakan buka laporan dan lengkapi feedback Anda agar proses selesai dengan baik.')
            ->action('Isi Feedback', url('/laporan/' . $this->laporan->id . '/feedback-user-form'))
            ->line('Terima kasih sudah berpartisipasi di LaporPak!');
    }

    public function toArray($notifiable)
    {
        return [
            'title' => 'Feedback Admin Sudah Ada',
            'message' => 'Admin telah memberikan feedback untuk laporan #' . $this->laporan->nomor_laporan . '. Silakan isi feedback Anda.',
            'laporan_id' => $this->laporan->id,
            'link' => url('/laporan/' . $this->laporan->id . '/feedback-user-form'),
        ];
    }

    public function toDatabase($notifiable)
    {
        return new DatabaseMessage([
            'title' => 'Feedback Admin Sudah Ada',
            'message' => 'Admin telah memberikan feedback untuk laporan #' . $this->laporan->nomor_laporan . '. Silakan isi feedback Anda.',
            'laporan_id' => $this->laporan->id,
            'link' => url('/laporan/' . $this->laporan->id . '/feedback-user-form'),
        ]);
    }
}
