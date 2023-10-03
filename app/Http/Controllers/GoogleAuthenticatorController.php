<?php

namespace App\Http\Controllers;

use App\Utilities\Authenticator;
use Illuminate\Http\Request;

class GoogleAuthenticatorController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'secret' => 'required|string',
            'code' => 'required|integer',
        ]);

        $authenticator = new Authenticator();
        $checkCode = $authenticator->verifyCode($validatedData['secret'], $validatedData['code'], 0);
        if (!$checkCode) {
            return back()->withErrors(['Invalid code,Please try again']);
        }

        auth()->user()->authenticator_code = $validatedData['secret'];
        auth()->user()->authenticator = true;
        auth()->user()->save();
        return back()->with('success', 'Google Authenticate Enabled Successfully');
    }


    public function deactivate(Request $request)
    {
        $validatedData = $request->validate([
            'code' => 'required|integer',
        ]);

        $authenticator = new Authenticator();
        $checkCode = $authenticator->verifyCode(auth()->user()->authenticator_code, $validatedData['code'], 0);
        if (!$checkCode) {
            return back()->withErrors(['Invalid code,Please try again']);
        }

        auth()->user()->authenticator_code = null;
        auth()->user()->authenticator = false;
        auth()->user()->save();
        return back()->with('success', 'Google Authenticate Deactivated Successfully');
    }


    public function code()
    {
        return view('auth.google');
    }


    public function codeReq(Request $request)
    {
        $validatedData = $request->validate([
            'code' => 'required|numeric',
        ]);

        $authenticator = new Authenticator();
        $checkCode = $authenticator->verifyCode(auth()->user()->authenticator_code, $validatedData['code'], 0);
        if (!$checkCode) {
            return back()->withErrors(['Invalid code,Please try again']);
        }

        session(['google'=> true]);
        return redirect()->route('user.dashboard.index');
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
