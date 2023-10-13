<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.plan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.plan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:plans,name',
            'profit' => 'required|numeric|min:1',
            'duration' => 'required|numeric|min:1',
            'min_invest' => 'required|numeric|min:1',
            'max_invest' => 'required|numeric|min:1',
            'return' => 'required|boolean',
            'special' => 'required|boolean',
        ]);

        if ($validatedData['min_invest'] > $validatedData['max_invest']) {
            return redirect()->back()->with('error', 'Min invest can not be greater then max invest');
        }

        $plan = Plan::firstOrCreate([
            'name' => $validatedData['name'],
            'profit' => $validatedData['profit'],
            'duration' => $validatedData['duration'],
            'min_invest' => $validatedData['min_invest'],
            'max_invest' => $validatedData['max_invest'],
            'return' => $validatedData['return'],
            'special' => $validatedData['special'],
        ]);

        return redirect()->route('admin.plan.index')->with('success', 'Plan created successfully');
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
