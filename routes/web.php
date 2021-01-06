<?php

    use App\Http\Controllers\Panel\UserController;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Route;
    use \App\Http\Controllers\Site\MainController as SiteMain;
    use \App\Http\Controllers\Panel\MainController as PanelMain;
    use \Illuminate\Support\Facades\View;

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */

    # Insert Global Variables
    View::composer("*", function ($view){
        $routeCurrent         = Route::getCurrentRoute();
        $titleBreadCrumb      = isset($routeCurrent->wheres["titleBreadCrumb"]) ?
                                $routeCurrent->wheres["titleBreadCrumb"] :
                                "Sem Título de BreadCrumb";
        $routeActive          = Route::currentRouteName();
        $route                = explode(".", $routeActive);
        $routeAmbient         = $route[0] ?? null;
        $routeCrud            = $route[1] ?? null;
        $routeMethod          = $route[2] ?? null;
        //-----------------GIT Branch Active ------------------------------------
        $fileGit              = file("../.git/HEAD", FILE_USE_INCLUDE_PATH);
        $firstLine            = $fileGit[0];
        $explodeGit           = explode("/", $firstLine, 3);
        $branch               = ucfirst(str_replace(["\n"],[""], $explodeGit[2]));
        //-----------------GIT Branch Active ------------------------------------
        $view
            ->with("routeCurrent", $routeCurrent)
            ->with("routeActive", $routeActive)
            ->with("routeAmbient", $routeAmbient)
            ->with("routeCrud", $routeCrud)
            ->with("routeMethod", $routeMethod)
            ->with("branch", $branch)
            ->with("titleBreadCrumb", $titleBreadCrumb);
    });

    # Rotas do site
    Route::name("site.")->group(function (){

        # Rotas do Controller Main ou (Principal)
        Route::name("main.")->group(function (){

            # Rota Index do Site
            Route::get('/', [ SiteMain::class, "index" ])
                ->name("index")
                ->setWheres([
                    "titleBreadCrumb"    =>  "Página Principal do Site"
                ]);

        });

    });


    Auth::routes();

    # Rotas do painel
    Route::middleware("auth")->name("panel.")->group(function (){

        # Rotas do Controller Main ou (Principal)
        Route::name("main.")->group(function (){

            # Rota Index do Painel
            Route::get('/painel-de-controle/', [ PanelMain::class, "index" ])
                ->name("index")
                ->setWheres([
                    "titleBreadCrumb"    =>  "Página Principal do Painel"
                ]);

        });

        # Rotas do Controller User
        Route::name("user.")->group(function (){

            # Rota de Dados do Usuário
            Route::get('/usuarios/show/{id?}', [ UserController::class, "show" ])
                ->name("show")
                ->setWheres([
                    "titleBreadCrumb"    =>  "Dados do Usuários"
                ]);

            # Rota de Lista de Usuários
            Route::get('/usuarios', [ UserController::class, "index" ])
                ->name("index")
                ->setWheres([
                    "titleBreadCrumb"    =>  "Lista de Usuários"
                ]);

            # Rota de Gravação de Usuários
            Route::post('/usuarios/cadastro', [ UserController::class, "store" ])
                ->name("store")
                ->setWheres([
                    "titleBreadCrumb"    =>  "Gravação de Usuários"
                ]);

            # Rota de Edição de Usuários
            Route::put('/usuarios/edicao', [ UserController::class, "update" ])
                ->name("update")
                ->setWheres([
                    "titleBreadCrumb"    =>  "Edição de Usuários"
                ]);

            # Rota de Exclusão de Usuários
            Route::delete('/usuarios/exclusao/{id?}', [ UserController::class, "delete" ])
                ->name("delete")
                ->setWheres([
                    "titleBreadCrumb"    =>  "Exclusão de Usuários"
                ]);

        });

    });

    # Rotas do system
    Route::name("system.")->group(function (){

        # Rotas do Controller Main ou (Principal)
        Route::name("main.")->group(function (){

            # Rota Index do Controle de Sistema
            Route::get('/system/', [ PanelMain::class, "index" ])
                ->name("index");

        });

    });
