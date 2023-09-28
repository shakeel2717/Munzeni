<?php

use App\Models\Setting;

function settings($string)
{
    return Setting::where('key', $string)->first()->value;
}
