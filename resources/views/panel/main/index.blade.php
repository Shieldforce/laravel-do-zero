@extends("panel.template.index")

@section("content")
    <div class="content-wrapper">
        @include("$routeAmbient.$routeCrud.breadcrumb")
        <div class="content">
            <div class="container-fluid">
                <div class="row">

                </div>
            </div>
        </div>
    </div>
@endsection

@includeIf("$routeAmbient.$routeCrud.Local.$routeMethod.head")
@includeIf("$routeAmbient.$routeCrud.Local.$routeMethod.javascript")
