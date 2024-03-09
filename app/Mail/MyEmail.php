<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Course;

class MyEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param  string  $token
     * @param  string  $link
     * @return void
     */

     public function __construct($token, $link, $courseName)
     {
         $this->token = $token;
         $this->link = $link;
         $this->courseName = $courseName;
     }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Formulaire Ifosup'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
{
    return (new Content(
        view: 'mail' // Assurez-vous que 'mail' est le nom de votre vue Blade
    ))->with(['token' => $this->token, 'link' => $this->link, 'courseName' => $this->courseName]); // Passez les variables $token et $link à la vue
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
