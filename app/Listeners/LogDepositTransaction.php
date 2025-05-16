<?php

namespace App\Listeners;

use App\Events\MoneyDeposited;
use App\Models\Transaction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LogDepositTransaction
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(MoneyDeposited $event): void
    {
        Log::info('Deposit executed', [
            'account' => $event->bankAccountService->getBankAccount()->id,
            'amount' => $event->amount,
            'new_balance' => $event->bankAccountService->getBankAccount()->getBalance(),
        ]);

    }
}
