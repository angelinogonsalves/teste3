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
                                        <th>Nº Item</th>
                                        <th>Nº Pedido</th>
                                        <th>Data Pedido</th>
                                        <th>Unidade</th>
                                        <th>R.A. Aluno</th>
                                        <th>Nome Aluno</th>
                                        <th>Produto</th>
                                        <th>Modalidade</th>
                                        <th>Tamanho</th>
                                        <th>Nome Persinalizado</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($dados as $p)
                                        <tr>
                                            <td>{{ $p->numero_item }}</td>
                                            <td>{{ $p->numero_pedido }}</td>
                                            <td>{{ $p->dataFormatada() }}</td>
                                            <td>{{ $p->nome_fantasia }} </td>
                                            <td>{{ $p->ra_aluno }} </td>
                                            <td>{{ $p->nome_aluno }}</td>
                                            <td>{{ $p->produto }}</td>
                                            <td>{{ $p->modalidade }}</td>
                                            <td>{{ $p->tamanho }}</td>
                                            <td>{{ $p->nome_personalizado }}</td>
                                            <td>
                                                <span class="badge badge-{{ $p->classeStatus() }}">{{ $p->nomeStatus() }}</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="11" class="text-center">Não foram encontrados Produtos</td>
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
                "order": [0, 'asc'],
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
