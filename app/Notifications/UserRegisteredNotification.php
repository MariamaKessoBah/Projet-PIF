<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserRegisteredNotification extends Notification
{
    use Queueable;

    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Bienvenue sur notre plateforme')
            ->greeting('Bonjour ' . $this->user->name . '!')
            ->line('Merci de vous être inscrit sur notre plateforme.')
            ->action('Confirmer votre email', url('/verify-email?email=' . $this->user->email))
            ->line('Si vous n’avez pas demandé cet email, veuillez ignorer ce message.');
    }
}
