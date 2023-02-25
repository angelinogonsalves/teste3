@extends('layout.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Produtos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">produtos</li>
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
                            <a href="{{url('produtos/criar')}}" class="btn btn-primary"> Adicionar Novo
                                <i class="nav-icon far fa-plus-square"> </i> </a>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Codigo RZ</th>
                                        <th>Produto</th>
                                        <th>Valor</th>
                                        <th>Ações</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>123</td>
                                        <td>rz4564
                                        </td>
                                        <td>camiseta</td>
                                        <td>60,00</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm">Ver | Editar</a>
                                            <a class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>123</td>
                                        <td>rz4564
                                        </td>
                                        <td>camiseta</td>
                                        <td>60,00</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm">Ver | Editar</a>
                                            <a class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>123</td>
                                        <td>rz4564
                                        </td>
                                        <td>camiseta</td>
                                        <td>60,00</td>>
                                        <td>
                                            <a class="btn btn-primary btn-sm">Ver | Editar</a>
                                            <a class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                            </table>
                        </div>

                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
