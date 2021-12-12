<?php

namespace App\Http\Controllers\Panel;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{

    protected $request;

    protected $model;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request, Permission $model)
    {
        $this->model = $model;
        $this->request = $request;
    }

    public function listGroupAndPermissions($method, $role_id=null)
    {
        if($method=="create")
        {
            $groupsPermissions = $this->model->all()->groupBy("group");
        }
        if($method=="edit")
        {
            $role = Role::find($role_id);
            $groupsPermissions = $role->permissions()->get()->groupBy("group");
        }
        return response()->json([
            "list" => $groupsPermissions ?? []
        ]);
    }


}
