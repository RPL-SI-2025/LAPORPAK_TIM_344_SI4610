<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;
use App\Models\Laporan;

class LaporanStatusUpdated extends Notification
{
    use Queueable;

    protected $laporan;

    /**
     * Create a new notification instance.
     */
    public function __construct(Laporan $laporan)
    {
        $this->laporan = $laporan;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        $message = "Status laporan Anda dengan nomor {$this->laporan->nomor_laporan} telah diperbarui menjadi: {$this->laporan->status}.";

        if ($this->laporan->status === 'selesai') {
            $message .= "\n\nJangan lupa isi feedback yaa!";
        }

        return (new MailMessage)
            ->subject('Status Laporan Diperbarui')
            ->line($message)
            ->action('Lihat Laporan', url('/laporan/' . $this->laporan->id))
            ->line('Terima kasih telah menggunakan layanan kami.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable): array
    {
        $data = [
            'title' => 'Status Laporan Diperbarui',
            'message' => 'Laporan ' . $this->laporan->nomor_laporan . ' sekarang berstatus: ' . ucfirst($this->laporan->status),
            'laporan_id' => $this->laporan->id,
        ];

        // Tambahkan pesan khusus di notifikasi database juga jika mau
        if ($this->laporan->status === 'selesai') {
            $data['message'] .= '. Jangan lupa isi feedback yaa!';
        }

        return $data;
    }

    public function toDatabase(object $notifiable): DatabaseMessage
    {
        $message = "Status laporan '{$this->laporan->nomor_laporan}' telah berubah menjadi {$this->laporan->status}.";

        if ($this->laporan->status === 'selesai') {
            $message .= ' Jangan lupa isi feedback yaa!';
        }

        return new DatabaseMessage([
            'laporan_id' => $this->laporan->id,
            'nomor_laporan' => $this->laporan->nomor_laporan,
            'status' => ucfirst($this->laporan->status),
            'message' => $message,
        ]);
    }
}
