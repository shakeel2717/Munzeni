<?php

namespace App\Http\Controllers;

use App\Models\Kyc;
use Illuminate\Http\Request;

class KycController extends Controller
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
        return view('user.kyc.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'front' => 'required|image',
            'back' => 'required|image',
            'name' => 'required',
            'dob' => 'required',
            'mobile' => 'required',
            'gender' => 'required',
            'country' => 'required',
            'address' => 'required',
            'zip' => 'required',
        ]);

        // checking if already applied
        if (auth()->user()->kyc) {
            return back()->withErrors(['Already applied for KYC']);
        }

        $front = $request->file('front');
        $front_name = auth()->user()->username . time() . rand(00, 11) . '.' . $front->getClientOriginalExtension();
        $front->move(public_path('kyc/'), $front_name);

        $back = $request->file('back');
        $back_name = auth()->user()->username . time() . rand(00, 11) . '.' . $back->getClientOriginalExtension();
        $back->move(public_path('kyc/'), $back_name);

        $kyc = Kyc::updateOrCreate([
            'user_id' => auth()->user()->id,
        ], [
            'front' => $front_name,
            'back' => $back_name,
            'name' => $validatedData['name'],
            'dob' => $validatedData['dob'],
            'mobile' => $validatedData['mobile'],
            'gender' => $validatedData['gender'],
            'country' => $validatedData['country'],
            'address' => $validatedData['address'],
            'zip' => $validatedData['zip'],
        ]);

        return back()->with('success', 'Kyc Approval Request sent successfully');
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
