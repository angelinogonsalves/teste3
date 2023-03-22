@extends('layout.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Usuarios</h1>
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
                            <a href="{{url('usuarios/cadastro')}}" class="btn btn-primary">Adicionar Novo <i
                                    class="nav-icon far fa-plus-square"></i></a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="usuarios" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Tipo</th>
                                        <th>Ações</th>

                                    </tr>
                                </thead>

                                <tbody>                        
                                    @forelse($dados as $d)
                                    <tr>
                                        <td>{{$d->id}}</td>
                                        <td>{{$d->nome}}</td>
                                        <td>{{$d->email}}</td>                                            
                                        <td>{{$d->tipo_usuario}}</td>                                                                                        
                                        <td>
                                        <form action="{{url('usuarios/excluir',[$d->id])}}" method="post">
                                            @csrf
                                            <a class="btn btn-primary btn-sm" href="{{url('usuarios/cadastro',[$d->id])}}">Ver | Editar</a>                                                
                                                <input type="submit" value="Delete" class="btn btn-danger btn-sm">                                                    
                                            </form>                                              
                                        </td>
                                    </tr>
                                    @empty                                                                        
                                    <tr>
                                        <td colspan="5" class="text-center">Não foram encontradas Usuários</td>                                      
                                    </tr>
                                @endforelse                  
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
        <!-- /.container-fluid -->
    </section>
    <script>
        $(document).ready(function () {         
            var table = new DataTable('#usuarios', {
                language: {
                    url: "{{asset('plugins/datatables/datatable-pt-BR.json')}}"
                },
             });
        });
    </script>
@endsection
