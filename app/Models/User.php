<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
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
        'status',
        'kyc_status',
        'refer',
        'password',
        'user_code',
        'authenticator',
        'authenticator_code'
    ];

    public function getBalance()
    {
        $in = Transaction::where('user_id',  $this->id)->where('sum', true)->sum('amount');
        $out = Transaction::where('user_id', $this->id)->where('sum', false)->sum('amount');
        return $in - $out;
    }


    public function allIncome()
    {
        $in = Transaction::where('user_id', $this->id)->where('type', '!=', 'deposit')->where('sum', true)->sum('amount');
        return $in;
    }

    public function allWithdraw()
    {
        $in = Transaction::where('user_id', $this->id)->where('type', 'withdraw')->where('sum', false)->sum('amount');
        return $in;
    }

    public function totalProfit()
    {
        $in = Transaction::where('user_id', $this->id)->where('type', 'daily profit')->where('sum', true)->sum('amount');
        return $in;
    }

    public function directCommission()
    {
        $in = Transaction::where('user_id', $this->id)->where('type', 'direct commission')->where('sum', true)->sum('amount');
        return $in;
    }

    public function eligibleForWithdraw()
    {
        $in = Transaction::where('user_id', $this->id)->where('type', 'deposit bonus')->where('sum', true)->count();
        if ($in > 0) {
            if (auth()->user()->tradings->count() > 0 || auth()->user()->userPlan->count() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    public function totalTodayProfit()
    {
        $in = Transaction::where('user_id', $this->id)
            ->whereDate('created_at', Carbon::today())
            ->where('type', 'daily profit')
            ->where('sum', true)->sum('amount');
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

    public function withdraws()
    {
        return $this->hasMany(Withdraw::class);
    }

    public function userPlan()
    {
        return $this->hasMany(UserPlan::class);
    }

    public function userActivePlan()
    {
        return $this->hasOne(UserPlan::class)->where('status', true);
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function kyc()
    {
        return $this->hasOne(Kyc::class);
    }

    public function pending_tids()
    {
        return $this->hasMany(Tid::class)->where('status', false);
    }

    public function tids()
    {
        return $this->hasMany(Tid::class);
    }

    public function tradings()
    {
        return $this->hasMany(Trading::class);
    }
}
