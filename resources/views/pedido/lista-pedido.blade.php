@extends('layout.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pedidos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pedidos</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- /.card -->
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ url('pedidos/cadastro') }}"class="btn btn btn-primary">Adicionar Novo Pedido</a>
                            <a href="{{ url('/pedidos') }}" class="btn btn btn-success float-right">Atualizar dados
                                Pagamentos </a>

                        </div>
                        <!-- /.card-header  usar modelo table que baixa em CSV-->
                        <div class="card-body table-responsive p-0">
                            <table id="tabela_itens_produto" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Data Pedido</th>
                                        <th>Aluno - R.A.</th>
                                        <th>Valor Pedido</th>
                                        <th>Status</th>
                                        <th>Unidade</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($dados as $p)
                                        <tr>
                                            <td>{{ $p->id }}</td>
                                            <td><?php echo date('d/m/Y H:i', strtotime($p->created_at)); ?></td>
                                            <td>{{ $p->nome_aluno }} - {{ $p->ra_aluno }}</td>
                                            <td>{{ $p->valor }}</td>
                                            <td>
                                                @if ($p->status == 0)
                                                    Pendente
                                                @elseif ($p->status_pedido == 1)
                                                    Aguardando Pagamento
                                                @elseif ($p->status_pedido == 2)
                                                    Processando Pagamento
                                                @elseif ($p->status_pedido == 3)
                                                    Pagamento Aprovado
                                                @elseif ($p->status_pedido == 4)
                                                    Pagamento Rejeitado
                                                @elseif ($p->status_pedido == 5)
                                                    Em Produção
                                                @elseif ($p->status_pedido == 6)
                                                    Pedido Finalizado
                                                @elseif ($p->status_pedido == 7)
                                                    Entregue
                                                @endif
                                            </td>
                                            <td>{{ $p->unidade }} </td>
                                            <td>
                                                <form action="{{ url('pedidos/excluir', [$p->id]) }}" method="post">
                                                    @csrf
                                                    <a class="btn btn-primary btn-sm"
                                                        href="{{ url('pedidos/cadastro', [$p->id]) }}">Ver | Editar</a>
                                                    <input type="submit" value="Excluir" class="btn btn-danger btn-sm">
                                                </form>
                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Não foram encontrados Produtos</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </section>
@endsection
