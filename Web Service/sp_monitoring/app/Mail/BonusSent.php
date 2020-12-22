<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 3/11/2019
 * Time: 10:45 AM
 */

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BonusSent extends Mailable
{
    use Queueable, SerializesModels;
    public $from_email;
    public $to_email;
    public $amount;
    public $bonus_amount;
    public $datetime;
    public $txID;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($from_email, $to_email, $amount, $bonus_amount, $datetime, $txID)
    {
        $this->from_email = $from_email;
        $this->to_email = $to_email;
        $this->amount = $amount;
        $this->bonus_amount = $bonus_amount;
        $this->datetime = $datetime;
        $this->txID = $txID;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.bonussent')
            ->subject(trans('message.mail.bonussent'));
    }
}