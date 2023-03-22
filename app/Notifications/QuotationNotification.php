<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class QuotationNotification extends Notification
{
    use Queueable;

    protected $quotations;
    protected $user;

    public function __construct($quotations, $user)
    {
        $this->quotations = $quotations;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }


    public function toDatabase($notifiable)
    {
        return [
            'sender_id'         => $this->user->id,
            'sender_name'       => $this->user->name,
            'quotations'        => $this->quotations
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'sender_id'         => $this->user->id,
            'sender_name'       => $this->user->name,
            'quotations'        => $this->quotations
        ]);
    }
}
