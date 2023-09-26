<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendService extends Notification
{
    use Queueable;

    protected $text;
    protected $message;
    protected $data_id;

    /**
     * Create a new notification instance.
     */
    public function __construct($text, $message, $data_id)
    {
        $this->text = $text;
        $this->message = $message;
        $this->data_id = $data_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line($this->text)
            ->action('Votre message ici', url('chatify/'.$this->message. ' et le detail du service ici :', url('detail_service', $this->data_id)))
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
