<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AGAZZI | Inicio </title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
        >
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.min.css') }}">

        <link rel="stylesheet" href="{{ asset('css/croppie.css') }}">
        <link rel="stylesheet"
            href="https://cdn.datatables.net/v/dt/dt-1.13.4/b-2.3.6/b-print-2.3.6/datatables.min.css"/
        >

        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('js/croppie.js') }}"></script>
        <script src="https://cdn.datatables.net/v/dt/dt-1.13.4/b-2.3.6/b-print-2.3.6/datatables.min.js"></script>

    </head>

    <body class="hold-transition sidebar-mini">
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div class="wrapper">

            <nav class="main-header navbar navbar-expand navbar-white navbar-light"
                aria-label="" aria-labelledby=""
            >
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ url('/') }}" class="nav-link">Início</a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <span class="badge badge-primary">
                                {{ auth()->user()->nome }} -
                            </span>
                            <i class="far fa-user"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <div class="dropdown-divider"></div>
                            <a href="" class="dropdown-item">
                                <i class="fas fa-envelope"> </i> Email: {{ auth()->user()->email }}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ url('logout/') }}" class="badge badge dropdown-item">
                                <button type="button"  class="btn btn-danger btn-sm">
                                    <i class="fas fa-power-off"></i> Sair do sistema
                                </button>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </a>
                    </li>
                </ul>
            </nav>

            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="{{ url('/') }}" class="brand-link">
                    <span class="brand-text font-weight-light"> Agazzi </span>
                </a>
                <div class="sidebar">
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="{{ asset('img/perfil.jpg') }}" class="img-circle elevation-2" alt="User Image">
                        </div>

                        <div class="info">
                            <a href="#" class="d-block">
                                <span class="badge badge-primary">
                                    {{ auth()->user()->nome }}
                                </span>
                            </a>
                        </div>
                    </div>

                    <nav class="mt-2" aria-label="" aria-labelledby="">
                        <ul class="nav nav-pills nav-sidebar flex-column"
                            data-widget="treeview" role="menu" data-accordion="false"
                        >
                            @if (auth()->user()->tipo_usuario == 1)
                                <li class="nav-header">Cadastros</li>
                                <li class="nav-item">
                                    <a href="{{ url('/usuarios') }}" class="nav-link">
                                        <i class="nav-icon fas fa-user"></i>
                                        <p>
                                            Usuários
                                        </p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </aside>

            <div class="content-wrapper">
                <div class="content-header">
                </div>

                <div class="content">
                    <div class="container-fluid">
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

                        @yield('content')

                    </div>
                </div>
            </div>

            <footer class="main-footer">
                <strong>Copyright &copy; 2024 <a href="#">Agazzi</a>.</strong>
                Todos direitos reservados.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Version</b> 1.0.0
                </div>
            </footer>
        </div>

        <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('/js/adminlte.js') }}"></script>

        <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
        <script src="{{ asset('js/demo.js') }}"></script>
        <script src="{{ asset('js/pages/dashboard3.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.min.js') }}"></script>

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
        <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
        <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
        <script src="{{ asset('plugins/jquery-mask/jquery.mask.min.js') }}"></script>

        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
    </body>

</html>
