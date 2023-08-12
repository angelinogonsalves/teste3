<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Razza | Inicio </title>
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
    <!-- jQuery -->

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/croppie.css') }}">
    <script src="{{ asset('js/croppie.js') }}"></script>
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.4/b-2.3.6/b-print-2.3.6/datatables.min.css" rel="stylesheet"/>
    <script src="https://cdn.datatables.net/v/dt/dt-1.13.4/b-2.3.6/b-print-2.3.6/datatables.min.js"></script>

    <!-- <link href="https://cdn.datatables.net/v/bs4/dt-1.13.4/datatables.min.css" rel="stylesheet" />
    <script src="https://cdn.datatables.net/v/bs4/dt-1.13.4/datatables.min.js"></script> -->

</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->

<body class="hold-transition sidebar-mini">
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('/') }}" class="nav-link">Início</a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <span class="badge badge-primary">{{ auth()->user()->nome }}</span> - <i
                            class="far fa-user"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        <a href="" class="dropdown-item">
                            <i class="fas fa-envelope"> </i> Email: {{ auth()->user()->email }} 
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ url('logout/') }}" class="badge badge dropdown-item">
                             <button type="button"  class="btn btn-danger btn-sm"> <i class="fas fa-power-off"></i> Sair do sistema</button>
                        </a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li> --}}
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ url('/') }}" class="brand-link">
                <!-- <img src="{{ asset('img/LogoRazza.png') }}" alt="Razza PRO"
                    class="brand-image img" style="">-->
                <span class="brand-text font-weight-light"> Razza PRO</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('img/perfil.jpg') }}" class="img-circle elevation-2" alt="User Image">
                    </div>

                    <div class="info">
                        <a href="#" class="d-block"><span
                                class="badge badge-primary">{{ auth()->user()->nome }}</span> </a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

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
                            <li class="nav-item">
                                <a href="{{ url('unidades') }}" class="nav-link">
                                    <i class="nav-icon fas fa-city"></i>
                                    <p>
                                        Unidades
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('grupos') }}" class="nav-link">
                                    <i class="nav-icon fas fa-city"></i>
                                    <p>
                                        Grupos
                                    </p>
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                Cadastro do Produto
                                <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                <a href="pages/tables/simple.html" class="nav-link">
                                    <i class="far fa-plus-square nav-icon"></i>
                                    <p>Tamanhos</p>
                                </a>
                                </li>
                                <li class="nav-item">
                                <a href="pages/tables/data.html" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Modalidades</p>
                                </a>
                                </li>
                            </ul>
                            </li> --}}
                            <li class="nav-item">
                                <a href="{{ url('produtos') }}" class="nav-link">
                                    <i class="nav-icon far fa-image"></i>
                                    <p>
                                        Produtos
                                    </p>
                                </a>
                            </li>
                        @endif
                        <li class="nav-header">Fazer Pedido</li>
                        <li class="nav-item">
                            <a href="{{ url('/pedidos') }}" class="nav-link">
                                <i class="far fa-plus-square nav-icon"></i>
                                <p>Pedidos</p>
                            </a>
                        </li>
                        <li class="nav-header">Relatórios</li>
                        <li class="nav-item">
                            <a href="{{ url('/relatorios') }}" class="nav-link">
                                <i class="nav-icon fas fa-calendar-alt"></i>
                                <p>
                                    Relatórios
                                    <span class="badge badge-info right">1</span>
                                </p>
                            </a>
                        </li>
                        @if (auth()->user()->tipo_usuario == 1)
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="nav-icon fas fa-cog"></i>
                                    <p>
                                        Configurações
                                        <span class="right badge badge-warning">!</span>
                                    </p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- PAGINA HOME -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
            </div>

            <!-- Main content PAGINA HOME-->
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
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2023 <a href="#">Razza PRO</a>.</strong>
            Todos direitos reservados.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>
        <!-- /.content-wrapper -->
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
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

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- DataTables  & Plugins -->
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
