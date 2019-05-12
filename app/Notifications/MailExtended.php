<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;

class MailExtended extends MailMessage
{

    /**
     * Datos de la notificación
     *
     * @var string|null
     */
    public $viewData;

    /**
     * Establecer el contenido de la notificación
     *
     * @param $content
     *
     * @return $this
     */
    public function content($content){
        $this->viewData['content'] = $content;

        return $this;
    }

    /**
     * Obtener todos los datos de la notificación
     *
     * @return array
     */
    public function data(){
        return array_merge($this->toArray(), $this->viewData);
    }

}
