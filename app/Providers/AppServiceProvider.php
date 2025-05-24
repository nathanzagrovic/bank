<?php

namespace App\Providers;

use App\Support\TinkerHelper;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Services\BankAccountService;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(BankAccountService::class, function ($app) {
            $user = auth()->id();
            return new BankAccountService($user->bankAccount);
        });
    }

    public function boot(): void
    {
        AliasLoader::getInstance()->alias('TinkerHelper', TinkerHelper::class);
        View::composer('*', function ($view) {
            $user = Auth::user();
            $bankBalance = null;

            if ($user && $user->bankAccount) {
                $bankBalance = $user->bankAccount->balance;
            }

            $view->with('bankBalance', $bankBalance);
        });
    }
}
