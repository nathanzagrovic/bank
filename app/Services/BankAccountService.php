<?php

namespace App\Services;

use App\Models\BankAccount;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class BankAccountService
{
    private BankAccount $bankAccount;

    public function __construct(BankAccount $bankAccount) {
        $this->bankAccount = $bankAccount;
    }

    public function getBalance() : int
    {
        return $this->bankAccount->balance;
    }

    public function balanceCheck(int $amount) : bool
    {
        if ($this->getBalance() < $amount) {
            abort(403, 'Insufficient balance.');
        }

        return true;
    }

    public function checkPin(int $pin) : bool
    {
        return $pin === $this->getCustomer()->pin;
    }

    public function transfer(BankAccount $recipient, int $amount)
    {
        $this->balanceCheck($amount);

        $this->bankAccount->balance -= $amount;
        $recipient->balance += $amount;

        $this->bankAccount->save();
        $recipient->save();

        Log::info('Transfer executed', [
            'sender' => $this->bankAccount->user->name,
            'recipient' => $recipient->user->name,
            'amount' => $amount,
        ]);

    }

    public function deposit(int $amount) : bool
    {
        $this->bankAccount->balance += $amount;

        Log::info('Deposit executed', [
            'account' => $this->bankAccount->id,
            'amount' => $amount,
            'new_balance' => $this->getBalance(),
        ]);

        return $this->bankAccount->save();
    }

    public function getCustomer() : User
    {
        return $this->bankAccount->user;
    }

    public function withdraw(int $amount) : bool
    {
        $this->balanceCheck($amount);

        $this->bankAccount->balance -= $amount;

        Log::info('Withdrawal executed', [
            'account' => $this->bankAccount->id,
            'amount' => $amount,
            'new_balance' => $this->getBalance(),
        ]);

        return $this->bankAccount->save();

    }

}
