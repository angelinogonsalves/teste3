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

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>    
</head>
<!--
`body` tag options:
-->

<body class="hold-transition layout-top-nav">
    <div class="wrapper">


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
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <span class="badge badge-primary">{{ auth()->user()->nome }}</span> - <i class="far fa-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <div class="dropdown-divider"></div>                               
                            <a href="{{ url('logout/') }}" class="badge badge-danger dropdown-item"> 
                                <i class="fas fa-times-circle"></i>   <button type="button" class="btn btn-danger btn-sm">Sair do sistema</button>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- /.navbar -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
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
                            Confira se todas e informações do seu pedido estão corretas. Confira nome tamanho e
                            demais
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
                                        <small class="float-right">Data do pedido: @date($pedido->created_at)</small>
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
                                        Telefone: (42)3252-2609<br>
                                        Email: contato@razzaesportes.com.br
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    Para:
                                    <address>
                                        <strong>{{ $pedido->user->nome }}</strong><br>
                                        {{ $pedido->user->endereco }} {{ $pedido->user->numero }} 
                                        {{ $pedido->user->bairro }} <br>
                                        {{ $pedido->user->cidade }}  {{ $pedido->user->uf }}<br>
                                        Telefone: {{ $pedido->user->telefone }}<br>
                                        Email: {{ $pedido->user->email }}
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <b>Id Pedido: #{{ $pedido->id }}</b><br>
                                    <b>Id Pagamento:</b> {{ $pedido->id_pagseguro }}<br>
                                    <b>Data Pagamento:</b> <?php echo date('d/m/Y', strtotime($pedido->created_at)); ?><br>
                                    <b>Status:</b> @statusPedido($pedido->status)
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
                                            @forelse ($pedido->itens as $i)
                                                <tr>
                                                    <td>
                                                        <img width="50px" src="{{ $i->url }}"
                                                            class="img-thumbnail" alt="produto">
                                                        <a href="{{ url('produtos/detalhes', [$i->produto->id]) }}">
                                                            {{ $i->produto->produto }}</a>
                                                    </td>
                                                    <td>{{ $i->quantidade }}</td>
                                                    <td>@money($i->valor_unitario)</td>
                                                    <td>{{ $i->tamanho->tamanho }}</td>
                                                    <td>{{ $i->modalidade->modalidade }}</td>
                                                    <td>{{ $i->nome_personalizado }}</td>
                                                    <td>{{ $i->numero_personalizado }}</td>
                                                    <td>@money($i->valor_unitario * $i->quantidade)</td>
                                                </tr>
                                                <tr>
                                                @empty
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <!-- accepted payments column -->
                                <div class="col-6">     
                                    <div class="row">                                                               
                                        <p class="lead">Métodos de Pagamento:</p>
                                        <img src="//assets.pagseguro.com.br/ps-integration-assets/banners/pagamento/todos_animado_550_50.gif"
                                            alt="Logotipos de meios de pagamento do PagSeguro"
                                            title="Este site aceita pagamentos com as principais bandeiras e bancos, saldo em conta PagSeguro e boleto.">

                                        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                            Pagamento via cartões de créditos ou PIX.
                                            Para Ver detalhes do produto como: Descrição, Tamanho com tabela de medidas
                                            clique em cima do produto para abrir informções.
                                        </p>
                                    </div>
                                    @if ($pedido->status < 3)
                                    <div class="row">                                         
                                        <div class="col-12 d-flex justify-content-center ">
                                            <img id="img_qr_code" height="200px;" src="{{$pedido->url_qr_code}}"/>
                                        </div>
                                    </div>
                                    @endif   
                                </div>                                                                     
                                <!-- /.col -->
                                <div class="col-6">
                                    <p class="lead">Valores do Pedido Data: @date($pedido->created_at)</p>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th style="width:50%">Subtotal:</th>
                                                <td>@money($pedido->valor)</td>
                                            </tr>
                                            <tr>
                                                <th>Frete</th>
                                                <td>R$0,00</td>
                                            </tr>
                                            <tr>
                                                <th>Total:</th>
                                                <td>@money($pedido->valor)</td>
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
                                    @if ($pedido->status == 0)
                                        <span class="badge badge-white">Cancelado</span>
                                        <p class="float-right">| Não é possível realizar pagamento. Pedido
                                            cancelado</p>
                                    @elseif ($pedido->status == 1)
                                        <span class="badge badge-danger">Aguardando Pagamento</span>
                                        <button type="button" class="btn btn-success float-right"
                                            onclick="pagseguro()"><i class="far fa-credit-card"></i> Pagar
                                            Pedido via
                                            PagSeguro
                                        </button>
                                        <button class="mr-1 btn btn-secondary float-right" onclick="pix()">Gerar QR Code PIX</button>                                          
                                    @elseif ($pedido->status == 2)
                                        <span class="badge badge-warning">Processando Pagamento</span>
                                        <button type="button" class="btn btn-success float-right"
                                            onclick="pagseguro()"><i class="far fa-credit-card"></i> Pagar Pedido via
                                            PagSeguro
                                        </button>
                                        <button class="btn btn-secondary float-right" onclick="pix()">Gerar QR Code PIX</button>                                          
                                    @elseif ($pedido->status == 3)
                                        <span class="badge badge-success">Pagamento Aprovado</span>
                                    @elseif ($pedido->status == 4)
                                        <span class="badge badge-dark">Em Produção</span>
                                    @elseif ($pedido->status == 5)
                                        <span class="badge badge-info">Pedido Finalizado</span>
                                    @elseif ($pedido->status == 6)
                                        <span class="badge badge-primary">Pedido Entregue</span>
                                    @endif

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
            <strong>Copyright &copy; 2023 <a href="#">Razza</a>.</strong>
            Todos direitos reservados.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0
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

        function pagseguro(id) {
            var url = "{{ url('pedidos/pagseguro', [$pedido->id]) }}";
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

        function pix() {           
            var url = "{{ url('pedidos/pix', [$pedido->id]) }}";
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    console.log('data',data);
                    if (data.success) {
                        $("#img_qr_code").attr("src",data.qr_code);                        
                        swal(data.message, {
                            icon: "success",
                        });                                                
                    } else {
                        swal(data.message, {
                           icon: "error",
                        });  
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
    </script>
</body>

</html>
