<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactoMailable extends Mailable
{
    use Queueable, SerializesModels;

    public string $nombre;
    public string $email;
    public string $mensaje;

    public function __construct(string $nombre, string $email, string $mensaje)
    {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->mensaje = $mensaje;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            // El remitente real es el usuario: replying responde directo a quien escribió.
            replyTo: [$this->email],
            subject: 'Consulta desde el sitio web - ' . $this->nombre,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contacto',
        );
    }
}