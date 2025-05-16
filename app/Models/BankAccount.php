<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Services\BankAccountService;
use Mockery\Expectation;

class BankAccount extends Model
{
    protected  $balance;
    protected $pin;

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getPin() {
        return $this->pin;
    }

}
