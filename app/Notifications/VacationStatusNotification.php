<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class VacationStatusNotification extends Notification
{
    use Queueable;

    protected $vacation;
    protected $status;

    public function __construct($vacation, $status)
    {
        $this->vacation = $vacation;
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['database']; // Solo notificación en base de datos
    }

    public function toArray($notifiable)
    {
        return [
            'vacation_id' => $this->vacation->id,
            'start_date' => $this->vacation->start_date,
            'end_date' => $this->vacation->end_date,
            'status' => $this->status,
            'message' => $this->status == 'aprobado'
                ? '¡Tus vacaciones han sido aprobadas!'
                : 'Tus vacaciones han sido rechazadas',
            'url' => '/vacations' // Ruta para redirigir al hacer clic
        ];
    }
}