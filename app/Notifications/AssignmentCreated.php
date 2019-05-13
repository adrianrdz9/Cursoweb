<?php

namespace App\Notifications;

use App\Assignment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\MailExtended;

use \App\Module;

class AssignmentCreated extends Notification
{
    use Queueable;

    private $assignment;

    /**
     * Create a new notification instance.
     *
     * @param Assignment $assignment
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
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailExtended)
            ->subject('¡Trabajo nuevo!')
            ->greeting('Nuevo trabajo en el curso web: '.$this->assignment->title.'('.$this->assignment->type.')'  )
            ->content(
                "<strong> Módulo: </strong>".
                Module::find($this->assignment->module_id)->name.
                $this->assignment->description
            )
            ->line("Tienes hasta el ".\Carbon\Carbon::create($this->assignment->deadline)->isoFormat('D [de] MMMM [de] YYYY [a las] h:mm a')." para entregar")
            ->action('Ver', route('assignment.show', ['id' => $this->assignment->id]))
            ->with(['outroLines' => 'Gracias por formar parte del curso web, éxito.']);
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
            'title' => $this->assignment->type." ".$this->assignment->title." ha sido creada.",
            'subtitle' => "Módulo: ".Module::find($this->assignment->module_id)->name,
            'description' => "Tienes hasta el ".\Carbon\Carbon::create($this->assignment->deadline)->isoFormat('D [de] MMMM [de] YYYY [a las] h:mm a').
                            " da click aquí para ver más detalles",
            'link_to' => route('assignment.show', ['id' => $this->assignment->id])
        ];
    }
}
