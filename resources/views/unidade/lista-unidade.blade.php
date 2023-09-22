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
                            <a href="{{url('unidades/cadastro')}}"class="btn btn-primary">Adicionar Novo <i
                                    class="nav-icon far fa-plus-square"></i></a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="unidades" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Grupo</th>
                                        <th>Unidade Nome Fantasia</th>
                                        <th>CNPJ</th>
                                        <th>Cidade</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($dados as $d)
                                        <tr>
                                            <td>{{$d->id}}</td>
                                            <td>{{@$d->grupo->nome}}</td>
                                            <td>{{$d->nome_fantasia}}</td>
                                            <td>{{$d->cnpj}}</td>                                            
                                            <td>{{$d->cidade}}</td>                                                                                        
                                            <td>
                                            <form action="{{url('unidades/excluir',[$d->id])}}" method="post">
                                                @csrf
                                                <a class="btn btn-primary btn-sm" href="{{url('unidades/cadastro',[$d->id])}}">Ver | Editar</a>                                                
                                                    <input type="submit" value="Delete" class="btn btn-danger btn-sm">                                                    
                                                </form>                                              
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Não foram encontradas Unidades</td>                                      
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
    </section>
    <script>
        $(document).ready(function () {         
            var table = new DataTable('#unidades', {
                language: {
                    url: "{{asset('plugins/datatables/datatable-pt-BR.json')}}"
                },
             });

        });
    </script>
@endsection
