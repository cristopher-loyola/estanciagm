<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VacationStatusNotification extends Notification
{
    use Queueable;

    protected $vacation;
    protected $status;
    protected $url;

    public function __construct($vacation, $status, $url)
    {
        $this->vacation = $vacation;
        $this->status = $status;
        $this->url = $url;
    }

    // Método REQUERIDO: especifica los canales de notificación
    public function via($notifiable)
    {
        return ['database', 'mail']; // Puedes usar uno o ambos
    }

    // Método para notificaciones en la base de datos
    public function toDatabase($notifiable)
    {
        return [
            'vacation_id' => $this->vacation->id,
            'status' => $this->status,
            'message' => "Tu solicitud de vacaciones ha sido {$this->status}",
            'url' => $this->url,
        ];
    }

    // Método para notificaciones por email
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("Estado de tus vacaciones: {$this->status}")
            ->line("Tu solicitud de vacaciones ha sido {$this->status}.")
            ->action('Ver calendario', $this->url)
            ->line('¡Gracias por usar nuestro sistema!');
    }
}