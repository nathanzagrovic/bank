<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class TransferController extends Controller
{
    public function index(): View
    {
        return view('transfer');
    }

    public function create(Request $request)
    {
        dd($request->all());
    }

}
