<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdviceActivity extends Mailable
{
    public $usuario;
    public $actividad;
    public $proyecto;
    public $etapa;
    public $subject = "SER - Nueva Actividad Registrada";

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $activity, $project, $stage)
    {
        $this->usuario = $user;
        $this->actividad = $activity;
        $this->proyecto = $project;
        $this->etapa = $stage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.advice-activity');
    }
}
