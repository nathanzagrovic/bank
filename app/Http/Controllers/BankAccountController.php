<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\HasBankAccountService;
use App\Models\BankAccount;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class BankAccountController extends Controller
{
    use HasBankAccountService;

    public function __construct()
    {
        $this->initBankAccountService();
    }

    public function accountCheck(Request $request) : JsonResponse
    {
        $exists = false;
        $accountNumber = $request->get('recipient_lookup') ?: $request->get('account_number');

        if($accountNumber) {
            $exists = BankAccount::where('account_number', $accountNumber)->exists();
        }

        return response()->json([
            'exists' => $exists,
        ]);

    }

    public function pinCheck(Request $request): Response
    {
        return response([
            'success' => $this->bankAccountService->checkPin($request->get('pin'))
        ]);
    }
}
