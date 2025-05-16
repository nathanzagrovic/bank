<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    public const TYPE_DEPOSIT = 'deposit';
    public const TYPE_WITHDRAWAL = 'withdraw';
    public const TYPE_TRANSFER = 'transfer';

    protected $fillable = [
        'bank_account_id', 'type', 'amount', 'recipient_id'
    ];

    public function account() : belongsTo
    {
        return $this->belongsTo(BankAccount::class);
    }

    public function recipient() : belongsTo
    {
        return $this->belongsTo(BankAccount::class, 'recipient_id');
    }
}
