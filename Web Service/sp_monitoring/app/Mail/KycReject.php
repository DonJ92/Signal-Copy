<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class KycReject extends Mailable
{
    use Queueable, SerializesModels;
    public $email;
    public $reject_cause;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $reject_cause)
    {
        $this->email = $email;
        $this->reject_cause = $reject_cause;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.kycreject')
            ->subject(trans('message.mail.reject'));;
    }
}
