<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $transactions = Transaction::all();
        $count = $transactions->count();
        $total_sum = 0;
        foreach ($transactions as $transaction) {
            $total_sum += $transaction->amount;
        }

        return view('transactions.index', compact('transactions', 'count', 'total_sum'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'employee_name' => 'required|string|max:255',
            'sender_name' => 'required|string|max:255',
            'sender_transaction_number' => 'required|string|unique:transactions',
            'receiver_transaction_number' => 'required|string|unique:transactions',
            'amount' => 'required|numeric|min:0'
        ]);

        Transaction::create($validated);

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
        return view('transactions.edit', compact('transaction'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
        $validated = $request->validate([
            'employee_name' => 'required|string|max:255',
            'sender_name' => 'required|string|max:255',
            'sender_transaction_number' => 'required|string|unique:transactions,sender_transaction_number,'.$transaction->id,
            'receiver_transaction_number' => 'required|string|unique:transactions,receiver_transaction_number,'.$transaction->id,
            'amount' => 'required|numeric|min:0'
        ]);

        $transaction->update($validated);

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Transaction $transaction)
    {
        //
        $transaction->delete();

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction deleted successfully.');
    }
}
