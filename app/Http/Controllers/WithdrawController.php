<?php

namespace App\Http\Controllers;

use App\Http\Requests\WithdrawPostRequest;
use App\Models\BankAccount;
use App\Services\BankAccountService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class WithdrawController extends Controller
{
    protected BankAccount $bankAccount;
    public BankAccountService $bankAccountService;

    // TODO: Trait / abstract for constructor? Also add validator to constructor

    public function __construct(BankAccount $bankAccount)
    {
        $this->bankAccount = auth()->user()->bankAccount;
        $this->bankAccountService = new BankAccountService($this->bankAccount);
    }

    public function index(): View
    {
        return view('withdraw');
    }

    public function create(WithdrawPostRequest $request) : RedirectResponse
    {
        $validated = $request->validated();
        $this->bankAccountService->withdraw($validated['amount']);
        return Redirect::route('withdraw.index')->with('status', 'success');

    }
}
