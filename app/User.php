<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use ShieldForce\AutoValidation\Traits\TraitStartInterception;
use Illuminate\Http\Request;

class User extends Authenticatable
{
    use Notifiable;

    use TraitStartInterception;

    public static function rulesCustom(Request $request)
    {
        return
            [
                "request"    => $request,
                "creating"   =>
                    [
                        "validations" =>
                            [
                                "first_name"    => ["required", "string", "max:50"],
                                "last_name"     => ["required", "string", "max:50"],
                                "email"         => ["required", "string", "email", "max:100", "unique:users"],
                                "password"      => ["required", "string", "min:4", "confirmed"],
                            ],
                        "messages" =>
                            [
                                "first_name.required" => "Primeiro nome é obritatório",
                                "last_name.required"  => ":attribute nome é obritatório",
                            ]
                    ],
            ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
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
}
