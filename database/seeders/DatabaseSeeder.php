<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\BankAccount;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Bill Smith',
            'email' => 'bill@microsoft.com',
            'password' => Hash::make('password')
        ]);

        User::create([
            'name' => 'Sarah Graham',
            'email' => 'sarah@eso.com',
            'password' => Hash::make('password')
        ]);

        BankAccount::create([
            'user_id' => 1,
            'account_number'=> 1337,
            'balance' => 500.00,
            'pin' => Hash::make('1234'),
        ]);

        BankAccount::create([
            'user_id' => 2,
            'account_number'=> 1234,
            'balance' => 200.00,
            'pin' => Hash::make('9541'),
        ]);
    }
}
