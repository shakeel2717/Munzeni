<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Currency;
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
    }
}
