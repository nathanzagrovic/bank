<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepositPostRequest;
use App\Models\BankAccount;
use App\Services\BankAccountService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DepositController extends Controller
{
    protected BankAccount $bankAccount;
    public BankAccountService $bankAccountService;

    public function __construct(BankAccount $bankAccount)
    {
        $this->bankAccount = auth()->user()->bankAccount;
        $this->bankAccountService = new BankAccountService($this->bankAccount);
    }

    public function index()
    {;
        return view('deposit');
    }

    public function create(DepositPostRequest $request) : RedirectResponse
    {
        $validated = $request->validated();;
        $this->bankAccountService->deposit($validated['amount']);
        return Redirect::route('deposit.index')->with('status', 'success');

    }
}
