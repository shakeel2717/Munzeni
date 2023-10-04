<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Future extends Model
{
    use HasFactory;

    protected $fillable = [
        'trade',
        'type',
        'status',
        'timestamp',
    ];
}
