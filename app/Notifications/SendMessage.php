<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendMessage extends Notification
{
    use Queueable;

    protected $text;
    protected $message;
    /**
     * Create a new notification instance.
     */
    public function __construct($text, $message)
    {
        $this->text = $text;
        $this->message = $message;
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
            ->line('Vous avez reçu un message dont le contenu est: ' . $this->message->body)
            ->line('Concernant le service:')
            ->action('Lien vers le détail du service', route('detail_service', $this->service->slug))
            ->action('Lire le message', url('chatify/'.$this->message));
                    /*->line($this->text)
                    ->action('Votre message ici', url('chatify/'.$this->message))
                    ->line('Merci d\'avoir utilise notre application');*/
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
