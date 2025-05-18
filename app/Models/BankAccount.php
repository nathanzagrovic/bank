<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Services\BankAccountService;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mockery\Expectation;

class BankAccount extends Model
{
    protected  $balance;
    protected $pin;

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return Transaction::where(function ($query) {
            $query->where('bank_account_id', $this->id)
                ->orWhere('recipient_id', $this->id);
        });
    }

    public function getBalance(): string
    {
        return number_format((float)$this->balance, 2, '.', '');
    }

}
