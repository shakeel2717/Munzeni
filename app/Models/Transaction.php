<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'amount',
        'status',
        'sum',
        'reference',
        'withdraw_id',
        'trading_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function withdraw()
    {
        return $this->belongsTo(Withdraw::class);
    }
}
