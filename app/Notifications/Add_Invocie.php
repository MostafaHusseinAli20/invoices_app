<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Invoices;
use Illuminate\Support\Facades\Auth;

class Add_Invocie extends Notification
{
    use Queueable;

    private $Invoice;

    /**
     * Create a new notification instance.
     */
    public function __construct(Invoices $Invoice)
    {
        $this->Invoice = $Invoice;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'id' => $this->Invoice->id,
            'title' => 'تم اضافة فاتورة بواسطة ',
            'user' => Auth::user()->name,
        ];
    }
}
