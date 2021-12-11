@extends("$routeAmbient.template.index")

@section("content")
    <div class="content-wrapper">
        @include("$routeAmbient.$routeCrud.breadcrumb")
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th style="width: 5%;">#</th>
                                <th style="width: 15%;">Nome</th>
                                <th style="width: 20%;">Descrição</th>
                                <th style="width: 15%;">Grupo</th>
                                <th style="width: 15%;">Tipo</th>
                                <th style="width: 15%;">Permissões</th>
                                <th style="width: 15%;">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($list as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->group }}</td>
                                        <td>{{ $item->type }}</td>
                                        <td> - </td>
                                        <td>
                                            @can("panel.role.update")
                                                <a
                                                    href="javascript:;"
                                                    class="btn btn-info"
                                                    data-toggle="modal" data-target="#edit-role"
                                                    onclick="dataFormEdit('{{ $item->id }}')"
                                                >
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endcan
                                            @can("panel.role.delete")
                                                <a
                                                    href="javascript:;"
                                                    class="btn btn-danger"
                                                    data-toggle="modal"
                                                    data-target="#delete-role"
                                                    onclick="dataFormDelete('{{ $item->id }}')"
                                                >
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th style="width: 5%;">#</th>
                                <th style="width: 15%;">Nome</th>
                                <th style="width: 20%;">Descrição</th>
                                <th style="width: 15%;">Grupo</th>
                                <th style="width: 15%;">Tipo</th>
                                <th style="width: 15%;">Permissões</th>
                                <th style="width: 15%;">Ações</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@includeIf("$routeAmbient.$routeCrud.Local.$routeMethod.head")
@includeIf("$routeAmbient.$routeCrud.Local.$routeMethod.javascript")
@includeIf("$routeAmbient.$routeCrud.Local.$routeMethod.modals.create")
@includeIf("$routeAmbient.$routeCrud.Local.$routeMethod.modals.edit")
@includeIf("$routeAmbient.$routeCrud.Local.$routeMethod.modals.delete")
