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
        $admin = User::firstOrCreate([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'user_code' => "MZ" . rand(0000000, 99999999),
            'email_verified_at' => now(),
            'password' => bcrypt('asdfasdf'),
        ]);


        $user = User::firstOrCreate([
            'name' => 'Shakeel Ahmad',
            'username' => 'shakeel2717',
            'email' => 'shakeel2717@gmail.com',
            'email_verified_at' => now(),
            'user_code' => "MZ" . rand(0000000, 99999999),
            'refer' => 'default',
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

        // $user = User::firstOrCreate([
        //     'name' => 'Test 1',
        //     'username' => 'test1',
        //     'email' => 'test1@gmail.com',
        //     'email_verified_at' => now(),
        //     'refer' => $user->username,
        //     'password' => bcrypt('asdfasdf'),
        // ]);

        // // adding balance to this user
        // $transaction = $user->transactions()->create([
        //     'type' => 'deposit',
        //     'amount' => 100,
        //     'sum' => true,
        //     'status' => true,
        //     'reference' => "Database Seed",
        // ]);

        // $user = User::firstOrCreate([
        //     'name' => 'Test 2',
        //     'username' => 'test2',
        //     'email' => 'test2@gmail.com',
        //     'email_verified_at' => now(),
        //     'refer' => $user->username,
        //     'password' => bcrypt('asdfasdf'),
        // ]);

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
            'name' => 'Tether',
            'symbol' => 'USDT',
            'network' => 'BEP20',
            'code' => 'USDT.BEP20',
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
            'key' => 'min_deposit',
            'value' => 10,
        ]);

        $setting = Setting::firstOrCreate([
            'key' => 'min_withdraw',
            'value' => 10,
        ]);

        $setting = Setting::firstOrCreate([
            'key' => 'plan_active_fees',
            'value' => 0,
        ]);

        $setting = Setting::firstOrCreate([
            'key' => 'direct_level_1_commission',
            'value' => 10,
        ]);

        $setting = Setting::firstOrCreate([
            'key' => 'direct_level_2_commission',
            'value' => 5,
        ]);

        $setting = Setting::firstOrCreate([
            'key' => 'trade_level_1_commission',
            'value' => 2,
        ]);

        $setting = Setting::firstOrCreate([
            'key' => 'trade_level_2_commission',
            'value' => 1,
        ]);

        $setting = Setting::firstOrCreate([
            'key' => 'winner_charges',
            'value' => 5,
        ]);

        $setting = Setting::firstOrCreate([
            'key' => 'bitcoin_rate_update',
            'value' => 5,
        ]);


        $setting = Setting::firstOrCreate([
            'key' => 'one_mi_trade_profit',
            'value' => 2,
        ]);


        $setting = Setting::firstOrCreate([
            'key' => 'five_mi_trade_profit',
            'value' => 5,
        ]);


        $setting = Setting::firstOrCreate([
            'key' => 'telegram_link',
            'value' => 'https://telegram.org/',
        ]);

        $setting = Setting::firstOrCreate([
            'key' => 'facebook_link',
            'value' => 'https://telegram.org/',
        ]);

        $setting = Setting::firstOrCreate([
            'key' => 'instagram_link',
            'value' => 'https://telegram.org/',
        ]);

        $setting = Setting::firstOrCreate([
            'key' => 'tiktok_link',
            'value' => 'https://telegram.org/',
        ]);

        $setting = Setting::firstOrCreate([
            'key' => 'youtube_link',
            'value' => 'https://telegram.org/',
        ]);

        $setting = Setting::firstOrCreate([
            'key' => 'binance_usdt_deposit_address',
            'value' => 'TYT5KQrcDimBSExcGhfN7nfRrFHHAhDVYq',
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
