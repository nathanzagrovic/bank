<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\HasBankAccountService;
use App\Http\Requests\DepositPostRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

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
        $validated = $request->validated();
        $amount = (float) $validated['amount'];
        $this->bankAccountService->deposit($amount);
        return Redirect::route('deposit.index')->with('status', 'success');
    }
}
