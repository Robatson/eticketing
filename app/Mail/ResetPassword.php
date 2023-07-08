<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;
    public $reset_pss;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reset_pss)
    {
        //
        $this->reset_pss = $reset_pss;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Mail from rmaibam71@gmail.com')->view('email.forgot_password');
    }
}
