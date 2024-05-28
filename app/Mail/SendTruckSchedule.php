<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendTruckSchedule extends Mailable
{
    use Queueable, SerializesModels;

    public $pdfLink;

    public function __construct($pdfLink)
    {
        $this->pdfLink = $pdfLink;
    }

    public function build()
    {
        return $this->view('emails.truck-schedule')
                    ->with(['pdfLink' => $this->pdfLink])
                    ->subject('Truck Schedule PDF');
    }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Send Truck Schedule',
    //     );
    // }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    // public function attachments(): array
    // {
    //     return [];
    // }
}
