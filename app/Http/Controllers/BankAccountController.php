<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\HasBankAccountService;

class BankAccountController extends Controller
{
    use HasBankAccountService;

    public function __construct()
    {
        $this->initBankAccountService();
    }

    public function pinCheck() {
        dd($this->bankAccountService->getBankAccount());
    }
}
