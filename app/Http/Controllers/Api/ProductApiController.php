<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;

class ProductApiController extends Controller
{
    // List all products
    public function index()
    {
        return response()->json(Product::all());
        // return 'OK';
    }

    // Show a single product
    public function show(Product $product)
    {
        return response()->json($product);
    }

    // Purchase a product
    public function purchase(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->quantity_available
        ]);

        $quantity = $request->input('quantity');

        // Decrease product stock
        $product->decrement('quantity_available', $quantity);

        // Log transaction
        $transaction = Transaction::create([
            'user_id' => auth('api')->id(),
            'product_id' => $product->id,
            'quantity' => $quantity,
            'total_price' => $product->price * $quantity,
        ]);

        return response()->json([
            'message' => 'Purchase successful',
            'transaction' => $transaction
        ]);
    }
}
