<?php

namespace App\Http\Controllers\Panel;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    protected $request;

    protected $model;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request, User $model)
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $create = $this->model->create($this->request->all());
        $this->request["id"] = $create->id;
        $create->password = Hash::make($this->request->password);
        $create->save();

        if($create)
            return redirect()
                ->route("panel.user.index")
                ->with("success", "Usuário criado com sucesso!");

        return back()
            ->withInput()
            ->with("error", "Erro ao criar usuário!");
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update()
    {
        $item = $this->model->find($this->request->id);
        $item->password != $this->request->password ? $this->request["password"] = Hash::make($this->request->password) : null;
        $update = $item->update($this->request->all());

        if($update)
            return back()
                ->with("success", "Usuário editado com sucesso!");

        return back()
            ->withInput()
            ->with("error", "Erro ao editar usuário!");
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $item = $this->model->find($this->request->id);
        $delete = $item->delete();

        if($delete)
            return back()
                ->with("success", "Usuário delete com sucesso!");

        return back()
            ->withInput()
            ->with("error", "Erro ao deletar usuário!");
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return response()->json($this->model->find($this->request->id));
    }

}
