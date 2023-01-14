<?php

namespace App\Repositories\Transaction;

use App\Repositories\EloquentRepository;
use Illuminate\Support\Str;

class TransactionRepository extends EloquentRepository implements TransactionRepositoryInterface
{
    public function model()
    {
        return \App\Models\Transaction::class;
    }

    public function generateTransactionId()
    {
        $transactionId = $this->_makeRandomTransactionId();
        while($this->model->where('transaction_id', $transactionId)->exists()) {
            $transactionId = $this->_makeRandomTransactionId();
        }
        return $transactionId;
    }

    private function _makeRandomTransactionId(): string
    {
        return Str::upper(Str::random(config('constants.transaction_id.length')));
    }
}
