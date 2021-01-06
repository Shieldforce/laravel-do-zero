@extends("auth.template.index")

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ route("register") }}"><b>Laravel do </b>Zero</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Digite seus dados para criar sua conta!!!!</p>
                <form action="{{ route("register") }}" method="post">
                    @csrf
                    <input type="hidden" name="routeType" value="web">
                    <div class="input-group mb-3">
                        <label for="first_name"></label>
                        <input type="text" class="form-control" name="first_name" id="first_name" value="{{ old("first_name") ?? "" }}" placeholder="Primeiro Nome">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label for="last_name"></label>
                        <input type="text" class="form-control" name="last_name" id="last_name" value="{{ old("last_name") ?? "" }}" placeholder="Sobrenome">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label for="email"></label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ old("email") ?? "" }}" placeholder="E-mail">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label for="password"></label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Senha">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <label for="password_confirmation"></label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirme a Senha">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">

                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                        </div>
                    </div>
                </form>
                <div class="social-auth-links text-center mb-3">
                    <hr>
                    <a href="{{ route("password.email") }}" class="btn btn-block btn-primary">
                        <i class="fa fa-lock mr-2"></i> Esqueci minha senha!
                    </a>
                    <a href="{{ route("login") }}" class="btn btn-block btn-danger">
                        <i class="fa fa-user-circle mr-2"></i> Já tenho conta.
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
