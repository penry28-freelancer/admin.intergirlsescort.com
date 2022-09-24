<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyCreateAccountMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $model;
    protected $form;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($model, $form)
    {
        $this->model = $model;
        $this->form = $form;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('client.mail.create_account', [
            'form' => $this->form,
            'model' => $this->model,
            'url' => route('apife.user.approval', $this->model['token']),
        ]);
    }
}
