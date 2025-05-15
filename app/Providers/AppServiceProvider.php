<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\BankAccountService;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    $this->app->bind(BankAccountService::class, function ($app) {
        $user = User::find(1); // or ideally get the logged-in user
        return new BankAccountService($user->bankAccount);
    });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
