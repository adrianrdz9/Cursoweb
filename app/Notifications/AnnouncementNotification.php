<?php

namespace App\Notifications;

use App\Announcement;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AnnouncementNotification extends Notification
{
    use Queueable;

    /** @var Announcement */
    private $announcement;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($announcement)
    {
        $this->announcement = $announcement;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
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
                    ->subject('¡Aviso nuevo!')
                    ->greeting('Nuevo aviso en el curso web: '.$this->announcement->title)
                    ->content("<strong>Aviso</strong>".$this->announcement->description)
                    ->action('Ver', url('/'))
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
            'title' => "¡Aviso!",
            'subtitle' => $this->announcement->title,
            'description' => $this->announcement->description,
            'link_to' => '#'
        ];
    }
}
