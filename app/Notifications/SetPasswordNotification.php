<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * Le token de réinitialisation de mot de passe.
     *
     * @var string
     */
    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url(route('evaluateur.password.set', [
            'token' => $this->token, 
            'email' => $notifiable->email  // Assurez-vous que c'est bien notifiable->email et non getEmailForPasswordReset()
        ], false));

        return (new MailMessage)
            ->subject('Définissez votre mot de passe - Prix du Ministre de la Microfinance')
            ->greeting('Bonjour ' . $notifiable->name . ',')
            ->line('Félicitations ! Vous avez été enregistré en tant qu\'évaluateur pour le **Prix du Ministre de la Microfinance et de l\'Économie Sociale et Solidaire pour la Promotion de l\'Inclusion Financière**.')
            ->line('Votre adresse email : ' . $notifiable->email)
            ->line('Pour finaliser la création de votre compte, veuillez définir votre mot de passe en cliquant sur le bouton ci-dessous :')
            ->action('Définir mon mot de passe', $url)
            ->line('Merci de nous rejoindre !');
    }
}