<?php

namespace App\Listeners;

use App\Events\DepositExecuted;
use App\Events\TransferExecuted;
use App\Events\WithdrawalExecuted;
use Illuminate\Support\Facades\Log;

class LogTransaction
{
    public function handle(DepositExecuted|TransferExecuted|WithdrawalExecuted $event): void
    {
        Log::info("{$event->name} executed", [
            'account' => $event->bankAccountService->getBankAccount()->id,
            'amount' => $event->amount,
            'new_balance' => $event->bankAccountService->getBankAccount()->balance,
        ]);

    }
}
