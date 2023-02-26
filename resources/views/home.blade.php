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
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Alunos Cadastrados</span>
                    <span class="info-box-number">300
                        <small>Alunos já Cadastrados</small>
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
                        <tr>
                            <td><a href="pages/examples/invoice.html">OR9842</a></td>
                            <td>22/10/200:20:25:25</td>
                            <td>
                                Alnuo Zé Silva -
                                <small class="text-success mr-3">
                                    1234565
                                </small>
                            </td>
                            <td>
                                <div class="sparkbar" data-color="#00a65a" data-height="20">1222,22</div>
                            </td>
                            <td><span class="badge badge-success">Pago</span></td>
                            <td>
                                Unidade Positivo Junior
                            </td>
                        </tr>
                        <tr>
                            <td><a href="pages/examples/invoice.html">OR1848</a></td>
                            <td>22/10/200:20:25:25</td>
                            <td>
                                Alnuo Zé Silva -
                                <small class="text-success mr-3">
                                    1234565
                                </small>
                            </td>
                            <td>
                                <div class="sparkbar" data-color="#f39c12" data-height="20"></div>
                            </td>
                            <td><span class="badge badge-danger">Pagamento pendente</span></td>
                            <td>
                                Unidade Positivo Junior
                            </td>
                        </tr>
                        <tr>
                            <td><a href="pages/examples/invoice.html">OR7429</a></td>
                            <td>22/10/200:20:25:25</td>
                            <td>
                                Alnuo Zé Silva -
                                <small class="text-success mr-3">
                                    1234565
                                </small>
                            </td>
                            <td>
                                <div class="sparkbar" data-color="#f56954" data-height="20">8855,5</div>
                            </td>
                            <td><span class="badge badge-white">Cancelado</span></td>
                            <td>
                                Unidade Positivo Junior
                            </td>
                        </tr>
                        <tr>
                            <td><a href="pages/examples/invoice.html">OR7429</a></td>
                            <td>22/10/200:20:25:25</td>
                            <td>
                                Alnuo Zé Silva -
                                <small class="text-success mr-3">
                                    1234565
                                </small>
                            </td>
                            <td>
                                <div class="sparkbar" data-color="#f56954" data-height="20">90,55</div>
                            </td>
                            <td><span class="badge badge-primary">Em produção</span></td>
                            <td>
                                Unidade Positivo Junior
                            </td>
                        </tr>
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
