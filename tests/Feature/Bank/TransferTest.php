<?php

namespace Tests\Feature\Bank;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\BankAccountService;

class TransferTest extends TestCase
{
    use RefreshDatabase;

    public function test_make_a_transfer(): void
    {
        $amount = 100;
        $this->seed();
        $sender = User::inRandomOrder()->first();
        $recipient = User::where('id', '!=', $sender->id)->first();
        $bankAccountService = new BankAccountService($sender->bankAccount);

        $senderPreviousBalance = $sender->bankAccount->balance;
        $recipientPreviousBalance = $recipient->bankAccount->balance;

        $this->assertNotNull($recipient, 'Recipient user not found');
        $this->assertNotNull($bankAccountService);
        $this->assertTrue($bankAccountService->getBankAccount()->is($sender->bankAccount));

        $bankAccountService->transfer($recipient->bankAccount, $amount);

        $sender->refresh();
        $recipient->refresh();

        $this->assertEquals(
            $senderPreviousBalance - $amount,
            $sender->bankAccount->balance,
            'Sender balance did not decrease correctly'
        );

        $this->assertEquals(
            $recipientPreviousBalance + $amount,
            $recipient->bankAccount->balance,
            'Recipient balance did not increase correctly'
        );

        $this->assertDatabaseHas('transactions', [
            'bank_account_id' => $sender->bankAccount->id,
            'recipient_id' => $recipient->bankAccount->id,
            'amount' => $amount,
            'type' => Transaction::TYPE_TRANSFER,
        ]);

    }
}
