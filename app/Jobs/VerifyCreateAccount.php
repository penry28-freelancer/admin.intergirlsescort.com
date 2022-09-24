<?php

namespace App\Jobs;

use App\Mail\VerifyCreateAccountMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class VerifyCreateAccount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $model;
    protected $form;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($model, $form)
    {
        $this->model = $model;
        $this->form = $form;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new VerifyCreateAccountMail($this->model, $this->form);

        Mail::to($this->model['email'])
            ->send($email);
    }
}
