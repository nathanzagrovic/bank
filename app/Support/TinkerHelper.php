<?php

namespace App\Support;

use App\Models\User;
use App\Services\BankAccountService;

class TinkerHelper {

    public static function bank($id = 1) : BankAccountService
    {
        $user = User::find(1);
        return new BankAccountService($user->bankAccount);
    }

}
