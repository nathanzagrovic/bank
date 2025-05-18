<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected Authenticatable $user;

    public function __construct()
    {
        $this->user = auth()->user();
    }

    public function index() {
        $transactions = $this->user->bankAccount->transactions()->orderBy('created_at', 'DESC')->limit(6)->get();
        return view('dashboard', compact('transactions'));
    }

}
