<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * @param  array  $data  Gevalideerde form‐gegevens
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this
            ->subject('Nieuw contactformulier bericht')
            ->markdown('emails.contact.submitted')
            ->with('data', $this->data);
    }
}
