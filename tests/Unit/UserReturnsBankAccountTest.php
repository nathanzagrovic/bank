<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserReturnsBankAccountTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_returns_bank_account(): void
    {
        $this->seed();
        $user = User::find(1);
        $this->assertNotNull($user->bankAccount);
    }
}
