<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NouvelleEvaluation extends Notification implements ShouldQueue
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
            'type' => 'nouvelle_evaluation',
            'title' => $this->data['title'] ?? 'Nouvelle évaluation',
            'message' => $this->data['message'] ?? 'Une nouvelle évaluation a été soumise.',
            'evaluation_id' => $this->data['evaluation_id'] ?? null,
            'enseignant_id' => $this->data['enseignant_id'] ?? null,
            'etudiant_id' => $this->data['etudiant_id'] ?? null,
            'icon' => 'clipboard-check',
            'url' => $this->data['url'] ?? route('dashboard'),
        ];
    }
}
