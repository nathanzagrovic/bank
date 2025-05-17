<?php

namespace Tests\Feature\Bank;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\BankAccountService;

class WithdrawTest extends TestCase
{
    use RefreshDatabase;

    public function test_make_a_withdrawal(): void
    {
        $amount = 100;
        $this->seed();
        $user = User::inRandomOrder()->first();

        $bankAccountService = new BankAccountService($user->bankAccount);
        $previousBalance = $bankAccountService->getBankAccount()->balance;
        $bankAccountService->withdraw($amount);
        $user->refresh();

        $this->assertNotNull($bankAccountService);
        $this->assertTrue($bankAccountService->getBankAccount()->is($user->bankAccount));
        $this->assertEquals(($previousBalance - $amount), $user->bankAccount->balance);

        $this->assertDatabaseHas('transactions', [
            'bank_account_id' => $user->bankAccount->id,
            'recipient_id' => NULL,
            'amount' => $amount,
            'type' => Transaction::TYPE_WITHDRAWAL,
        ]);

    }
}
