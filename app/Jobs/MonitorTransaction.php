<?php

namespace App\Jobs;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MonitorTransaction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->transaction->isSuccess())
            return ;

        $minute = config('constants.minutes_decline_transaction');

        if($this->transaction->created_at->diffInMinutes() > $minute + 1) {
            $this->transaction->markDeclined();
            return ;
        }

        // handle send email into user here

        $this->release(now()->addMinutes(ceil($minute / $this->tries)));
    }
}
