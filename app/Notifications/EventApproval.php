<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EventApproval extends Notification
{
    use Queueable;

    protected $event;
    protected $status;

    /**
     * Create a new notification instance.
     *
     * @param  \App\Models\Event  $event
     * @param  int  $status
     * @return void
     */
    public function __construct($event, $status)
    {
        $this->event = $event;
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $statusMessage = $this->status == 1 ? 'approved' : 'rejected';
        return [
            'event_id' => $this->event->id,
            'message' => 'Event has been ' . ($this->status == 1 ? 'approved' : 'rejected') . '.',
            'description' => $this->event->name . ' has been ' . ($this->status == 1 ? 'approved' : 'rejected')
        ];
    }
}
