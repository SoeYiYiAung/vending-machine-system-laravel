<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::orderBy($request->get('sort','name'), $request->get('order','asc'))
                    ->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized'); // Only admin can access
        }

        return view('products.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized'); // Only admin can store
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0.01',
            'quantity_available' => 'required|integer|min:0'
        ]);

        Product::create($request->only('name', 'price', 'quantity_available'));

        return redirect()->route('products.index')->with('success','Product created.');
    }

    public function edit(Product $product)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized'); // Only admin can edit
        }

        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized'); // Only admin can update
        }

        $request->validate([
            'name'=>'required|string|max:255',
            'price'=>'required|numeric|min:0.01',
            'quantity_available'=>'required|integer|min:0'
        ]);

        $product->update($request->only('name','price','quantity_available'));

        return redirect()->route('products.index')->with('success','Product updated.');
    }

    public function destroy(Product $product)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized'); 
        }

        $product->delete();
        return redirect()->route('products.index')->with('success','Product deleted.');
    }
    public function purchaseForm(Product $product)
    {
        return view('products.purchase', compact('product'));
    }

    // handle the purchase submission
    public function purchase(Product $product)
    {
        $quantity = request()->input('quantity', 1);

        if ($product->quantity_available < $quantity) {
            return back()->with('error', 'Not enough stock available.');
        }

        $product->quantity_available -= $quantity;
        $product->save();

        // log transaction
        Transaction::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'quantity' => $quantity,
            'total_price' => $product->price * $quantity,
            'created_at'  => now(),  
            'updated_at'  => now(),
        ]);

        return redirect()->route('products.index')->with('success', 'Purchase successful!');
    }
}
