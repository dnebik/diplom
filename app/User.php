<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = "users";
    public $timestamps = false;



    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    public static function getUser(): \Illuminate\Contracts\Auth\Authenticatable
    {
        $user = Auth::user();
//        unset($user['id']);
        unset($user['login']);
        unset($user['password']);
        unset($user['unit']);
        unset($user['status']);
        unset($user['remember_token']);
        return $user;
    }
    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable
     */
    public function clear(): \Illuminate\Contracts\Auth\Authenticatable
    {
        $user = $this;
//        unset($user['id']);
        unset($user['login']);
        unset($user['password']);
        unset($user['unit']);
        unset($user['status']);
        unset($user['remember_token']);
        return $user;
    }
}
