<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Http;

function settings($string)
{
    return Setting::where('key', $string)->first()->value;
}

function fetchLiveResult()
{
    $currency = "BTC";
    $apiKey = env('BINANCE_API_KEY');
    $response = Http::withHeaders([
        'X-MBX-APIKEY' => $apiKey,
    ])->get('https://api.binance.com/api/v3/ticker/price', [
        'symbol' => $currency . "USDT",
    ]);

    $liveRate = $response->json();
    return $liveRate['price'];
}
