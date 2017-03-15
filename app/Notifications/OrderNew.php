<?php

namespace OlympicDrive\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use OlympicDrive\Models\Entities\Eloquent\Order;

class OrderNew extends Notification {
    
    use Queueable;
    
    protected $order;
    
    public function __construct(Order $order) {
        $this->order = $order;
    }
    
    public function via($notifiable) {
        return ['mail'];
    }
    
    public function toMail($notifiable) {
        $url = url('/admin/orders/'.$this->order->id.'/edit');
        
        return (new MailMessage)
            ->subject('Olympic-Drive - Nouvelle commande')
            ->greeting('Bonjour '.$notifiable->firstname)
            ->line('Une nouvelle commande vient d\'être faite sur Olympic-drive')
            ->action('Consulter la commande', $url)
            ->salutation('');
    }
    
    public function toArray($notifiable) {
        return [
            'order' => $this->order
        ];
    }
}
