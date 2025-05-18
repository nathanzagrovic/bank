<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\HasBankAccountService;
use App\Http\Requests\DepositPostRequest;
use App\Models\BankAccount;
use App\Services\BankAccountService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

// TODO: Trait / abstract for constructor?

class DepositController extends Controller
{

    use HasBankAccountService;

    public function __construct()
    {
     $this->initBankAccountService();
    }

    public function index(): View
    {
        return view('deposit');
    }

    public function create(DepositPostRequest $request) : RedirectResponse
    {
        $validated = $request->validated();;
        $this->bankAccountService->deposit($validated['amount']);
        return Redirect::route('deposit.index')->with('status', 'success');

    }
}
