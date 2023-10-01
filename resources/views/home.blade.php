@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-shopping-cart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total de a</span>
                    <span class="info-box-number">
                        0
                        <small>a</small>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-down"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">b</span>
                    <span class="info-box-number">0</span>
                </div>
            </div>
        </div>

        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">c</span>
                    <span class="info-box-number">0</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-cog"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">d</span>
                    <span class="info-box-number">0
                        <small>d...</small>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header border-transparent">
            <h3 class="card-title">e</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table m-0">
                    <caption>f...</caption>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Data Pedido</th>
                            <th>Aluno - R.A.</th>
                            <th>Valor Pedido</th>
                            <th>Status</th>
                            <th>Unidade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $manutencoes = []; @endphp
                        @foreach ($manutencoes as $manutencao)
                            <tr>
                                <td>
                                    <a href="{{ url('pedidos/cadastro', [$manutencao->id]) }}">{{ $manutencao->id }}
                                    </a>
                                </td>
                                <td>@datetime($manutencao->created_at)</td>
                                <td>
                                    {{ $manutencao->nome_aluno }}
                                    <small class="text-success mr-3">
                                        {{ $manutencao->ra_aluno }}
                                    </small>
                                </td>
                                <td>
                                    <div class="sparkbar" data-color="#00a65a" data-height="20">
                                        {{ $manutencao->valor }}
                                    </div>
                                </td>
                                <td>
                                    @if ($manutencao->status == 0)
                                        <span class="badge badge-white">Cancelado</span>
                                    @elseif ($manutencao->status == 1)
                                        <span class="badge badge-danger">Aguardando Pagamento</span>
                                    @elseif ($manutencao->status == 2)
                                        <span class="badge badge-warning">Processando Pagamento</span>
                                    @elseif ($manutencao->status == 3)
                                        <span class="badge badge-success">Pagamento Aprovado</span>
                                    @elseif ($manutencao->status == 4)
                                        <span class="badge badge-dark">Em Produção</span>
                                    @elseif ($manutencao->status == 5)
                                        <span class="badge badge-info">Pedido Finalizado</span>
                                    @elseif ($manutencao->status == 6)
                                        <span class="badge badge-primary">Pedido Entregue</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer clearfix">
            <a href="{{ url('/manutencao') }}" class="btn btn-sm btn-secondary float-right">Ver todos as manutenções</a>
        </div>
    </div>
@endsection
