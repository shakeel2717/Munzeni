<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'role',
        'password',
    ];

    public function getBalance($user_id)
    {
        $in = Transaction::where('user_id', $user_id)->where('sum', true)->sum('amount');
        $out = Transaction::where('user_id', $user_id)->where('sum', false)->sum('amount');
        return $in - $out;
    }


    public function allIncome($user_id)
    {
        $in = Transaction::where('user_id', $user_id)->where('type', '!=', 'deposit')->where('sum', true)->sum('amount');
        return $in;
    }

    public function allWithdraw($user_id)
    {
        $in = Transaction::where('user_id', $user_id)->where('type', 'withdraw')->where('sum', false)->sum('amount');
        return $in;
    }










    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
