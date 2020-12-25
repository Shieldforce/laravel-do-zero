<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="{{ asset("Auth-Panel") }}/#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route("panel.main.index") }}" class="nav-link">Home</a>
        </li>
    </ul>
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Busca Global" aria-label="Busca Global">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="{{ asset("Auth-Panel") }}/#">
                <i class="fa fa-power-off"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item" onclick="$('.logout-form').submit();">
                    <div class="media">
                        Finalizar
                    </div>
                </a>
                <form class="logout-form hide" method="POST" action="{{ route("logout") }}">
                    {{ csrf_field() }}
                </form>
            </div>
        </li>
    </ul>
</nav>
