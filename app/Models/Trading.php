<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trading extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'type', 'amount', 'status','profit','method'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
