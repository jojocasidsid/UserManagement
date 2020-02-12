<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $password;

    public $fourdigitrandom;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $password, $fourdigitrandom)
    {
        $this->user = $user;
        $this->password = $password;
        $this->fourdigitrandom = $fourdigitrandom;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.verifyUser');
    }
}
