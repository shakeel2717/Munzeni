<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.profile.password');
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
            'current_password' => 'required|string|min:8',
            'password' => 'required|confirmed|string|min:8',
        ]);

        // checking if this user password is correct
        if (!Hash::check($validatedData['current_password'], auth()->user()->password)) {
            return back()->withErrors(['Current password is incorrect, Please try again']);
        }

        // updating this user record
        auth()->user()->password = bcrypt($validatedData['password']);
        auth()->user()->save();

        session(['hashed_password' => auth()->user()->password]);

        return back()->with('success', 'Password updated successfully');
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
