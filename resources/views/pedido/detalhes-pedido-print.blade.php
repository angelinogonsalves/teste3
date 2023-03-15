<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detalhes do Pedido | Print</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>

<body>
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                    <div class="callout callout-info">
                        <h5><i class="fas fa-info"></i> Informações do Pedido</h5>
                        
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
                    <br>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        Para:
                        @if($pedido->user)
                            <address>
                                <strong>{{ $pedido->user->nome }}</strong><br>
                                {{ $pedido->user->endereco }}, {{ $pedido->user->numero }} - {{ $pedido->user->bairro }}
                                <br>
                                {{ $pedido->user->cidade }} / {{ $pedido->user->uf }}<br>
                                Telefone: {{ $pedido->user->telefone }}<br>
                                Email: {{ $pedido->user->email }}
                            </address>
                        @else
                        <address>
                            <strong>Aluno ainda não se cadastrou</strong><br>
                        </address>
                        @endif
                        
                    </div>
                    <br>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <b>Id Pedido: #{{ $pedido->id }}</b><br>
                        <b>Id Pagamento:</b> {{ $pedido->id_pagseguro }}<br>
                        <b>Data Pedido:</b> @datetime($pedido->created_at)<br>
                        <b>Status:</b> @statusPedido($pedido->status)
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
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
                                        <td><a href="destalhes">{{ $i->produto->produto }}</a></td>
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

                <div class="row">
                    <!-- accepted payments column -->
                    <!-- accepted payments column -->
                    <div class="col-6">
                        <p class="lead">Médtodos de Pagamento:</p>
                        <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                            Tipo de Pagamento: 
                        </p>
                    </div>
                    <br>
                    <!-- /.col -->
                    <div class="col-6">
                        <p class="lead">Valores do Pedido e  Data: @date($pedido->created_at)</p>

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
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
    <!-- Page specific script -->
    <script>
        window.addEventListener("load", window.print());
    </script>
</body>

</html>
