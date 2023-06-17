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
                        <li class="breadcrumb-item active">Relatórios</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        
                        <div class="card-header">
                            <form class="form-inline" action="{{ url('relatorios') }}" method="get">
                                <div class="form-group col-sm-6 col-md-2">
                                    <label for="inicio">De: </label>
                                    <input class="form-control" type="date" name="inicio" id="inicio" value="{{ @$filtros['inicio']}}">
                                </div>
                                <div class="form-group col-sm-6 col-md-2">
                                    <label for="fim">Até:</label>
                                    <input class="form-control" type="date" name="fim" id="fim" value="{{ @$filtros['fim']}}">
                                </div>
                                <button class="btn btn-sm btn-success" type="submit">Filtrar</button>
                            </form>
                        </div>

                        <div class="card-body table-responsive p-2">
                            <table id="relatorio_de_produtos" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Data Pedido</th>
                                        <th>Aluno - R.A.</th>
                                        <th>Status</th>
                                        <th>Unidade</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($dados as $p)
                                        <tr>
                                            <td>{{ $p->id }}</td>
                                            <td><?php echo date('d/m/Y', strtotime($p->created_at)); ?></td>
                                            <td>{{ $p->nome_aluno }} - {{ $p->ra_aluno }}</td>
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
                                                @endif
                                            </td>
                                            <td> {{ $p->nome_fantasia }} </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Não foram encontrados Produtos</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(function() {
            var table = new DataTable('#relatorio_de_produtos', {
                "order": [0, 'desc'],
                language: {
                    url: "{{ asset('plugins/datatables/datatable-pt-BR.json') }}"
                },
                dom: 'Bfrtip',
                buttons: [
                    'print'
                ]
            });
        });
    </script>

@endsection
