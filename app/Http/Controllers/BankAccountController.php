<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\BankAccountService;

class BankAccountController extends Controller
{

    public function transfer() {

        $user = User::find(1);
        
        $bankAccount = new BankAccountService($user->bankAccount);

        $to = BankAccount::where('account_number', 2341)->first();

        $bankAccount->transfer($to, 100);

        

    }

}
