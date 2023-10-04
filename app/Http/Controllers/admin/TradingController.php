<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Future;
use Illuminate\Http\Request;

class TradingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.trading.index');
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
            'trade' => 'required|string',
            'type' => 'required|string',
            'timestamp' => 'required|integer',
        ]);

        $future = new Future();
        $future->type = $validatedData['type'];
        $future->trade = $validatedData['trade'];
        $future->timestamp = $validatedData['timestamp'];
        $future->status = true;
        $future->save();

        return back()->with('success', 'Future Trading Added');
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
