<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class FinanceController extends Controller
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
        return view('admin.finance.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string|exists:users',
            'amount' => 'required|numeric',
        ]);

        $user = User::where('username',$validatedData['username'])->firstOrFail();

        // checking if this money will plus or negtive
        if($validatedData['amount'] < 0){
            $validatedData['amount'] = str_replace('-','',$validatedData['amount']);
            $type = 'Balance Adjust';
            $sum = false;
        } else {
            // amount is -500, remove - from the amount
            $validatedData['amount'] = str_replace('-','',$validatedData['amount']);
            $type = 'Deposit';
            $sum = true;
        }

        // adding balance to this user
        $transaction = $user->transactions()->create([
            'type' => $type,
            'amount' => $validatedData['amount'],
            'sum' => $sum,
            'status' => true,
            'reference' => "Admin Action",
        ]);

        return back()->with('success','Deposit Added Successfully');
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
