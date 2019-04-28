<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use \App\Module;

class AssignmentCreated extends Notification
{
    use Queueable;

    private $assignment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($assignment)
    {
        $this->assignment = $assignment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title' => "La ".$this->assignment->type." ".$this->assignment->title." ha sido creada.",
            'subtitle' => "Modulo: ".Module::find($this->assignment->module_id)->name,
            'description' => "Tienes hasta el ".\Carbon\Carbon::create($this->assignment->deadline)->isoFormat('D [de] MMMM [de] YYYY [a las] h:mm a').
                            " da click aquí para ver más detalles",
            'link_to' => route('assignment.show', ['id' => $this->assignment->id])
        ];
    }
}
