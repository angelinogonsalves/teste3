@extends('layout.app')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cadastrando usuarios...</h3>
        </div>

        <div class="card-body">
            <form action="{{ url('usuarios/salvar') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ old('id', $dados->id) }}">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Tipo de usuario</label>
                            <select class="form-control select" id="tipo_usuario" style="width: 100%;" 
                                name="tipo_usuario" onchange="exibir_ocultar(this)"
                            >
                                <option value="">Selecione...</option>
                                <option value="1"
                                    {{ old('tipo_usuario', $dados->tipo_usuario) == 1 ? 'selected' : '' }}
                                >
                                    1 - Admin
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Nome Completo</label>
                            <input type="text" name="nome" class="form-control" placeholder="Digite..."
                                value="{{ old('nome', $dados->nome) }}">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>CPF</label>
                            <input type="text" name="cpf" class="form-control" placeholder="informe.."
                                value="{{ old('cpf', $dados->cpf) }}"
                            >
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="text" id="ra" name="email" class="form-control" placeholder="Digite..."
                                value="{{ old('email', $dados->email) }}"
                            >
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Senha</label>
                            <input type="text" name="password" class="form-control" placeholder="Digite...">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Repetir senha</label>
                            <input type="text" name="password_confirmation"
                                class="form-control" placeholder="Digite..."
                            >
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
        </div>
    </div>
@endsection
