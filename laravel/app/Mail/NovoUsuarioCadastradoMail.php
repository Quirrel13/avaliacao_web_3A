<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NovoUsuarioCadastradoMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public string $senhaProvisoria;

    public function __construct(User $user, string $senhaProvisoria)
    {
        $this->user = $user;
        $this->senhaProvisoria = $senhaProvisoria;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bem-vindo ao IFBank - Suas credenciais de acesso',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.novo_usuario',
        );
    }
}