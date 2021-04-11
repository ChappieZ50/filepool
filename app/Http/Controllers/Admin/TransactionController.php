<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $transactions = Transaction::orderByDesc('id');
        if ($request->has('s')) {
            $s = $request->get('s');
            $transactions->whereHas('user', function ($q) use ($s) {
                return $q->where('username', 'like', '%' . $s . '%');
            })->orWhereHas('product', function ($q) use ($s) {
                return $q->where('name', 'like', '%' . $s . '%');
            });
        }
        return view('fpool.transactions.transactions')->with('transactions', $transactions->paginate());
    }
}
