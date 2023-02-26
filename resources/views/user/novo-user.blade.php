@extends('layout.app')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cadastrando usuarios...</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <form action="{{ url('usuarios/salvar') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{old('id', $dados->id)}}">
                <div class="row">
                    <div class="col-sm-5">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Nome Completo</label>
                            <input type="text" name="nome" class="form-control" placeholder="Digite..." value="{{old('nome', $dados->nome)}}">
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="text" name="email" class="form-control" placeholder="Digite..."  value="{{old('email', $dados->email)}}">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Senha</label>
                            <input type="text" name="password" class="form-control" placeholder="Digite..." value="{{old('password')}}">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Repetir senha</label>
                            <input type="text" name="password_confirmation" class="form-control" placeholder="Digite..." value="{{old('password_confirmation')}}">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Tipo de usuario</label>
                            <select class="form-control select" style="width: 100%;" name="tipo_usuario">
                                <option value="" >Selecione...</option>
                                <option value="1" {{old('tipo_usuario', $dados->tipo_usuario) == 1 ? 'selected' : '' }}>Admin</option>
                                <option value="2" {{old('tipo_usuario', $dados->tipo_usuario) == 2 ? 'selected' : '' }}>Funcionário</option>
                                <option value="3" {{old('tipo_usuario', $dados->tipo_usuario) == 3 ? 'selected' : '' }}>Coordenador</option>
                                <option value="4" {{old('tipo_usuario', $dados->tipo_usuario) == 4 ? 'selected' : '' }}>Aluno</option>                                                            
                            </select>
                        </div>
                    </div>
                    <!-- condi;áo pra mstrar escola caso seja cordenador-->
                    <div class="col-12 col-sm-12">
                        <div class="form-group">
                            <label>Vincular unidade do Aluno</label>
                            <div class="select-purple">
                                <select name="unidade_id" class="form-control" data-placeholder="Selecione unidade">                                
                                    <option value="">Selecione...</option>                                    
                                    @forelse($unidades as $u)
                                        <option value="{{$u->id}}"  {{old('unidade_id', $dados->unidade_id) == $u->id ? 'selected' : '' }}>{{$u->nome_fantasia}}</option>
                                    @empty    
                                    @endforelse                                   
                                </select>
                            </div>
                        </div>
                        <!-- /.form-group -->
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Celular (WhastsApp)</label>
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
                            <input type="text" name="numero" class="form-control" placeholder="numero" value="{{old('numero', $dados->numero)}}">
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
                                <option value="PR" {{old('uf', $dados->uf) == "PR" ? 'selected' : '' }}>PR</option>
                                <option value="SP" {{old('uf', $dados->uf) == "SP" ? 'selected' : '' }}>SP</option>
                                <option value="SC" {{old('uf', $dados->uf) == "SC" ? 'selected' : '' }}>SC</option>                               
                            </select>
                        </div>
                    </div>

                </div>
          

            <div class="timeline-item">
                <div class="timeline-body">
                    <div class="row">
                        <div class="col-6">
                            <a href="" class="btn btn-secondary">Voltar</a>
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
        <!-- /.content -->
    </div>
@endsection
