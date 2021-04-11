<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', auth()->user()->id)->orderByDesc('id')->paginate();
        return view('user.transactions')->with('transactions', $transactions);
    }
}
