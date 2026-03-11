<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class RapportDisponible extends Notification implements ShouldQueue
{
    use Queueable;

    protected array $data;

    /**
     * Create a new notification instance.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'rapport_disponible',
            'title' => $this->data['title'] ?? 'Rapport disponible',
            'message' => $this->data['message'] ?? 'Un nouveau rapport est disponible.',
            'rapport_type' => $this->data['rapport_type'] ?? null,
            'icon' => 'file-text',
            'url' => $this->data['url'] ?? route('dashboard'),
        ];
    }
}
