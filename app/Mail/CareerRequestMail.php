<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
//classe creata con php artisan make:mail CareerRequestMail
class CareerRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    
    public $info;
     
    public function __construct($info)
    {
        $this->info=$info;//come la classe deve gestire le informazioni dell'utente

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Richiesta di lavoro ricevuta!',//inseriamo informazioni riguardo il dettaglio della mail
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.career-request-mail',//inseriamo quale vista vogliamo l'utente visualizzi quando riceve la mail
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
