<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\HasBankAccountService;
use App\Http\Requests\TransferPostRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TransferController extends Controller
{
    use HasBankAccountService;

    public function __construct()
    {
        $this->initBankAccountService();
    }

    public function index(): View
    {
        return view('transfer');
    }

    public function create(TransferPostRequest $request) : RedirectResponse
    {
        $validated = $request->validated();
        $recipient = $this->bankAccountService->bankAccountLookup($validated['recipient_account_number']);

        if($recipient) {
            $status = 'success';
            $this->bankAccountService->transfer($recipient, $validated['amount']);
        } else {
            $status = 'failure';
        }


        return Redirect::route('transfer.index')->with('status', $status);
    }

}
