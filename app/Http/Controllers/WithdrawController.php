<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $currencies = Currency::where('status', true)->get();
        return view('user.withdraw.create', compact('currencies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'currency_id' => 'required|string|exists:currencies,id',
            'amount' => 'required|numeric|digits_between:1,999999',
            'wallet' => 'required|string|min:12',
        ]);

        // checking if available balance is enough
        if (auth()->user()->getBalance() < $validatedData['amount']) {
            return back()->withErrors(['Insufficient Balance']);
        }

        $withdraw = auth()->user()->withdraws()->create([
            'currency_id' => $validatedData['currency_id'],
            'wallet' => $validatedData['wallet'],
            'amount' => $validatedData['amount'],
        ]);

        // adding balance to this user
        $transaction = auth()->user()->transactions()->create([
            'withdraw_id' => $withdraw->id,
            'type' => 'withdraw',
            'amount' => $validatedData['amount'],
            'sum' => false,
            'status' => false,
            'reference' => "Withdrawal Request to : " . $validatedData['wallet'],
        ]);



        return back()->with('success', 'Deposit Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
