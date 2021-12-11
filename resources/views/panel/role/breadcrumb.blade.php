<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ $titleBreadCrumb ?? "Sem Título de BreadCrumb" }} |
                    @can("panel.role.store")
                        <a class="btn btn-success" data-toggle="modal" data-target="#create-role"><i class="fa fa-plus text-white"></i></a>
                    @endcan
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route("$routeAmbient.$routeCrud.$routeMethod") }}">Home</a></li>
                    <li class="breadcrumb-item active">{{ $titleBreadCrumb ?? "Sem Título de BreadCrumb" }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
