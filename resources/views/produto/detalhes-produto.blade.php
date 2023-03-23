<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aluno | Detalhes Pedido </title>
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
    <!-- bootstrap select -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.min.css') }}">
</head>
<!--
`body` tag options:
-->

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        @if (auth()->user()->tipo_usuario == 4)
            <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
                <div class="container">
                    <a href="/" class="navbar-brand">
                        <img src="{{ asset('/img/LogoRazza.png') }}" alt="Logo" class="brand-image img "
                            style="opacity:1">
                        <span class="brand-text font-weight-light">Razza PRO</span>
                    </a>

                    <button class="navbar-toggler order-1" type="button" data-toggle="collapse"
                        data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                        <!-- Left navbar links -->
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="#" class="nav-link">Contato</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Right navbar links -->
                    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                        <!-- Messages Dropdown Menu -->
                        <li class="nav-item dropdown">
                            <a class="nav-link" data-toggle="dropdown" href="#">
                                <i class="fas fa-circle"></i>
                                <span class="badge badge-danger navbar-badge">Sair</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        @endif
        <!-- /.navbar -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Detalhes do Produto</h1>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9">
                            @forelse ($dados->imagens as $i)
                                <div class="col-md-3  d-flex justify-content-center">
                                    <img src="{{ $i->url }}" class="img-thumbnail" alt="produto">
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <h3 class="my-3">{{ $dados->produto }}</h3>
                            <p>{{ $dados->descricao }}</p>
                            <hr>
                            <h4 class="mt-3">Tamanhos disponíves <small></small></h4>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                @forelse($dados->tamanhos as $t)
                                    <label class="btn btn-default text-center">
                                        <input type="radio" name="color_option" id="color_option_b1"
                                            autocomplete="off">
                                        <span class="text-xl">{{ $t->tamanho }}</span>
                                    </label>
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <div class="col-6  col-sm-6">
                        <div class="bg-gray py-2 px-3 mt-4">
                            <h2 class="mb-0">
                                @money($dados->valor)
                            </h2>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </section>

        <!-- REQUIRED SCRIPTS -->

        <!-- jQuery -->
        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap -->
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- AdminLTE -->
        <script src="{{ asset('/js/adminlte.js') }}"></script>

        <!-- OPTIONAL SCRIPTS -->
        <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{ asset('js/demo.js') }}"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{ asset('js/pages/dashboard3.js') }}"></script>
        <!-- Bootstrap select -->
        <script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.min.js') }}"></script>

        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).ready(function() {
                $('.product-image-thumb').on('click', function() {
                    var $image_element = $(this).find('img')
                    $('.product-image').prop('src', $image_element.attr('src'))
                    $('.product-image-thumb.active').removeClass('active')
                    $(this).addClass('active')
                })
            })
        </script>
</body>

</html>
