<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Only logged-in users can view
    }

    // List all transactions (admin can see all, user sees own)
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            $transactions = Transaction::with('user','product')->latest()->paginate(10);
        } else {
            $transactions = Transaction::with('product')
                            ->where('user_id', auth()->id())
                            ->latest()
                            ->paginate(10);
        }

        return view('transactions.index', compact('transactions'));
    }
}
