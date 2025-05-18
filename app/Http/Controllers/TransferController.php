<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransferPostRequest;
use App\Models\BankAccount;
use App\Services\BankAccountService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TransferController extends Controller
{
    protected BankAccount $bankAccount;
    public BankAccountService $bankAccountService;

    // TODO: Trait / abstract for constructor?

    public function __construct(BankAccount $bankAccount)
    {
        $this->bankAccount = auth()->user()->bankAccount;
        $this->bankAccountService = new BankAccountService($this->bankAccount);
    }

    public function index(): View
    {
        return view('transfer');
    }

    public function create(TransferPostRequest $request) : RedirectResponse
    {
        $validated = $request->validated();
        $recipient = $this->bankAccountService->bankAccountLookup($validated['recipient_account_number']);
        $this->bankAccountService->transfer($recipient, $validated['amount']);
        return Redirect::route('transfer.index')->with('status', 'success');
    }

}
