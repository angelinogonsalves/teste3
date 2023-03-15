<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aluno | Home </title>
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

        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="/aluno/home" class="navbar-brand">
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
                            <a href="index3.html" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Contato</a>
                        </li>
                    </ul>
                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <!-- Messages Dropdown Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{ url('logout/') }}">
                            <i class="fas fa-circle"></i>
                            <span class="badge badge-danger navbar-badge">Sair</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"> Painel do Cliente <small> - Acompanhe seus pedidos</small></h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row">

                        <!-- /.col-md-6 -->
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title m-0">Meus Pedidos</h5>
                                </div>
                                <div class="card-body">
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table m-0">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Data Pedido</th>
                                                        <th>Valor Pedido</th>
                                                        <th>Status</th>
                                                        <th>Ações</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($pedidos as $p)
                                                        <tr>
                                                            <td><a href="{{ url('produtos/detalhes') }}"></a>{{$p->id}}</td>
                                                            <td>@datetime($p->created_at)</td>
                                                            <td>
                                                                <div class="sparkbar" data-color="#00a65a" data-height="20">
                                                                @money($p->valor)</div>
                                                            </td>
                                                            <td>  
                                                                @if ($p->status == 0)
                                                                <span class="badge badge-white">Cancelado</span>
                                                                @elseif ($p->status == 1)
                                                                    <span class="badge badge-danger">Aguardando Pagamento</span>
                                                                @elseif ($p->status == 2)
                                                                    <span class="badge badge-warning">Processando Pagamento</span>
                                                                @elseif ($p->status == 3)
                                                                    <span class="badge badge-success">Pagamento Aprovado</span>
                                                                @elseif ($p->status == 4)
                                                                    <span class="badge badge-dark">Em Produção</span>
                                                                @elseif ($p->status == 5)
                                                                    <span class="badge badge-info">Pedido Finalizado</span>
                                                                @elseif ($p->status == 6)
                                                                    <span class="badge badge-primary">Pedido Entregue</span>
                                                                @endif</td>
                                                            <td>                                                        

                                                            <a href="{{ url('aluno/detalhes-pedido',[$p->id]) }}" class="btn btn-info  btn-sm">Ver Pedido</a>
                                                        </td>
                                                        </tr>
                                                    @empty
                                                    @endforelse                                                                                                      
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.table-responsive -->
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="card card-primary card-outline">
                                <div class="card-body">
                                    <h5 class="card-title">Meus dados</h5>
                                    <p class="card-text">
                                        Endereço informações do Cliente Aluno
                                    </p>
                                    <a href="#" class="btn btn-primary">Atualizar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            razzapro.com.br
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2023 <a href="">MCG Soluções</a>.</strong> All rights reserved.
    </footer>

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
    </script>
</body>

</html>
