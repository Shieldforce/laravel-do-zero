<div class="modal fade" id="edit-role">
    <div class="modal-dialog">
        <div class="modal-content bg-primary">
            <div class="modal-header">
                <h4 class="modal-title">Editar Função</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <form
                action="{{ route("panel.role.update") }}"
                onsubmit="event.preventDefault();formRequestAjaxGlobal(this);"
                method="POST" enctype="multipart/form-data"
                name="formEditRole"
                data-id-closed-modal="edit-role"
                data-reload="true"
            >
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT" />
                <input type="hidden" name="routeType" value="api">
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="card card-danger">
                            <div class="card-body">

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-list"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="name" placeholder="Digite o nome" value="{{ old("name") ?? "" }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-list"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="description" placeholder="Descrição" value="{{ old("description") ?? "" }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-list"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="group" placeholder="Grupo" value="{{ old("group") ?? "" }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-list"></i></span>
                                        </div>
                                        <select class="form-control" name="type">
                                            <option value="">Selecione um tipo</option>
                                            <option value="função">função</option>
                                            <option value="departamento">departamento</option>
                                            <option value="outros">outros</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-user-secret"></i></span>
                                        </div>
                                        <button
                                            type="button"
                                            name="role_id"
                                            href="javascript:;"
                                            class="btn btn-warning ml-2 permissions_ids"
                                            data-toggle="modal" data-target="#sync-edit-roles-permissions"
                                            onclick="listGroupAndPermissions(this, 'edit');"
                                        >
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </div>
                                    @includeIf("panel.role.Local.index.modals.sync-edit-roles-permissions")
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-outline-light">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
