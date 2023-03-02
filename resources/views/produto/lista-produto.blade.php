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
                            <a href="{{url('produtos/cadastro')}}" class="btn btn-primary"> Adicionar Novo
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
                                    @forelse($dados as $d)
                                        <tr>
                                            <td>{{$d->id}}</td>
                                            <td>{{$d->codigo}}</td>
                                            <td>{{$d->descricao}}</td>                                            
                                            <td>{{$d->valor}}</td>                                                                                        
                                            <td>
                                            <form action="{{url('unidades/excluir',[$d->id])}}" method="post">
                                                @csrf
                                                <a class="btn btn-primary btn-sm" href="{{url('produtos/cadastro',[$d->id])}}">Ver | Editar</a>                                                
                                                    <input type="submit" value="Delete" class="btn btn-danger btn-sm">                                                    
                                                </form>                                              
                                            </td>
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
