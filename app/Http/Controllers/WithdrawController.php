<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\HasBankAccountService;
use App\Http\Requests\WithdrawPostRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class WithdrawController extends Controller
{
    use HasBankAccountService;

    public function __construct()
    {
        $this->initBankAccountService();
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
