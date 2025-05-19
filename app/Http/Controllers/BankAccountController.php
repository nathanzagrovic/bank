<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\HasBankAccountService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class BankAccountController extends Controller
{
    use HasBankAccountService;

    public function __construct()
    {
        $this->initBankAccountService();
    }

    public function pinCheck(Request $request): Response
    {
        return response([
            'success' => $this->bankAccountService->checkPin($request->get('pin'))
        ]);
    }
}
