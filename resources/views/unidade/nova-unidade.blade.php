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
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>CPF / CNPJ</label>
                            <input type="text" name="cpf_cnpj" class="form-control" placeholder="Digite...">
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Razão Social</label>
                            <input type="text" name="razaosocial" class="form-control" placeholder="Digite...">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Nome Fantasia</label>
                            <input type="text" name="nome_dantasia" class="form-control" placeholder="Digite...">
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="text" name="email" class="form-control" placeholder="Digite...">
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Telefone</label>
                            <input type="text" name="celular" class="form-control" placeholder="informe..">
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <label>Endereço:</label>
                            <input type="text" name="endereco" class="form-control" placeholder="Endereço">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Número</label>
                            <input type="text" name="nuemero" class="form-control" placeholder="nuemro">
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="form-group">
                            <label>Bairro</label>
                            <input type="text" name="bairro" class="form-control" placeholder="Bairro">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>CEP</label>
                            <input type="text" name="cep" class="form-control" placeholder="CEP">
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Cidade</label>
                            <input type="text" name="cidade" class="form-control" placeholder="Cidade">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Estado - UF</label>
                            <select class="form-control select" style="width: 100%;">
                                <option selected="selected">Selecione..</option>
                                <option>PR</option>
                                <option>SP</option>
                                <option>SC</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-body">
                        <div class="row">
                            <div class="col-6">
                                <a href="#" class="btn btn-secondary">Voltar</a>
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
