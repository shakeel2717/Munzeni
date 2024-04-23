<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Wallet;
use App\Utilities\Authenticator;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currencies = Currency::where('status', true)->get();
        return view('user.wallet.index', compact('currencies'));
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
            'currency_id' => 'required|string|exists:currencies,id',
            'wallet' => 'required|string|min:12',
            'code' => 'nullable|numeric',
        ]);

        // checking if this wallet is already added for another users
        $checkwallet = Wallet::where('wallet', $validatedData['wallet'])->where('user_id', '!=', auth()->user()->id)->count();
        if ($checkwallet > 0) {
            return back()->withErrors(['This Wallet Is already Added by Someone else, Please add another.']);
        }

        // checking authenticator code
        // if (auth()->user()->authenticator) {
        //     $authenticator = new Authenticator();
        //     $checkCode = $authenticator->verifyCode(auth()->user()->authenticator_code, $validatedData['code'], 0);
        //     if (!$checkCode) {
        //         return back()->withErrors(['Invalid code,Please try again']);
        //     }
        // } else {
        //     return back()->withErrors(['Please Activate Google Authentication on your account first.']);
        // }

        
        $wallet = Wallet::updateOrCreate([
            'user_id' => auth()->user()->id,
        ], [
            'currency_id' => $validatedData['currency_id'],
            'wallet' => $validatedData['wallet'],
        ]);

        return back()->with('success', 'New Wallet Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Wallet $wallet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Wallet $wallet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Wallet $wallet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Wallet $wallet)
    {
        //
    }
}
