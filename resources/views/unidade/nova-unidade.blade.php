@extends('layout.app')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cadastrando Unidades...</h3>
        </div>
        <div class="card-body">
            <form action="{{ url('unidades/salvar') }}" method="post">
                @csrf
                <div class="row">

                    <input type="hidden" name="id" value="{{old('id', $dados->id)}}">

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>CPF / CNPJ</label>
                            <input type="text" name="cnpj" class="form-control" placeholder="Digite..." value="{{old('cnpj', $dados->cnpj)}}">
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Razão Social</label>
                            <input type="text" name="razao_social" class="form-control" placeholder="Digite..." value="{{old('razao_social', $dados->razao_social)}}">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Nome Fantasia</label>
                            <input type="text" name="nome_fantasia" class="form-control" placeholder="Digite..." value="{{old('nome_fantasia', $dados->nome_fantasia)}}">
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="text" name="email" class="form-control" placeholder="Digite..." value="{{old('email', $dados->email)}}">
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Telefone</label>
                            <input type="text" name="telefone" class="form-control" placeholder="informe.." value="{{old('telefone', $dados->telefone)}}">
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <label>Endereço:</label>
                            <input type="text" name="endereco" class="form-control" placeholder="Endereço" value="{{old('endereco', $dados->endereco)}}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Número</label>
                            <input type="text" name="numero" class="form-control" placeholder="nuemro" value="{{old('numero', $dados->numero)}}">
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="form-group">
                            <label>Bairro</label>
                            <input type="text" name="bairro" class="form-control" placeholder="Bairro" value="{{old('bairro', $dados->bairro)}}">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>CEP</label>
                            <input type="text" name="cep" class="form-control" placeholder="CEP" value="{{old('cep', $dados->cep)}}">
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Cidade</label>
                            <input type="text" name="cidade" class="form-control" placeholder="Cidade" value="{{old('cidade', $dados->cidade)}}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Estado - UF</label>
                            <select class="form-control select" style="width: 100%;" name="uf">
                                <option value="">Selecione..</option>
                                <option value="PR" {{old('uf', $dados->uf) == 'PR' ? 'selected' : '' }}>PR</option>
                                <option value="SP" {{old('uf', $dados->uf) == 'SP' ? 'selected' : '' }}>SP</option>
                                <option value="SC" {{old('uf', $dados->uf) == 'SC' ? 'selected' : '' }}>SC</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-body">
                        <div class="row">
                            <div class="col-6">
                                <a href="{{url('unidades')}}" class="btn btn-secondary">Voltar</a>
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
