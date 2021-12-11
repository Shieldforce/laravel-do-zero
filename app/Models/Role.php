<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;

class Role extends Authenticatable
{
    /**
     * @var string
     */
    protected $table = "roles";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'group',
        'type',
    ];

    public static function boot()
    {
        parent::boot();
        self::observe(new \ShieldForce\AutoValidation\Observers\InterceptObserversModel());
    }

    /**
     * @param Request $request
     * @return array
     */
    public static function rulesCustom(Request $request)
    {
        return
            [
                "request"    => $request,
                "creating"   =>
                    [
                        "validations" =>
                            [
                                "name"                => ["required"],
                                "description"         => ["required"],
                                "group"               => ["required"],
                                "type"                => ["required"],
                            ],
                        "messages" =>
                            [
                                //
                            ]
                    ],
                "updating"   =>
                    [
                        "validations" =>
                            [
                                "name"                => ["required"],
                                "description"         => ["required"],
                                "group"               => ["required"],
                                "type"                => ["required"],
                            ],
                        "messages" =>
                            [
                                //
                            ]
                    ]
            ];
    }

    /**
     * Relations
     */

    public function users()
    {
        return $this->belongsToMany(
            \App\Models\User::class,
            "roles_users",
            "role_id",
            "user_id"
        )->withoutGlobalScopes();
    }

    public function permissions()
    {
        return $this->belongsToMany(
            \App\Models\Permission::class,
            "roles_permissions",
            "role_id",
            "permissions_id"
        )->withoutGlobalScopes();
    }
}
