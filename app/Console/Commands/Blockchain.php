<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class Blockchain extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blockchain:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deliver Profit to All Users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $usersWithActivePlans = User::has('userActivePlan')->get();
        foreach ($usersWithActivePlans as $index => $user) {
            $profit = $user->userActivePlan->amount * $user->userActivePlan->plan->profit / 100;
            // adding balance to this user
            $transaction = $user->transactions()->firstOrCreate([
                'user_plan_id' => $user->userActivePlan->id,
                'type' => 'daily profit',
                'amount' => $profit,
                'sum' => true,
                'status' => true,
                'reference' => "Blockchain Auto Delivered Profit",
            ]);

            info("Daily Profit Delivered to User: " . $user->userActivePlan->user->name . " Profit is: " . $profit);
        }
    }
}
