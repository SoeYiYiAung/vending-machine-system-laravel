<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;

class TransactionApiController extends Controller
{
    // List all transactions (admin only)
    public function index()
    {
        $user = auth('api')->user();

        if ($user->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $transactions = Transaction::with('user', 'product')->get();

        return response()->json($transactions);
    }
}
