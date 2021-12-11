<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use App\Models\Role;
use App\Repositories\Response\Error;
use Closure;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class ACLPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->verifyPermissions($request);
        return $next($request);
    }

    public function verifyPermissions(Request $request)
    {
        $this->setupRoutesInTablePermission($request);
        $this->authorizationLogin($request);
        $this->authorizationAll($request);
    }

    public function authorizationLogin(Request $request)
    {
        if(Gate::denies($request->route()->getName()) && $request->route()->getName()=="panel.main.index")
        {
            Auth::logout();
            return Error::execute(
                $request["routeType"] ?? "web",
                401,
                "Não autorizado!",
                null,
                "login"
            );
        }
    }

    public function authorizationAll(Request $request)
    {
        if(Gate::denies($request->route()->getName()))
        {
            return Error::execute(
                $request["routeType"] ?? "web",
                401,
                "Não autorizado!",
                null,
                "panel.main.index"
            );
        }
    }

    public function listRoutesMiddlewareACL()
    {
        $routes = Route::getRoutes()->getRoutes();
        foreach ($routes as $index => $route)
        {
            if(array_search("ACLPermissions", $route->action["middleware"])===false)
            {
                unset($routes[$index]);
            }
        }
        return $routes;
    }

    public function setupRoutesInTablePermission(Request $request)
    {
        $listRoutesAllows = $this->listRoutesMiddlewareACL();
        foreach ($listRoutesAllows as $routeAllow)
        {
            if($this->validationWheresRoutes($routeAllow))
            {
                $permissionUpdateOrCreate = Permission::updateOrCreate(
                    [
                        'name'         => $routeAllow->getName(),
                    ],
                    [
                        'name'         => $routeAllow->getName(),
                        'description'  => $routeAllow->wheres["titleBreadCrumb"],
                        'group'        => $routeAllow->wheres["group"],
                        'group_icon'   => $routeAllow->wheres["group_icon"],
                        'menu'         => $routeAllow->wheres["menu"],
                        'icon'         => $routeAllow->wheres["icon"],
                    ]
                );
                if($permissionUpdateOrCreate)
                {
                    $this->syncRolesInPermissions($routeAllow, $permissionUpdateOrCreate);
                }
            }
        }
    }

    public function validationWheresRoutes($routeAllow)
    {
        if
        (
            $routeAllow->getName() &&
            isset($routeAllow->wheres["titleBreadCrumb"]) &&
            isset($routeAllow->wheres["group"]) &&
            isset($routeAllow->wheres["group_icon"]) &&
            isset($routeAllow->wheres["menu"]) &&
            isset($routeAllow->wheres["icon"])
        )
        {
            return true;
        }
        return false;
    }

    public function syncRolesInPermissions($routeAllow, $permissionUpdateOrCreate)
    {
        if(isset($routeAllow->wheres["roles_ids"]) && $routeAllow->wheres["roles_ids"]=="all")
        {
            $idsRolesAllows = Role::where("name", "!=", "Administrator")->pluck("id");
            $permissionUpdateOrCreate->roles()->sync($idsRolesAllows ?? [], true);
        }

        if(isset($routeAllow->wheres["roles_ids"]) && $routeAllow->wheres["roles_ids"]=="null")
        {
            $permissionUpdateOrCreate->roles()->sync([], true);
        }

        if(
            isset($routeAllow->wheres["roles_ids"]) &&
            $routeAllow->wheres["roles_ids"]!="null" &&
            $routeAllow->wheres["roles_ids"]!="all"
        )
        {
            $explode = explode(",",$routeAllow->wheres["roles_ids"]);
            if(isset($explode[0]))
            {
                $rolesExist = Role::whereIn("id", array_values($explode))->pluck("id");
                $permissionUpdateOrCreate->roles()->sync($rolesExist, true);
            }
        }
    }

}
