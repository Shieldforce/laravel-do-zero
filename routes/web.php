<?php

use App\Http\Controllers\Panel\PermissionController;
use App\Http\Controllers\Panel\RoleController;
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
    Route::middleware(["ACLPermissions"])->group(function (){

        Route::middleware(["auth"])->name("panel.")->group(function (){

            # Rotas do Controller Main ou (Principal)
            Route::name("main.")->group(function (){

                # Rota Index do Painel
                Route::get('/painel-de-controle/', [ PanelMain::class, "index" ])
                    ->name("index")
                    ->setWheres([
                        "titleBreadCrumb"    => "Página Principal do Painel",
                        "group"              => "Controle",
                        "group_icon"         => "fa fa-tachometer-alt",
                        "menu"               => 1,
                        "icon"               => "fa fa-home",
                        "roles_ids"          => "all", // Passar ids que serão permitidos | all | null
                        "default"            => 1
                    ]);

            });

            # Rotas do Controller User
            Route::name("user.")->group(function (){

                # Rota de Dados do Usuário
                Route::get('/usuarios/show/{id?}', [ UserController::class, "show" ])
                    ->name("show")
                    ->setWheres([
                        "titleBreadCrumb"    => "Dados do Usuários",
                        "group"              => "Usuários",
                        "group_icon"         => "fa fa-cogs",
                        "menu"               => 0,
                        "icon"               => "fa fa-users",
                        "roles_ids"          => "all" // Passar ids que serão permitidos | all | null
                    ]);

                # Rota de Lista de Usuários
                Route::get('/usuarios', [ UserController::class, "index" ])
                    ->name("index")
                    ->setWheres([
                        "titleBreadCrumb"    => "Lista de Usuários",
                        "group"              => "Usuários",
                        "group_icon"         => "fa fa-cogs",
                        "menu"               => 1,
                        "icon"               => "fa fa-users",
                        "roles_ids"          => "2,3,4" // Passar ids que serão permitidos | all | null
                    ]);

                # Rota de Gravação de Usuários
                Route::post('/usuarios/cadastro', [ UserController::class, "store" ])
                    ->name("store")
                    ->setWheres([
                        "titleBreadCrumb"    =>  "Gravação de Usuários",
                        "group"              => "Usuários",
                        "group_icon"         => "fa fa-cogs",
                        "menu"               => 0,
                        "icon"               => "fa fa-user-plus",
                        "roles_ids"          => "3,4" // Passar ids que serão permitidos | all | null
                    ]);

                # Rota de Edição de Usuários
                Route::put('/usuarios/edicao', [ UserController::class, "update" ])
                    ->name("update")
                    ->setWheres([
                        "titleBreadCrumb"    => "Edição de Usuários",
                        "group"              => "Usuários",
                        "group_icon"         => "fa fa-cogs",
                        "menu"               => 0,
                        "icon"               => "fa fa-user-plus",
                        "roles_ids"          => "3,4" // Passar ids que serão permitidos | all | null
                    ]);

                # Rota de Exclusão de Usuários
                Route::delete('/usuarios/exclusao/{id?}', [ UserController::class, "delete" ])
                    ->name("delete")
                    ->setWheres([
                        "titleBreadCrumb"    =>  "Exclusão de Usuários",
                        "group"              => "Usuários",
                        "group_icon"         => "fa fa-cogs",
                        "menu"               => 0,
                        "icon"               => "fa fa-users",
                        "roles_ids"          => "3,4" // Passar ids que serão permitidos | all | null
                    ]);

            });

            # Rotas do Controller Role
            Route::name("role.")->group(function (){

                # Rota de Dados do Usuário
                Route::get('/funcoes/show/{id?}', [ RoleController::class, "show" ])
                    ->name("show")
                    ->setWheres([
                        "titleBreadCrumb"    => "Dados do Funções",
                        "group"              => "Funções",
                        "group_icon"         => "fa fa-cogs",
                        "menu"               => 0,
                        "icon"               => "fa fa-users",
                        "roles_ids"          => "3,4" // Passar ids que serão permitidos | all | null
                    ]);

                # Rota de Lista de Funções
                Route::get('/funcoes', [ RoleController::class, "index" ])
                    ->name("index")
                    ->setWheres([
                        "titleBreadCrumb"    => "Lista de Funções",
                        "group"              => "Funções",
                        "group_icon"         => "fa fa-cogs",
                        "menu"               => 1,
                        "icon"               => "fa fa-users",
                        "roles_ids"          => "2,3,4" // Passar ids que serão permitidos | all | null
                    ]);

                # Rota de Gravação de Funções
                Route::post('/funcoes/cadastro', [ RoleController::class, "store" ])
                    ->name("store")
                    ->setWheres([
                        "titleBreadCrumb"    =>  "Gravação de Funções",
                        "group"              => "Funções",
                        "group_icon"         => "fa fa-cogs",
                        "menu"               => 0,
                        "icon"               => "fa fa-user-plus",
                        "roles_ids"          => "3,4" // Passar ids que serão permitidos | all | null
                    ]);

                # Rota de Edição de Funções
                Route::put('/funcoes/edicao', [ RoleController::class, "update" ])
                    ->name("update")
                    ->setWheres([
                        "titleBreadCrumb"    => "Edição de Funções",
                        "group"              => "Funções",
                        "group_icon"         => "fa fa-cogs",
                        "menu"               => 0,
                        "icon"               => "fa fa-user-plus",
                        "roles_ids"          => "3,4" // Passar ids que serão permitidos | all | null
                    ]);

                # Rota de Exclusão de Funções
                Route::delete('/funcoes/exclusao/{id?}', [ RoleController::class, "delete" ])
                    ->name("delete")
                    ->setWheres([
                        "titleBreadCrumb"    =>  "Exclusão de Funções",
                        "group"              => "Funções",
                        "group_icon"         => "fa fa-cogs",
                        "menu"               => 0,
                        "icon"               => "fa fa-users",
                        "roles_ids"          => "3,4" // Passar ids que serão permitidos | all | null
                    ]);

                # Rota de Lista de Funções
                Route::get('/funcoes/listRolesAjax/{method?}/{user_id?}', [ RoleController::class, "listRolesAjax" ])
                    ->name("listRolesAjax")
                    ->setWheres([
                        "titleBreadCrumb"    => "Lista de Funções",
                        "group"              => "Funções",
                        "group_icon"         => "fa fa-cogs",
                        "menu"               => 0,
                        "icon"               => "fa fa-lock",
                        "roles_ids"          => "all" // Passar ids que serão permitidos | all | null
                    ]);

            });

            # Rotas do Controller Permissions
            Route::name("permission.")->group(function (){

                # Rota de Lista de Permissões e Grupos
                Route::get('/permissoes/listGroupAndPermissions/{method?}/{role_id?}', [ PermissionController::class, "listGroupAndPermissions" ])
                    ->name("listGroupAndPermissions")
                    ->setWheres([
                        "titleBreadCrumb"    => "Lista de Grupo e Permissões",
                        "group"              => "Permissões",
                        "group_icon"         => "fa fa-cogs",
                        "menu"               => 0,
                        "icon"               => "fa fa-list",
                        "roles_ids"          => "all" // Passar ids que serão permitidos | all | null
                    ]);

            });

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
