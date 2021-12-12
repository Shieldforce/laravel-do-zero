<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;

class Permission extends Authenticatable
{
    /**
     * @var string
     */
    protected $table = "permissions";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'group',
        'group_icon',
        'menu',
        'icon',
        'default',
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
                                "group_icon"          => ["required"],
                                "menu"                => ["required"],
                                "icon"                => ["required"],
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
                                "group_icon"          => ["required"],
                                "menu"                => ["required"],
                                "icon"                => ["required"],
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

    public function roles()
    {
        return $this->belongsToMany(
            \App\Models\Role::class,
            "roles_permissions",
            "permission_id",
            "role_id"
        )->withoutGlobalScopes();
    }
}
