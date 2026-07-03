<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SeriesCreated extends Mailable {
    use Queueable, SerializesModels;

    public function __construct(public string $nomeSerie, public int $idSerie, public int $seasonsQty, public int $episodesPerSeason) {
        $this->subject = "Série $nomeSerie criada!";
    }

    public function envelope(): Envelope {
        return new Envelope(
            subject: 'Series Created',
        );
    }

    public function content(): Content {
        return new Content(
            markdown: 'mail.series-created',
        );
    }

    public function attachments(): array {
        return [];
    }
}
