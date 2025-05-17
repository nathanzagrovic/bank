<?php

namespace App\Providers;

use App\Support\TinkerHelper;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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
