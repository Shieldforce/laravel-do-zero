<?php

namespace App\Http\Controllers\Panel;

use App\Models\Role;
use App\Models\User;
use App\Repositories\Response\Error;
use App\Repositories\Response\Success;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{

    protected $request;

    protected $model;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request, Role $model)
    {
        $this->model = $model;
        $this->request = $request;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $list = $this->model->all();
        return view($this->request->route()->getName(), compact("list"));
    }

    /**
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $create = $this->model->create($this->request->all());
        if($create)
        {
            return Success::execute(
                $this->request->routeType ?? "web",
                200,
                "Criado com sucesso!",
                $create
            );
        }

        return Error::execute(
            $this->request->routeType ?? "web",
            500,
            "Erro criar!",
            null
        );
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update()
    {
        $item = $this->model->find($this->request->id);
        $update = $item->update($this->request->all());
        if($update)
        {
            return Success::execute(
                $this->request->routeType ?? "web",
                200,
                "Editado com sucesso!",
                $item
            );
        }

        return Error::execute(
            $this->request->routeType ?? "web",
            500,
            "Erro editar!",
            null
        );
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $item = $this->model->find($id);
        $delete = $item->delete();

        if($delete)
        {
            return Success::execute(
                $this->request->routeType ?? "web",
                200,
                "Excluído com sucesso!",
                $item
            );
        }

        return Error::execute(
            $this->request->routeType ?? "web",
            500,
            "Erro excluir!",
            null
        );
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return response()->json($this->model->find($this->request->id));
    }

    public function listRolesAjax($method, $user_id=null)
    {
        $arrayList = [];
        $roles = Role::all();
        if($method=="create")
        {
            foreach ($roles as $role)
            {
                $arrayList[] = [
                    "id"       => $role->id,
                    "text"     => $role->name,
                    "selected" => "",
                ];
            }
        }
        if($method=="edit")
        {
            $user = User::find($user_id);
            foreach ($roles as $role)
            {
                $arrayList[] = [
                    "id"       => $role->id,
                    "text"     => $role->name,
                    "selected" => $user->roles->contains("id", $role->id) ? "selected" : "",
                ];
            }
        }
        return response()->json([
            "list" => $arrayList
        ]);
    }

}
