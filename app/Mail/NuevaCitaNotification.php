<?php

namespace App\Mail;

use App\Models\Cita;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NuevaCitaNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Cita $cita) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nueva Cita Médica Agendada',
        );
    }

    public function content(): Content
    {
        return new Content(
            htmlString: "<p>Hola Doctor(a), tiene una nueva cita agendada para la especialidad de {$this->cita->especialidad}.</p>",
        );
    }
}