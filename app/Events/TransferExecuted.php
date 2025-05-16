<?php

namespace App\Events;

use App\Models\Transaction;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Services\BankAccountService;

class TransferExecuted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public float $amount;
    public BankAccountService $bankAccountService;
    public string $name = Transaction::TYPE_TRANSFER;

    public function __construct(int $amount, BankAccountService $bankAccountService)
    {
        $this->amount = $amount;
        $this->bankAccountService = $bankAccountService;
    }
}
