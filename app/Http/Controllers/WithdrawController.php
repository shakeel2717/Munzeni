<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Utilities\Authenticator;
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
            'amount' => 'required|numeric|digits_between:1,999999',
            'code' => 'nullable|numeric',
        ]);

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

        // checking if this user kyc ic complete
        // if (auth()->user()->kyc_status != 'approved') {
        //     return back()->withErrors(['Please Complete your KYC First.']);
        // }

        // checking if available balance is enough
        if (auth()->user()->getBalance() < $validatedData['amount']) {
            return back()->withErrors(['Insufficient Balance']);
        }

        // one withdraw request per day per user, checking if this user already have a withdraw request today
        if (auth()->user()->withdraws()->where('created_at', '>=', now()->subDays(1))->count() > 0) {
            return back()->withErrors(['You already have a withdraw request today, Please try again tomorrow']);
        }

        // checking if this user 
        if (!auth()->user()->eligibleForWithdraw()) {
            return back()->withErrors(['Bonus Funds Found, you Can\'t Request for Withdraw until you perform trade or investment in mining']);
        }

        // checking if available balance is enough
        if (!isset(auth()->user()->wallet)) {
            return redirect()->route('user.wallet.index')->withErrors(['Please Update Your wallet First']);
        }

        // checking if available balance is enough
        if (settings('withdraw') == false) {
            return back()->withErrors(['Withdraw Temporary Off, Please try again later']);
        }

        if (settings('min_withdraw') > $validatedData['amount']) {
            return back()->withErrors(['Min Withdraw Amount is: ' . settings('min_withdraw')]);
        }

        $amount = $validatedData['amount'];

        // checking if withdrawal fees is enable
        if (settings('withdraw_fees') > 0) {
            $fees = $validatedData['amount'] * settings('withdraw_fees') / 100;
            $amount = $amount - $fees;
        }


        $withdraw = auth()->user()->withdraws()->create([
            'currency_id' => auth()->user()->wallet->currency_id,
            'wallet' => auth()->user()->wallet->wallet,
            'amount' => $amount,
        ]);

        // adding balance to this user
        $transaction = auth()->user()->transactions()->create([
            'withdraw_id' => $withdraw->id,
            'type' => 'withdraw',
            'amount' => $amount,
            'sum' => false,
            'status' => false,
            'reference' => "Withdrawal Request: " . auth()->user()->wallet->wallet . " Currency: " . auth()->user()->wallet->currency->code,
        ]);

        if (settings('withdraw_fees') > 0) {
            $transaction = auth()->user()->transactions()->create([
                'withdraw_id' => $withdraw->id,
                'type' => 'withdraw fees',
                'amount' => $fees,
                'sum' => false,
                'status' => false,
                'reference' => "Total Withdraw Amount: " . $amount . " to : " . auth()->user()->wallet->wallet,
            ]);
        }

        return back()->with('success', 'Withdraw Request Successfully Sent');
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
