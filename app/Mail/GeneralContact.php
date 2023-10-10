<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Public\GeneralQuery;

class GeneralContact extends Mailable
{
    use Queueable;
    use SerializesModels;
    /**
     * User instance
     *
     * @var GeneralQuery
     */
    public $contact;

    public function __construct(GeneralQuery $contact)
    {
        $this->contact = $contact;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('General Query: '.$this->contact->subject)
            ->view('emails.generalQuery');
    }
}
