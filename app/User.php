<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


    const REGULAR_USER  = '0';
    const ADMIN_USER  = '1';
    const ON = '1';
    const OFF = '0';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'password', 'api_token', 'role', 'status', 'city', 'address', 'verify'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function requests()
    {
        return $this->hasMany('App\Request')->orderBy('created_at','desc');
    }

    /**
     * generate access token
     * @return string
     */
    public static function generateToken()
    {
        return str_random(40);
    }

    /**
     * generate verification key
     * @return string
     * @throws \Exception
     */
    public static function generateVerificationKey()
    {
      $i = 0;
      $key = '';
      while ($i<6)
      {
          $key .= random_int(0,9);
          $i++;
      }

      return $key;
    }
}
