<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EvaluateurRegisteredNotification extends Notification 
{
    use Queueable;

    protected $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['mail']; // Notification envoyée par email
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Bienvenue sur notre plateforme')
            ->greeting('Bonjour ' . $this->user->name . ',')
            ->line('Félicitations ! Vous avez été enregistré en tant qu\'évaluateur pour le **Prix du Ministre de la Microfinance et de l\'Économie Sociale et Solidaire pour la Promotion de l\'Inclusion Financière**.')
            ->line('Votre adresse email : ' . $this->user->email)
            ->action('Accéder à votre compte', url('/'))
            ->line('Merci de nous rejoindre !');
    }
}
