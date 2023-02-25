@extends('layout.app')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cadastrando usuarios...</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-sm-5">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Nome Completo</label>
                            <input type="text" name="nome_completo" class="form-control" placeholder="Digite...">
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="text" name="email" class="form-control" placeholder="Digite...">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Senha</label>
                            <input type="text" name="senha" class="form-control" placeholder="Digite...">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Repetir senha</label>
                            <input type="text" name="repetir_senha" class="form-control" placeholder="Digite...">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Tipo de usuario</label>
                            <select class="form-control select" style="width: 100%;">
                                <option selected="selected">Selecione..</option>
                                <option>Admin</option>
                                <option>Cordenador</option>
                                <option>Aluno</option>
                            </select>
                        </div>
                    </div>
                    <!-- condi;áo pra mstrar escola caso seja cordenador-->
                    <div class="col-12 col-sm-12">
                        <div class="form-group">
                            <label>Vincular unidade do Aluno</label>
                            <div class="select-purple">
                                <select class="select" multiple="multiple" data-placeholder="selecione unidade"
                                    data-dropdown-css-class="select2-purple" style="width: 100%;">
                                    <option>Alabama</option>
                                    <option>Alaska</option>
                                </select>
                            </div>
                        </div>
                        <!-- /.form-group -->
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Celular (WhastsApp)</label>
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
            </form>

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
            <!-- /.card-body -->
        </div>
        <!-- /.content -->
    </div>
@endsection
