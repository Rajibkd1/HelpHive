<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;

    // Constructor to initialize OTP
    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    // Build the email message
    public function build()
    {
        return $this->subject('Your OTP for Registration')
                    ->view('emails.otp');
    }
}
