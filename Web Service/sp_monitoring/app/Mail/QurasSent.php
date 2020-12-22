<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 3/11/2019
 * Time: 4:41 PM
 */

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QurasSent extends Mailable
{
    use Queueable, SerializesModels;
    public $email;
    public $payment_amount;
    public $payment_datetime;
    public $payment_txID;
    public $qrs_address;
    public $qrs_amount;
    public $qrs_txID;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $payment_amount, $payment_datetime, $payment_txID, $qrs_address, $qrs_amount, $qrs_txID)
    {
        $this->email = $email;
        $this->payment_amount = $payment_amount;
        $this->payment_datetime = $payment_datetime;
        $this->payment_txID = $payment_txID;
        $this->qrs_address = $qrs_address;
        $this->qrs_amount = $qrs_amount;
        $this->qrs_txID = $qrs_txID;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.qurassent')
            ->subject(trans('message.mail.qurassent'));
    }
}