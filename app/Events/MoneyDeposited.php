<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Services\BankAccountService;

class MoneyDeposited
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public float $amount;
    public BankAccountService $bankAccountService;

    public function __construct(int $amount, BankAccountService $bankAccountService)
    {
        $this->amount = $amount;
        $this->bankAccountService = $bankAccountService;
    }
}
