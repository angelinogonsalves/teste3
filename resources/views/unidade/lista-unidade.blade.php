@extends('layout.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>unidades</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">DataTables</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- /.card -->
                    <div class="card">
                        <div class="card-header">
                            <a href="{{url('unidades/criar')}}"class="btn btn-primary">Adicionar Novo <i
                                    class="nav-icon far fa-plus-square"></i></a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Unidade Nome Fantasia</th>
                                        <th>CNPJ</th>
                                        <th>Cidade</th>
                                        <th>Ações</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>123</td>
                                        <td>Positivo
                                        </td>
                                        <td>845266995000125</td>
                                        <td>Curitiba</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm">Ver | Editar</a>
                                            <a class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>123</td>
                                        <td>Positivo
                                        </td>
                                        <td>845266995000125</td>
                                        <td>Curitiba</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm">Ver | Editar</a>
                                            <a class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>123</td>
                                        <td>Positivo
                                        </td>
                                        <td>845266995000125</td>
                                        <td>Curitiba</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm">Ver | Editar</a>
                                            <a class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>

                                    </tfoot>
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
