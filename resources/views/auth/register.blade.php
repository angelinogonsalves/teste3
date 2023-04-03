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

                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                        @php
                            Session::forget('success');
                        @endphp
                    </div>
                @endif

                @if ($errors)
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            {{ $error }}</div>
                    @endforeach
                @endif
                
                <form action="{{ url('registra') }}" method="post">                
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="nome" class="form-control" placeholder="Nome Completo" value="{{old('nome')}}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="number" name="ra" class="form-control" placeholder="Número da Matricula R.A." value="{{old('ra')}}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <select class="form-control select2" name="unidade_id" data-placeholder="selecione sua Unidade" style="width: 100%;">
                            <option value="">Selecione sua Unidade. (colégio)</option>
                            @forelse ($unidades as $u)
                                <option value="{{$u->id}}">{{$u->nome_fantasia}}</option>
                            @empty                                    
                            @endforelse                              
                        </select>
                    </div>
                    {{-- <div class="input-group mb-3">
                        <input type="text" name="ddd" class="form-control" maxlength="3" placeholder="DDD" value="{{old('ddd')}}">
                        <div class="input-group-append">
                            <input type="text" name="telefone" class="form-control" maxlength="10" placeholder="Celular" value="{{old('telefone')}}">
                        </div>
                    </div>
                    
                    <div class="input-group mb-3">
                        <input type="text" name="cpf" class="form-control" maxlength="12" placeholder="CPF" value="{{old('cpf')}}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div> --}}
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{old('email')}}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password"  class="form-control" placeholder="Senha" value="{{old('password')}}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password_confirmation"  class="form-control" placeholder="Repetir senha" value="{{old('password_confirmation')}}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">                                            
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
