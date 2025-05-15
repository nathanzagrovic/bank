<?php

namespace App\Services;

use App\Models\BankAccount;
use Illuminate\Support\Facades\Log;

class BankAccountService
{
    private $bankAccount;

    public function __construct(BankAccount $bankAccount) {
        $this->bankAccount = $bankAccount;
    }

    public function getBalance() {
        return $this->bankAccount->balance;
    }

    public function balanceCheck($amount) {
        if ($this->getBalance() < $amount) {
            return abort(403, 'Insufficent balance.');
        }
    }

    public function pinCheck($pin) {
        return $pin === $this->bankAccount->pin;
    }

    public function transfer(BankAccount $recepient, int $amount) {

        if (!$recepient) {
            return abort(403, 'No account found');
        }

        $this->balanceCheck($amount);
        
        $this->bankAccount->balance -= $amount;
        $recepient->balance += $amount;

        $this->bankAccount->save();
        $recepient->save();

        Log::info('Transfer executed', [
            'sender' => $this->bankAccount->user->name,
            'recipient' => $recepient->user->name,
            'amount' => $amount,
        ]);

    }

    public function deposit($amount) {
        $this->bankAccount->balance += $amount;
        $this->bankAccount->save();


        Log::info('Deposit executed', [
            'account' => $this->bankAccount->id,
            'amount' => $amount,
            'new_balance' => $this->getBalance(),
        ]);       
    }

    public function widthdraw($amount) {

        $this->balanceCheck($amount);

        $this->bankAccount->balance -= $amount;
        $this->bankAccount->save();

        Log::info('Withdrawl executed', [
            'account' => $this->bankAccount->id,
            'amount' => $amount,
            'new_balance' => $this->getBalance(),
        ]);

    }

}
