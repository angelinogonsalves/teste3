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
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fas fa-circle"></i>
                            <span class="badge badge-danger navbar-badge">Sair</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Detalhes do Pedido</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="callout callout-info">
                            <h5><i class="fas fa-info"></i> Atenção!</h5>
                            Confira se todas e informações do seu pedido estão corretas. Confira nome tamanho e demais
                            informações.
                            Caso precise mudar avisar o resposável pelo pedido
                        </div>


                        <!-- Main content -->
                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <i class="fas fa-globe"></i> Razza Esportes.
                                        <small class="float-right">Data do pedido: {{ '01/03/2023' }}</small>
                                    </h4>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    De:
                                    <address>
                                        <strong>Razza Esportes</strong><br>
                                        Av. 7 de Abril, Centro<br>
                                        Palmeira-PR, CEP 8413-000<br>
                                        Telefone: (804) 123-5432<br>
                                        Email: contato@razzaesportes.com.br
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    Para:
                                    <address>
                                        <strong>Aluno Silva</strong><br>
                                        795 Folsom Ave, Suite 600<br>
                                        San Francisco, CA 94107<br>
                                        Phone: (555) 539-1037<br>
                                        Email: john.doe@example.com
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <b>Id Pedido: #007612</b><br>
                                    <br>
                                    <b>Id Pagamento:</b> 4F3S8J<br>
                                    <b>Data Pagamento:</b> 2/22/2014<br>
                                    <b>Status:</b> Pago
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table">
                                        <thead>
                                            <tr>
                                                <th>Produto</th>
                                                <th>Quant.</th>
                                                <th>Valor</th>
                                                <th>Tam.</th>
                                                <th>Modalidade</th>
                                                <th>Nome Pers.</th>
                                                <th>Nº Pers.</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><a href="destalhes">Calção Feminino tipo liso</a></td>
                                                <td>2</td>
                                                <td> 50,99 </td>
                                                <td>M</td>
                                                <td>Futebol</td>
                                                <td>Nome personalizado A </td>
                                                <td>2</td>
                                                <td>100,00</td>
                                            </tr>
                                            <tr>
                                                <td><a href="destalhes">Camiseta uniforme positivos modelo x</a></td>
                                                <td>1</td>
                                                <td> 100,00 </td>
                                                <td>M</td>
                                                <td>Futebol</td>
                                                <td>Nome personalizado A </td>
                                                <td>2</td>
                                                <td> 100,00</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row">

                                <!-- accepted payments column -->
                                <div class="col-6">

                                    <p class="lead">Médtodos de Pagamento:</p>
                                    <img src="//assets.pagseguro.com.br/ps-integration-assets/banners/pagamento/todos_animado_550_50.gif"
                                        alt="Logotipos de meios de pagamento do PagSeguro"
                                        title="Este site aceita pagamentos com as principais bandeiras e bancos, saldo em conta PagSeguro e boleto.">

                                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                        Pagamento via cartões de créditos ou PIX.
                                        Para Ver detalhes do produto como: Descrição, Tamanho com tabela de medidas clique em cima do produto para abrir informções.
                                    </p>
                                </div>
                                <!-- /.col -->
                                <div class="col-6">
                                    <p class="lead">Valores do Pedido Data: 2/22/2023</p>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th style="width:50%">Subtotal:</th>
                                                <td>R$250.30</td>
                                            </tr>
                                            <tr>
                                                <th>Frete</th>
                                                <td>R$0,00</td>
                                            </tr>
                                            <tr>
                                                <th>Total:</th>
                                                <td>R$265.24</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- this row will not appear when printing -->
                            <div class="row no-print">
                                <div class="col-12">
                                    <a href="" rel="noopener" target="_blank"
                                        class="btn btn-default"><i class="fas fa-print"></i> Imprimir</a>
                                    <button type="button" class="btn btn-success float-right"><i
                                            class="far fa-credit-card"></i> Pagar Pedido
                                    </button>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- /.invoice -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        <!-- Main Footer -->
        <footer class="footer">
            <strong>Copyright &copy; 2023 <a href="#">M.C.G Soluções</a>.</strong>
            Todos direitos reservados.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>
        <!-- /.content-wrapper -->
    </div>
    <!-- ./wrapper -->

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
