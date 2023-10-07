<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currencies = Currency::where('status', true)->get();
        return view('user.deposit.index', compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric'
        ]);

        // checking if deposit amount is enough
        if ($validatedData['amount'] < settings('min_deposit')) {
            return back()->withErrors(['Minimum Withdrawal Limit is: ' . settings('min_deposit')]);
        }
        $wallet = settings('binance_usdt_deposit_address');
        return view('user.deposit.address', compact('wallet', 'validatedData'));
    }


    public function verify(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric|min:1',
            'hash_id' => 'required|string|unique:tids,hash_id',
        ]);

        $hash_id = str()->of($validatedData['hash_id'])->replace('Internal transfer ', '', false);

        // checking if this user request already pending
        // if (auth()->user()->pending_tids()->get()->count() > 0) {
        //     return back()->withErrors(['Your Deposit Request Already Received, Please wait!']);
        // }

        auth()->user()->tids()->create([
            'hash_id' => $hash_id,
            'amount' => $validatedData['amount'],
        ]);

        return redirect()->route('user.dashboard.index')->with('success', 'Deposit Request Sent Successfully');
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
