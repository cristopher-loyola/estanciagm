<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class VacationStatusNotification extends Notification
{
    use Queueable;

    protected $status;

    public function __construct($status)
    {
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['database']; // Solo notificación en base de datos
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "Tus vacaciones han sido {$this->status}",
            'status' => $this->status
        ];
    }
}