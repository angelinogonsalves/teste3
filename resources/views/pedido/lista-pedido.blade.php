@extends('layout.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pedidos</h1>
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
                            <a href="{{ url('pedidos/criar') }}"class="btn btn-primary">Adicionar Novo <i
                                    class="nav-icon far fa-plus-square"></i></a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-valign-middle">
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
                                    <tr>
                                        <td>
                                            1231
                                        </td>
                                        <td>25/05/1585</td>
                                        <td>
                                            Alnuo Zé Silva -
                                            <small class="text-success mr-3">
                                                1234565
                                            </small>
                                        </td>
                                        <td>
                                            R$ 255,33
                                        </td>
                                        <td>
                                            Pago
                                        </td>
                                        <td>
                                            Unidade Positivo Junior
                                        </td>
                                        <td>
                                            <a href="#" class="text-muted">
                                                <i class="fas fa-search"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            1231
                                        </td>
                                        <td>25/05/1585</td>
                                        <td>
                                            Alnuo Zé Silva -
                                            <small class="text-success mr-3">
                                                1234565
                                            </small>
                                        </td>
                                        <td>
                                            R$ 255,33
                                        </td>
                                        <td>
                                            Pendente
                                        </td>
                                        <td>
                                            Unidade Positivo Junior
                                        </td>
                                        <td>
                                            <a href="#" class="text-muted">
                                                <i class="fas fa-search"></i>
                                            </a>
                                        </td>
                                    <tr>
                                        <td>
                                            1231
                                        </td>
                                        <td>25/05/1585</td>
                                        <td>
                                            Alnuo Zé Silva -
                                            <small class="text-success mr-3">
                                                1234565
                                            </small>
                                        </td>
                                        <td>
                                            R$ 255,33
                                        </td>
                                        <td>
                                            Em producao
                                        </td>
                                        <td>
                                            Unidade Positivo Junior
                                        </td>
                                        <td>
                                            <a href="#" class="text-muted">
                                                <i class="fas fa-search"></i>
                                            </a>
                                        </td>
                                    </tr>
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
