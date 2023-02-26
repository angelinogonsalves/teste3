<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Razza | Login </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
</head>

<body class="hold-transition login-page">

    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="/register" class="h1"><b>Razza</b>PRO</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Realizar cadastro..</p>

                <form action="../../index.html" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nome Completo">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" placeholder="R.A (Registro Academico)">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12">
                        <div class="form-group">
                            <label>Selecione sua unidade</label>
                            <div class="select-purple">
                                <select class="select" multiple="multiple" data-placeholder="selecione sua Unidade"
                                    data-dropdown-css-class="select2-purple" style="width: 100%;">
                                    <option>Positivo A</option>
                                    <option>Positivo B</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Senha">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Repetir senha">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                <label for="agreeTerms">
                                    Eu aceito os termos <a href="#">Termo</a>
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <br>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <a href="{{ url('/login') }}" class="text-center">Já tenho uma conta. Ir para Login</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>


    <!-- jQuery -->
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE -->
    <script src="{{ asset('/js/adminlte.js') }}"></script>


</body>

</html>
