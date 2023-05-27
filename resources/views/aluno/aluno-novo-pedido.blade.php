<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aluno | Novo Pedido </title>
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
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Novo Pedido</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>


        <!-- FORMULÁRIO NOVO PEDIDO -->
        <section class="content">
            <div class="container-fluid">

                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Pedidos.. </h3>
                    </div>

                    <div class="card-body">
                        <form>
                            <div class="row">
                                <input type="hidden" name="id" id="id" value="{{ old('id', $dados->id) }}">
                                <input type="hidden" name="unidade_id" id="unidade_id" value="{{ old('unidade_id', auth()->user()->unidade_id) }}">
                                <input type="hidden" name="nome_aluno" id="nome_aluno" value="{{ old('nome_aluno', auth()->user()->nome) }}">
                                <input type="hidden" name="ra_aluno" id="ra_aluno" value="{{ old('ra_aluno', auth()->user()->ra) }}">
                                
                                <!-- <div class="col-12 col-sm-12">
                                    <h4 class="mt-12"><small>Esolha o produto e adicione aos itens</small></h4>
                                    <hr>
                                </div> -->

                                <div class="col-sm-12">
                                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="row">
                                                @forelse($produtos as $produto)
                                                    <div class="col-sm-12 col-md-3">
                                                        <div class="card">
                                                            <img class="card-img-top" id="url_produto_{{ $produto->id }}" src="{{ asset($produto->url) }}" alt="{{ $produto->produto }}" max-width="275px" max-height="350px">
                                                            <div class="card-body">
                                                                <h5 class="card-title" id="nome_produto_{{ $produto->id }}" texto="{{ $produto->produto }}">{{ $produto->produto }}</h5>
                                                                <p class="card-text" id="descricao_produto_{{ $produto->id }}" texto="{{ $produto->descricao }}">{{ $produto->descricao }}</p>
                                                                <label class="card-text" id="valor_produto_{{ $produto->id }}" texto="{{ $produto->valor }}">Valor: R$ {{ $produto->valor }}</label>
                                                            </div>
                                                            <div class="card-footer">
                                                                <div>
                                                                    @forelse($produto->tamanhos as $tamanho)
                                                                        <label class="btn btn-default btn-sm text-center">
                                                                            <input type="radio" name="tamanho_produto_{{ $produto->id }}" value="{{ $tamanho->id }}" texto="{{ $tamanho->tamanho }}">
                                                                            <span>{{ $tamanho->tamanho }}</span>
                                                                        </label>
                                                                    @empty
                                                                    @endforelse
                                                                </div>
                                                                <div>
                                                                    <button type="button" class="btn btn-primary btn-sm" onclick="adicionarItem('{{ $produto->id }}');">
                                                                        <i class="fas fa-cart-plus fa-lg mr-2"></i>
                                                                        Adicionar item
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        </form>
                        
                        <div class="col-12 col-sm-12">
                            <h5 class="mt-12 text-center"><small>Confira os itens do pedido na tabela abaixo</small></h5>
                            <hr>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <!-- /.card -->
                                <div class="card">
                                    <!-- /.card-header  usar modelo table que baixa em CSV-->
                                    <div class="card-body table-responsive p-0">

                                        <table id="tabela_itens_produto" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Produto</th>
                                                    <th>Quantidade</th>
                                                    <th>Valor Item</th>
                                                    <th>Tamanho</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbodyitens_produto">
                                                @forelse ($dados->itens as $p)
                                                    <tr class='itens_produtos' valor_produto="{{ $p->valor_unitario }}"
                                                        unidade_id="{{ $p->unidade_id }}" produto_id="{{ $p->produto_id }}"
                                                        tamanho_id="{{ $p->tamanho_id }}">
                                                        <td><img width="50px" src="{{$p->url}}" class="img-thumbnail" alt="produto">
                                                        <a target="blank"
                                                                href="{{ url('/produtos/detalhes', [$p->produto_id]) }}"> {{ $p->produto->produto }}</a>
                                                        </td>
                                                        <td class="align-middle"><input class='form-control-sm quantidade' required type='number'
                                                                value='{{ $p->quantidade }}' min='0'max='10'
                                                                step='0' onchange='calcularTotal()' /></td>
                                                        <td class="align-middle">@money($p->valor_unitario)</td>
                                                        <td class="align-middle">{{ $p->tamanho->tamanho }}</td>
                                                        <td class="align-middle">
                                                            <button class='btn btn-sm btn-default excluir' type='button'
                                                                title='Remover'> <span class='text-danger fas fa-trash-alt'></span>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @empty
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <div class="col-6">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">Total de produtos:</th>
                                            <td><strong id="totalProdutos"></strong></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button onclick="salvar();" type="button" class="btn btn-success float-center" id="fechar-pedido"><i
                                    class="far fa-credit-card"></i>
                                Fechar Pedido
                            </button>
                        </div>
                    </div>
                </div>

                

            </div><!-- /.container-fluid -->
        </section>
        <!-- FIM FORMULÁRIO NOVO PEDIDO -->


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
    </script>
    <script>
        $(document).ready(function() {
            calcularTotal();
            $('.excluir').on('click', function() {
                $(this).parent().parent().remove();
                calcularTotal();
            });
        });


        function adicionarItem(produto_id) {

            let unidade_id = $('#unidade_id').val();
            let nome_aluno = $('#nome_aluno').val();
            let ra_aluno = $('#ra_aluno').val();
            let nome_produto = $('#nome_produto_'+produto_id).attr('texto');
            let valor_produto = $('#valor_produto_'+produto_id).attr('texto');
            let url_imagem = $('#url_produto_'+produto_id).attr('src');                        

            let tamanho_id = $('input[name=tamanho_produto_'+produto_id+']:checked').val();
            let tamanho_texto = $('input[name=tamanho_produto_'+produto_id+']:checked').attr('texto');           

            let formatter = new Intl.NumberFormat('pt-BR', {
                style: 'currency',
                currency: 'BRL',
            });
            valor = formatter.format(valor_produto).substring(3);

            if (unidade_id && nome_aluno && ra_aluno && tamanho_id) {
                $("#tbodyitens_produto").append("<tr class='itens_produtos' valor_produto='" + valor_produto + "' ra_aluno='" +
                    ra_aluno + "' nome_aluno='" + nome_aluno + "' unidade_id='" + unidade_id + "' produto_id='" + produto_id +
                    "' tamanho_id='" + tamanho_id + "'>" +
                    "<td><img width='50px' src='"+url_imagem+"' class='img-thumbnail' alt='produto'>"+
                    "<a target='blank' href=''>  " + nome_produto + "</a></td>" +
                    "<td><input class='form-control-sm quantidade' required type='number' value='1' min='0' max='10' step='0'/ onchange='calcularTotal()'></td>" +
                    "<td>" + valor + "</td>" +
                    "<td>" + tamanho_texto + "</td>" +
                    "<td> <button class='btn btn-sm btn-default excluir' type='button' title='Remover'> <span class='text-danger fas fa-trash-alt'></span> </button></td>" +
                    "</tr>"
                );

                excluir();
                calcularTotal();
                adicionarQuantidade();
            } else {
                alert("Preencha todos os campos");
            }
        }

        function excluir() {

        }

        function calcularTotal() {
            let total = 0;

            if ($('.itens_produtos').length > 0) {
                $.each($('.itens_produtos'), function(key, value) {
                    let valor = $(this).attr('valor_produto');

                    if ($(this).find('.quantidade').val().length > 0) {
                        valor *= $(this).find('.quantidade').val();
                    }

                    total += parseFloat(valor);
                });

                let formatter = new Intl.NumberFormat('pt-BR', {
                    style: 'currency',
                    currency: 'BRL',
                });
                total = formatter.format(total).substring(3);
            }

            $('#totalProdutos').text('R$ ' + total);
        }

        function adicionarQuantidade() {
            $('.quantidade').on('keyup', function() {
                calcularTotal();
            });
        }

        function salvar() {
            let produtos = [];

            if (0 == $('.itens_produtos').length) {
                alert('Adicione ao menos um produto');

                return;
            }

            let unidade_id = $('#unidade_id').val();
            let nome_aluno = $('#nome_aluno').val();
            let ra_aluno = $('#ra_aluno').val();
            let id = $('#id').val();

            $.each($('.itens_produtos'), function(key, value) {

                let produto_id = $(this).attr('produto_id');               
                let tamanho_id = 1; // só para salvar, depois arrumar o front
                let quantidade = $(this).find('.quantidade').val();

                // Verifica se foi informado uma quantidade.
                if (quantidade == 0 || !quantidade) {
                    produtos = [];

                    return false;
                }

                produtos.push({
                    produto_id,
                    quantidade,
                    tamanho_id,
                });
            });

            if (0 == produtos.length) {
                alert('Informe uma quantidade para o produto');
                return;
            }

            urlSalvar = '{{ url('/pedidos/salvar/') }}';

            $.ajax({
                url: urlSalvar,
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    id,
                    unidade_id,
                    nome_aluno,
                    ra_aluno,
                    produtos
                },
                success: function(data) {
                    if (data.success) {
                        alert('Pedido Realizado com sucesso');
                        window.location.href = "{{url('pedidos')}}";
                    } else {
                        alert('Falha ao realizado Pedido');
                    }
                },
                error: function(request, status, error) {
                    alert('Erro ao tentar salvar')
                }
            });
        }
    </script>
</body>

</html>
