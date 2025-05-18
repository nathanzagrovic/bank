<?php

namespace App\Http\Controllers\Traits;

use App\Models\BankAccount;
use App\Services\BankAccountService;

trait HasBankAccountService
{
    protected BankAccount $bankAccount;
    public BankAccountService $bankAccountService;

    public function initBankAccountService(): void
    {
        $this->bankAccount = auth()->user()->bankAccount;
        $this->bankAccountService = new BankAccountService($this->bankAccount);
    }
}
