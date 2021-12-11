<div class="modal fade" id="create-user">
    <div class="modal-dialog">
        <div class="modal-content bg-success">
            <div class="modal-header">
                <h4 class="modal-title">Criação de Usuário</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <form
                action="{{ route("panel.user.store") }}"
                onsubmit="event.preventDefault();formRequestAjaxGlobal(this);"
                method="POST"
                enctype="multipart/form-data"
                data-id-closed-modal="create-user"
                data-reload="true"
            >
                {{ csrf_field() }}
                <input type="hidden" name="routeType" value="api">
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="card card-danger">
                            <div class="card-body">

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="first_name" placeholder="Primeiro Nome" value="{{ old("first_name") ?? "" }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="last_name" placeholder="Sobrenome" value="{{ old("last_name") ?? "" }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-check-circle"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="email" placeholder="E-mail" value="{{ old("email") ?? "" }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                        </div>
                                        <input type="password" class="form-control" name="password" placeholder="Senha">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                        </div>
                                        <input type="password" class="form-control" name="password_confirmation" placeholder="Repita a senha">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-user-secret"></i></span>
                                        </div>
                                        <select
                                            class="select2bs4 select2-hidden-accessible roles_ids"
                                            name="roles_ids[]"
                                            multiple
                                            data-placeholder="Selecione Funções"
                                            data-select2-id="7"
                                            tabindex="-1"
                                            aria-hidden="true"
                                            data-method="create"
                                        >
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-outline-light">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
