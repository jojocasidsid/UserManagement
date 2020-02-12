<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'coverLetter', 'age', 'sex', 'roles','change_pass','biography','facebook','instagram','linkedin','college','phone','picture','cover','currentRole'
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


    public function verifyUser()
    {
        return $this->hasOne('App\VerifyUser');
    }


    public function passwordSecurity()
    {
        return $this->hasOne('App\PasswordSecurity');
    }
}
