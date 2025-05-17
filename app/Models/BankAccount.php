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

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'bank_account_id', 'id');
    }

    public function getBalance(): string
    {
        return number_format((float)$this->balance, 2, '.', '');
    }

}
