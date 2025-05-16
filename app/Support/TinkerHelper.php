<?php

namespace App\Support;

use App\Models\User;
use App\Services\BankAccountService;

class TinkerHelper {

    public static function bank() : BankAccountService
    {
        $user = User::find(1);
        return new BankAccountService($user->bankAccount);
    }

}
