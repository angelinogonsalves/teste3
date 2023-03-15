@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-shopping-cart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total de Pedidos</span>
                    <span class="info-box-number">
                        300
                        <small>Pedidos</small>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-down"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Pagamentos pedentes</span>
                    <span class="info-box-number">100</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Pedidos Pagos</span>
                    <span class="info-box-number">200</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-cog"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pedidos Em produção</span>
                    <span class="info-box-number">0
                        <small>Produzindo</small>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <div class="card">
        <div class="card-header border-transparent">
            <h3 class="card-title">Ultimos pedidos</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table m-0">
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
                        @foreach ($pedidos as $p)
                            <tr>
                                <td><a href="#">{{ $p->id }}</a></td>
                                <td>{{ $p->created_at }}</td>
                                <td>
                                    {{ $p->nome_aluno }}
                                    <small class="text-success mr-3">
                                        {{ $p->ra_aluno }}
                                    </small>
                                </td>
                                <td>
                                    <div class="sparkbar" data-color="#00a65a" data-height="20">{{ $p->valor }}</div>
                                </td>
                                <td> {{-- <td>  REGRA DOS STATUS AQUI NESTA TELA  --}}
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
                                <td>
                                    {{ $p->unidade->nome_fantasia}}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            <a href="{{ url('/pedidos') }}" class="btn btn-sm btn-secondary float-right">Ver todos Pedidos</a>
        </div>
        <!-- /.card-footer -->
    </div>
    <!-- /.card -->
@endsection
