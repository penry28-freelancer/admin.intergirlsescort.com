<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RemindPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $_email;
    protected $_token;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $token)
    {
        $this->_email = $email;
        $this->_token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('client.mail.remind_password', [
            'email' => $this->_email,
            'url' => route('apife.user.set-password', ['hash' => $this->_token])
        ]);
    }
}
