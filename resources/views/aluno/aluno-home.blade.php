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

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>   
</head>
<!--
`body` tag options:
-->

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <div class="visible-xs">

            <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
                <div class="container">
                    <a href="/" class="navbar-brand">
                        <img src="{{ asset('/img/LogoRazza.png') }}" alt="Logo" class="brand-image img "
                            style="opacity:1">
                        <span class="brand-text font-weight-light">Razza PRO </span>
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
                                <a href="https://www.razzaesportes.com.br/" target="_blank" class="nav-link">Contato</a>
                            </li>
                        </ul>
                    </div>
                    <!-- Right navbar links -->
                    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link" data-toggle="dropdown" href="#">
                                <span class="badge badge-primary">{{ auth()->user()->nome }}</span> - <i class="far fa-user"></i>
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
                                <h2 class="m-2"> Painel do Cliente </h2>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item m-2"><a href="#">Home</a></li>
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->

                        <div class="callout callout-info">
                            <h5><i class="fas fa-info"></i> Atenção!</h5>
                            Aqui você visualiza os pedidos feito pelo coordenador ou responsável de sua instituição.
                        </div>

                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->
            
                <!-- Main content -->
                <div class="content-wrapper">
                    <div class="container">
                        <div class="row">

                            <!-- /.col-md-6 -->
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-6 card-title">
                                                <h5 class="">Meus Pedidos</h5>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <a href="{{ url('aluno/novo-pedido') }}"class="btn btn-sm btn-primary">Adicionar Novo Pedido</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="card-body p-0">
                                            <div class="table-responsive">
                                                <table class="table m-0 ">
                                                    <thead>
                                                        <tr>
                                                            <th>Id</th>
                                                            <th>Data Pedido</th>
                                                            <th>Valor Pedido</th>
                                                            <th>Status</th>
                                                            <th>Ações</th>
                                                            <th width="1%">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" id="check-all">
                                                                    <label class="form-check-label" for="check-all"></label>
                                                                </div>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($pedidos as $p) 
                                                            <tr>
                                                                <td><a
                                                                        href="{{ url('aluno/detalhes-pedido', [$p->id]) }}">{{ $p->id }}</a>
                                                                </td>
                                                                <td><?php echo date('d/m/Y', strtotime($p->created_at)); ?></td>
                                                                <td>
                                                                    <div class="sparkbar" data-color="#00a65a"
                                                                        data-height="20">
                                                                        @money($p->valor)</div>
                                                                </td>
                                                                <td>
                                                                    @if ($p->status == 0)
                                                                        <span class="badge badge-white">Cancelado</span>
                                                                    @elseif ($p->status == 1)
                                                                        <span class="badge badge-danger">Aguardando
                                                                            Pagamento</span>
                                                                    @elseif ($p->status == 2)
                                                                        <span class="badge badge-warning">Processando
                                                                            Pagamento</span>
                                                                    @elseif ($p->status == 3)
                                                                        <span class="badge badge-success">Pagamento
                                                                            Aprovado</span>
                                                                    @elseif ($p->status == 4)
                                                                        <span class="badge badge-dark">Em
                                                                            Produção</span>
                                                                    @elseif ($p->status == 5)
                                                                        <span class="badge badge-info">Pedido
                                                                            Finalizado</span>
                                                                    @elseif ($p->status == 6)
                                                                        <span class="badge badge-primary">Pedido
                                                                            Entregue</span>
                                                                    @endif
                                                                </td>
                                                                <td>

                                                                    <a href="{{ url('aluno/detalhes-pedido', [$p->id]) }}"
                                                                        class="btn btn-info  btn-sm">Ver Pedido</a>
                                                                </td>
                                                                <td>
                                                                    @if ($p->podePagar())
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" id="check-{{ $p->id }}" name="check_pedidos[]" value="{{ $p->id }}">
                                                                            <label class="form-check-label" for="check-{{ $p->id }}"></label>
                                                                        </div>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @empty
                                                        @endforelse
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th colspan="6" class="text-right">
                                                                <a id="button_pagamento" href="#"class="btn btn-sm btn-secondary disabled">Fazer pagamento</a>
                                                            </th>
                                                        </tr>
                                                    </tfoot>
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
                                    <h5 class="card-title">Meus dados de cadastrais</h5>
                                    <p class="card-text">
                                        <div class="col-sm-4 invoice-col">                    
                                            <address>
                                                Nome: <strong> {{ auth()->user()->nome }}</strong><br>
                                                Registro academico (Ra): <strong> {{ auth()->user()->ra }} </strong> <br>
                                                {{-- CPF: {{ auth()->user()->cpf }} <br> --}}
                                                {{-- Telefone: ({{ auth()->user()->ddd }}) {{ auth()->user()->telefone }}<br> --}}
                                                Email: {{ auth()->user()->email }} <br>
                                                {{-- Endereço: {{ auth()->user()->endereco }} {{ auth()->user()->numero }} {{ auth()->user()->bairro }}
                                                {{ auth()->user()->cep }} {{ auth()->user()->cidade }} {{ auth()->user()->uf }}.    --}}
                                            </address>
                                        </div>
                                    </p>
                                    {{--    <a href="#" class="btn btn-primary">Atualizar</a> --}}
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
        <strong>Copyright &copy; 2023 <a href="">Razza</a>.</strong> All rights reserved.
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

    <script>
        // Função para marcar/desmarcar todos os checkboxes
        function toggleCheckboxes() {
            var checkboxes = document.querySelectorAll('input[type="checkbox"][name^="check_pedidos"]');
            var checkAll = document.getElementById('check-all');
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = checkAll.checked;
            }
            performAction();
        }

        // Função para realizar uma ação em massa nos checkboxes marcados
        function performAction() {
            var isSelected = false;
            var buttonPagamento = document.getElementById('button_pagamento');

            var checkboxes = document.querySelectorAll('input[type="checkbox"][name^="check_pedidos"]');
            var checkedCheckboxes = [];
            
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    checkedCheckboxes.push(checkboxes[i].value);
                    isSelected = true;
                }
            }
            if (isSelected) {
                buttonPagamento.classList.remove('btn-secondary');
                buttonPagamento.classList.remove('disabled');
                buttonPagamento.classList.add('btn-success');
            } else {
                buttonPagamento.classList.remove('btn-success');
                buttonPagamento.classList.add('btn-secondary');
                buttonPagamento.classList.add('disabled');
            }
            // Aqui você pode realizar a ação desejada com os checkboxes marcados
            // Por exemplo, enviar uma requisição AJAX para processar os pedidos selecionados
            // console.log('Pedidos selecionados:', checkedCheckboxes);
        }

        function pagseguro() {
            var checkboxes = document.querySelectorAll('input[type="checkbox"][name^="check_pedidos"]');
            var checkedCheckboxes = [];
            isSelected = false;
            
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    checkedCheckboxes.push(checkboxes[i].value);
                    isSelected = true;
                }
            }

            if(!isSelected) { 
                alert('Deve ser selecionado um pedido!');
                exit(0);
            }

            console.log(checkedCheckboxes);

            
            var queryString = 'others[]=' + checkedCheckboxes.join('&others[]=');
            console.log(queryString);
            
            var query_url = 'pedidos/pagseguro/'+checkedCheckboxes[0]+'?'+queryString;

            var url = "{{ url('') }}" + '/' + query_url;
            console.log(url);
            
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    if (data.success) {                       
                        window.open(data.url, '_blank');
                    } else {
                        alert(data.message);
                    }
                },              
                error: function(data) {
                    swal(data.message, {
                           icon: "error",
                     });                  
                },
                beforeSend: function() {
                    swal('Processando...',{
                    icon:  "info",
                    buttons: false
                    });      
                },
                complete: function () {
                    swal.close();
                },
            });
        }

        // Adiciona os event listeners aos elementos
        document.getElementById('check-all').addEventListener('change', toggleCheckboxes);
        var checkboxes = document.querySelectorAll('input[type="checkbox"][name^="check_pedidos"]');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].addEventListener('change', performAction);
        }

        document.getElementById('button_pagamento').addEventListener('click', pagseguro);
    </script>

</body>

</html>
