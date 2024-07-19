<?php

namespace App\Mail;

use App\Models\Note;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendNotes extends Mailable {
    use Queueable, SerializesModels;


    public ?Note $note;
    public string $noteUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(Note $note, string $noteUrl) {
        $this->note = $note;
        $this->noteUrl = $noteUrl;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope {
        return new Envelope(
            from: $this->note->user->email,
            subject: "You have a new note from {$this->note->user->name}",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content {
        return new Content(
            view: 'emails.send-notes',
            with: [
                'note' => $this->note,
                'noteUrl' => $this->noteUrl,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array {
        return [];
    }
}
