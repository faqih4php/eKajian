<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\RequestKajian;
use Illuminate\Notifications\Messages\DatabaseMessage;

class RequestKajianNotification extends Notification
{
    use Queueable;

    protected $requestKajian;

    /**
     * Create a new notification instance.
     */
    public function __construct(RequestKajian $requestKajian)
    {
        $this->requestKajian = $requestKajian;
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
            'request_kajian_id' => $this->requestKajian->id,
            'name' => $this->requestKajian->name,
            'tema_kajian' => $this->requestKajian->tema_kajian,
            'lokasi' => $this->requestKajian->lokasi,
            'waktu_kajian' => $this->requestKajian->waktu_kajian,
        ];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
