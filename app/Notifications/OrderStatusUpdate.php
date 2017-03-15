<?php

namespace OlympicDrive\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use OlympicDrive\Models\Entities\Eloquent\Order;

class OrderStatusUpdate extends Notification {
    
    use Queueable;
    
    
    public function __construct(Order $order) {
        $this->order = $order;
    }
    
    public function via($notifiable) {
        return ['mail'];
    }
    
    public function toMail($notifiable) {
        $url = url('/commandes/'.$this->order->id);
        $status = $this->order->getStatusArray();
        
        return (new MailMessage)
            ->subject('Olympic-Drive - Changement de status de votre commande #'.$this->order->id)
            ->greeting('Bonjour '.$notifiable->firstname)
            ->line('Le status de votre commande #'.$this->order->id. ' est passé à: '. $status[$this->order->status])
            ->line('Vous pouvez suivre le status de votre commande à tout moment sur votre espace personnel.')
            ->action('Consulter ma commande', $url)
            ->line('Merci pour votre commande chez Olympic Drive!')
            ->line('Cordialement,')
            ->salutation('L\'équipe d\'Olympic drive');
    }
    
    public function toArray($notifiable) {
        return [
            'order' => $notifiable->id
        ];
    }
}
