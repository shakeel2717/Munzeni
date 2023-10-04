<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kyc extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'front',
        'back',
        'status',
        'name',
        'dob',
        'mobile',
        'gender',
        'country',
        'address',
        'zip',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
