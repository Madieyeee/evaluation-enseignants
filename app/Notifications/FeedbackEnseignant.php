<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class FeedbackEnseignant extends Notification implements ShouldQueue
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
            'type' => 'feedback_enseignant',
            'title' => $this->data['title'] ?? 'Feedback enseignant',
            'message' => $this->data['message'] ?? 'Un enseignant a laissé un commentaire.',
            'evaluation_id' => $this->data['evaluation_id'] ?? null,
            'enseignant_id' => $this->data['enseignant_id'] ?? null,
            'icon' => 'message-square',
            'url' => $this->data['url'] ?? route('dashboard'),
        ];
    }
}
