<?php

namespace App\Services;

use App\Events\DepositExecuted;
use App\Events\TransferExecuted;
use App\Events\WithdrawalExecuted;
use App\Models\BankAccount;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

    public function getUser() {
        return $this->getBankAccount()->user;
    }

    public function checkPin(string $pin) : bool
    {
        return Hash::check($pin, $this->getBankAccount()->pin);
    }

    public function transfer(BankAccount $recipient, float $amount) : bool
    {
        $this->tryAction($this, $amount, 'transfer', $recipient);
        return false;
    }

    public function deposit(float $amount) : bool
    {
        return $this->tryAction($this, $amount, 'deposit');
    }

    public function withdraw(float $amount) : bool
    {
        $this->tryAction($this, $amount, 'withdraw');
        return false;
    }

    public function bankAccountLookup(int $identifier, $method = 'account_number')
    {
        return match ($method) {
            'id' => BankAccount::find($identifier)->first(),
            'account_number' =>  BankAccount::where('account_number', $identifier)->first(),
            default => false,
        };
    }

    public function tryAction(BankAccountService $bankAccountService, float $amount, string $type, BankAccount $recipient = NULL)
    {
        if ( $type === 'deposit' || $bankAccountService->balanceCheck($amount)) {
            try {
                return DB::transaction(function() use ($bankAccountService, $recipient, $amount, $type) {
                    switch ($type) {
                        case 'transfer':
                            $this->transferLogic($amount, $recipient ?: $this->getBankAccount());
                            break;
                        case 'withdraw':
                            $this->withdrawLogic($amount);
                            break;
                        case 'deposit':
                            $this->depositLogic($amount);
                            break;
                    }
                    return true;
                });
            }
            catch(\Exception $e) {
                Log::error($type . ' failed', [
                    'bank_account_id' => $bankAccountService->bankAccount->id,
                    'amount' => $amount,
                    'error' => $e->getMessage()
                ]);
            }
        }
        return false;
    }

    protected function transferLogic(float $amount, BankAccount $recipient): true
    {
        $this->getBankAccount()->decrement('balance', $amount);
        $recipient->increment('balance', $amount);
        Transaction::persistTransaction($this->getBankAccount(), Transaction::TYPE_TRANSFER, $amount, $recipient);
        TransferExecuted::dispatch($amount, $this);
        return true;
    }

    protected function depositLogic(float $amount): true
    {
        $this->getBankAccount()->increment('balance', $amount);
        Transaction::persistTransaction($this->getBankAccount(), Transaction::TYPE_DEPOSIT, $amount);
        DepositExecuted::dispatch($amount, $this);
        return true;
    }

    protected function withdrawLogic(float $amount): true
    {
        $this->getBankAccount()->decrement('balance', $amount);
        Transaction::persistTransaction($this->bankAccount, Transaction::TYPE_WITHDRAWAL, $amount);
        WithdrawalExecuted::dispatch($amount, $this);
        return true;
    }
}
