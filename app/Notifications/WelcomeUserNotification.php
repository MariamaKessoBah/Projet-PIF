<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeUserNotification extends Notification 
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
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
        $userName = $notifiable->name ?? 'Cher utilisateur';

        return (new MailMessage)
            ->subject('🎉 Bienvenue sur PIF – Votre Aventure Commence !')
            ->greeting('Bonjour ' . $userName . ',')
            ->line('🎊 Félicitations ! Vous venez de rejoindre la plateforme du **Prix du Ministre de la Microfinance et de l\'Économie Sociale et Solidaire pour la Promotion de l\'Inclusion Financière**.')
            ->line('🚀 Nous sommes ravis de vous accueillir parmi nous et espérons que votre expérience sera enrichissante et inspirante.')
            ->line('💡 N\'hésitez pas à explorer la plateforme, découvrir les opportunités et soumettre votre candidature.')
            ->action('✨ Accéder à mon compte', url('/'))
            ->line('📩 Une question ? Besoin d\'aide ? Contactez notre équipe de support à l\'adresse suivante : prixmmess@microfinance-ess.gouv.sn.')
            ->line('🙏 Merci de votre confiance et bienvenue dans la communauté PIF !')
            ->salutation('À très bientôt,  
            **L\'équipe PIF**');
    }
    
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Bienvenue sur PIF !',
            'url' => url('/'),
        ];
    }
}
