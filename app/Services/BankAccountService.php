<?php

namespace App\Services;

use App\Events\MoneyDeposited;
use App\Models\BankAccount;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BankAccountService
{
    protected BankAccount $bankAccount;

    public function __construct(BankAccount $bankAccount) {
        $this->bankAccount = $bankAccount;
    }

    public function getBankAccount() : BankAccount
    {
        return $this->bankAccount;
    }

    public function balanceCheck(int $amount) : bool
    {
        if ($this->bankAccount->balance < $amount) {
            abort(403, 'Insufficient balance.');
        }

        return true;
    }

    public function checkPin(int $pin) : bool
    {
        return $pin === $this->bankAccount->getPin();
    }

    public function transfer(BankAccount $recipient, int $amount)
    {
        if ($this->balanceCheck($amount)) {
            DB::transaction(function($recipient, $amount) {
                $this->bankAccount->balance -= $amount;
                $recipient->balance += $amount;

                $this->bankAccount->save();
                $recipient->save();

                Log::info('Transfer executed', [
                    'sender' => $this->bankAccount->user->name,
                    'recipient' => $recipient->user->name,
                    'amount' => $amount,
                ]);
            });
        }
    }

    public function deposit(int $amount) : bool
    {
        try {
            return DB::transaction(function() use ($amount) {
                $this->bankAccount->increment('balance', $amount);
                Transaction::create([
                    'bank_account_id' => $this->bankAccount->id,
                    'type' => Transaction::TYPE_DEPOSIT,
                    'recipient_id' => $this->bankAccount->id,
                    'amount' => $amount
                ]);
                MoneyDeposited::dispatch($amount, $this);
                return true;
            });
        }
        catch (\Exception $e) {
            Log::error('Deposit Failed', [
                'bank_account_id' => $this->bankAccount->id,
                'amount' => $amount,
                'error' => $e->getMessage()
            ]);

            return false;
        }
    }

    public function withdraw(int $amount) : bool
    {
        if ($this->balanceCheck($amount)) {
            try {
                return DB::transaction(function() use ($amount) {
                    $this->bankAccount->decrement('balance', $amount);
                    Transaction::create([
                        'bank_account_id' => $this->bankAccount->id,
                        'type' => Transaction::TYPE_WITHDRAWAL,
                        'recipient_id' => $this->bankAccount->id,
                        'amount' => $amount
                    ]);
                    return true;
                });
            }
            catch(\Exception $e) {
                Log::error('Withdrawal Failed', [
                    'bank_account_id' => $this->bankAccount->id,
                    'amount' => $amount,
                    'error' => $e->getMessage()
                ]);
                return false;
            }
        }
        return false;

    }

}
