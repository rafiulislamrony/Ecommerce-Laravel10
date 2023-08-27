<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $info = $this->data;

        return $this->from('info@gmail.com')
            ->view('mail.invoice', compact('info'))
            ->subject('Invoice Details');
    }

    public function envelope(): Envelope
    {
        return new Envelope();
    }

    // Remove the content() method if not needed

    public function attachments(): array
    {
        return [];
    }
}

