<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['customer', 'product'])->paginate(10);

        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();

        return view('transactions.create', compact('customers', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'transaction_date' => 'required|date',
        ]);

        $product = Product::findOrFail($request->product_id);
        $total_price = $product->price * $request->quantity;

        Transaction::create([
            'customer_id' => $request->customer_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total_price' => $total_price,
            'transaction_date' => $request->transaction_date,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function show($id)
    {
        $transaction = Transaction::with(['customer', 'product'])->findOrFail($id);

        return view('transactions.show', compact('transaction'));
    }

    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);

        $customers = Customer::all();
        $products = Product::all();

        return view('transactions.edit', compact('transaction', 'customers', 'products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'transaction_date' => 'required|date',
        ]);

        $transaction = Transaction::findOrFail($id);
        $product = Product::findOrFail($request->product_id);
        $total_price = $product->price * $request->quantity;

        $transaction->update([
            'customer_id' => $request->customer_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total_price' => $total_price,
            'transaction_date' => $request->transaction_date,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diupdate.');
    }

    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);

        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
