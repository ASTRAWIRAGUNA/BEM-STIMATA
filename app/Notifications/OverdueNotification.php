<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OverdueNotification extends Notification implements ShouldQueue
{
    use Queueable;
    
    protected $peminjaman;
    /**
     * Create a new notification instance.
     */
    public function __construct($peminjaman)
    {
        $this->peminjaman = $peminjaman;
        // Terapkan middleware checkRole untuk memastikan hanya role 'Kominfo' yang dapat mengakses
       

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toDatabase($notifiable)
    {
         // Menyimpan pesan notifikasi di database
         return [
            'peminjaman_id' => $this->peminjaman->id,
            'message' => 'Peminjaman barang "' . $this->peminjaman->inventory->item_name . '" telah lewat tenggat waktu pengembalian.',
            'status' => 'Overdue',
        ];
    }

    // /**
    //  * Get the array representation of the notification.
    //  *
    //  * @return array<string, mixed>
    //  */
    // public function toArray(object $notifiable): array
    // {
    //     return [
    //         //
    //     ];
    // }
}
