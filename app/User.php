<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function bankAccount()
    {
        return $this->hasOne('App\BankDetail');
    }

    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

    public function userLevel()
    {
        return $this->hasOne('App\UserLevel');
    }

    public function downlines()
    {
        return $this->hasMany('App\UserDownline');
    }

    public function upline()
    {
        return $this->hasOne('App\UserDownline', 'downline_user_id');
    }
}