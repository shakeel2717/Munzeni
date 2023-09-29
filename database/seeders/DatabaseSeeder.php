<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Currency;
use App\Models\Plan;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::firstOrCreate([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'email_verified_at' => now(),
            'password' => bcrypt('asdfasdf'),
        ]);


        $user = User::firstOrCreate([
            'name' => 'Shakeel Ahmad',
            'username' => 'shakeel2717',
            'email' => 'shakeel2717@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('asdfasdf'),
        ]);

        // adding balance to this user
        $transaction = $user->transactions()->create([
            'type' => 'deposit',
            'amount' => 100,
            'sum' => true,
            'status' => true,
            'reference' => "Database Seed",
        ]);

        $currency = Currency::firstOrCreate([
            'name' => 'Tether',
            'symbol' => 'USDT',
            'network' => 'TRC20',
            'code' => 'USDT.TRC20',
        ]);

        $currency = Currency::firstOrCreate([
            'name' => 'Bitcoin',
            'symbol' => 'BTC',
            'network' => 'BTC',
            'code' => 'BTC',
        ]);


        $setting = Setting::firstOrCreate([
            'key' => 'withdraw_fees',
            'value' => 5,
        ]);

        $setting = Setting::firstOrCreate([
            'key' => 'withdraw',
            'value' => true,
        ]);

        $setting = Setting::firstOrCreate([
            'key' => 'min_withdraw',
            'value' => 10,
        ]);

        $setting = Setting::firstOrCreate([
            'key' => 'plan_active_fees',
            'value' => 10,
        ]);

        $plan = Plan::firstOrCreate([
            'name' => 'Basic',
            'profit' => 1.5,
            'duration' => 7,
            'min_invest' => 20,
            'max_invest' => 49,
            'return' => true,
        ]);

        $plan = Plan::firstOrCreate([
            'name' => 'Advanced',
            'profit' => 2,
            'duration' => 15,
            'min_invest' => 50,
            'max_invest' => 99,
            'return' => true,
        ]);

        $plan = Plan::firstOrCreate([
            'name' => 'Professional',
            'profit' => 4,
            'duration' => 30,
            'min_invest' => 100,
            'max_invest' => 10000000,
            'return' => true,
        ]);
    }
}
