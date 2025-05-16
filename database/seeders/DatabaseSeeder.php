<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\BankAccount;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // TODO: Update to factories

        User::create([
            'name' => 'Bill Smith',
            'email' => 'bill@microsoft.com',
            'password' => ''
        ]);

        User::create([
            'name' => 'Sarah Graham',
            'email' => 'sarah@eso.com',
            'password' => ''
        ]);

        BankAccount::create([
            'user_id' => 1,
            'account_number'=> 1337,
            'balance' => 500,
            'pin' => 1234,
        ]);

        BankAccount::create([
            'user_id' => 2,
            'account_number'=> 8271,
            'balance' => 200,
            'pin' => 9541,
        ]);
    }
}
