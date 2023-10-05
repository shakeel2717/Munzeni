<?php

namespace App\Http\Controllers;

use App\Events\PlanActivation;
use App\Models\Plan;
use App\Models\UserPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = Plan::get();
        return view('user.plan.index', compact('plans'));
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
            'plan_id' => 'required|exists:plans,id',
            'amount' => 'required|min:1|max:99999999999',
        ]);

        // getting this plan
        $plan = Plan::findOrFail($validatedData['plan_id']);

        // chekcing if this user have valid active plan
        $checkPlan = UserPlan::where('user_id', auth()->user()->id)->where('status', true)->count();
        if ($checkPlan > 0) {
            return back()->withErrors(['You already have a active plan.']);
        }

        // checking if available balance is enough
        if (auth()->user()->getBalance() < $validatedData['amount']) {
            return back()->withErrors(['Insufficient Balance']);
        }

        // checking if this plan is valid
        if ($validatedData['amount'] <= $plan->min_invest && $validatedData['amount'] >= $plan->max_invest) {
            return back()->withErrors(['Min amount to invest ' . $plan->min_invest . ' and max amount: ' . $plan->max_invest]);
        }

        $amount = $validatedData['amount'];
        $plan_active_fees = settings('plan_active_fees');

        if ($plan_active_fees > 0) {
            $fees =  $amount * $plan_active_fees / 100;
            $amount = $amount - $fees;
        }

        try {
            DB::beginTransaction();

            // activating User Plan
            $userPlan = auth()->user()->userPlan()->create([
                'plan_id' => $plan->id,
                'amount' => $amount,
                'expiry_date' => now()->addDays($plan->duration),
                'status' => true,
            ]);



            $transaction = auth()->user()->transactions()->create([
                'user_plan_id' => $userPlan->id,
                'type' => 'plan active',
                'amount' => $amount,
                'sum' => false,
                'status' => false,
                'reference' => "Invest in Plan : " . $plan->name,
            ]);

            if ($plan_active_fees > 0) {
                $transaction = auth()->user()->transactions()->create([
                    'user_plan_id' => $userPlan->id,
                    'type' => 'plan active fees',
                    'amount' => $fees,
                    'sum' => false,
                    'status' => false,
                    'reference' => "Invest fees in Plan : " . $plan->name,
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(["Error: " . $e->getMessage()]);
        }

        PlanActivation::dispatch($userPlan);

        return back()->with('success', 'Plan Activated Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan $plan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        //
    }
}
