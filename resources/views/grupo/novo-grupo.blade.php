@extends('layout.app')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cadastrando Grupos...</h3>
        </div>
        <div class="card-body">
            <form action="{{ url('grupos/salvar') }}" method="post">
                @csrf
                <div class="row">

                    <input type="hidden" name="id" value="{{old('id', $dados->id)}}">

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" name="nome" class="form-control" placeholder="Digite..." value="{{old('nome', $dados->nome)}}">
                        </div>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-body">
                        <div class="row">
                            <div class="col-6">
                                <a href="{{url('grupos')}}" class="btn btn-secondary">Voltar</a>
                            </div>
                            <div class="col-6">
                                <input type="submit" value="Cadastrar" class="btn btn-success float-right">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /.card-body -->
        </div>
    </div>
    <!-- /.content -->
@endsection
