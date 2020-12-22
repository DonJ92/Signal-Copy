<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentConfirm extends Mailable
{
    use Queueable, SerializesModels;
    public $email;
    public $amount;
    public $datetime;
    public $txID;
    public $rate;
    public $qrs_amount;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $amount, $datetime, $txID, $rate, $qrs_amount)
    {
        $this->email = $email;
        $this->amount = $amount;
        $this->datetime = $datetime;
        $this->txID = $txID;
        $this->rate = $rate;
        $this->qrs_amount = $qrs_amount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.confirm')
            ->subject(trans('message.mail.confirm'));
    }

}