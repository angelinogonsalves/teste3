@extends('layout.app')

@section('content')
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Incluindo pedidos</h3>
        </div>

        <div class="card-body">
            <form>
                <div class="row">
                    
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Selecione a Unidade que corresponde este pedido *</label>
                            <div class="select2-purple">
                                <select class="select2" multiple="multiple" data-placeholder="Selecione unidades"
                                    data-dropdown-css-class="select2-purple" style="width: 100%;">
                                    <option>Positivo sul</option>
                                    <option>Positivo Junior</option>
                                    <option>Positivo Norte</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Nome Completo Aluno (Atleta) *</label>
                            <input type="text" name="nome_aluno" class="form-control"
                                placeholder="informe..">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>R.A (registro academico do aluno) *</label>
                            <input type="text" name="nome_aluno" class="form-control"
                                placeholder="Informe..">
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Tamanhos disponiveis</label>
                            <div class="select2-purple">
                                <select class="select2" multiple="multiple" data-placeholder="Selecione tamanhos"
                                    data-dropdown-css-class="select2-purple" style="width: 100%;">
                                    <option>P</option>
                                    <option>M</option>
                                    <option>G</option>
                                    <option>GG</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Valor Produto (R$)</label>
                            <input type="text" name="valor_produto" class="form-control"
                                placeholder="Escreva valor 0,00">
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <label>Produtos dipniveis nas seguintes unidades</label>
                            <div class="select2-purple">
                                <select class="select2" multiple="multiple" data-placeholder="Selecione unidades"
                                    data-dropdown-css-class="select2-purple" style="width: 100%;">
                                    <option>Positivo sul</option>
                                    <option>Positivo Junior</option>
                                    <option>Positivo Norte</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label for="exampleInputFile">Imagens do Produto</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Escolher arquivo de img</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="timeline-item">
                                <h3 class="timeline-header"><a href="#">Imagens</a> do Produto</h3>
                                <div class="timeline-body">
                                    <img src="https://placehold.it/150x100" alt="...">
                                    <img src="https://placehold.it/150x100" alt="...">
                                    <img src="https://placehold.it/150x100" alt="...">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="exampleInputFile">Imagem da de grade do produto</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Escolher arquivo de img</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="timeline-item">
                                <h3 class="timeline-header"><a href="#">Imagens</a> das medidas do produto</h3>
                                <div class="timeline-body">
                                    <img src="https://placehold.it/150x100" alt="...">
                                    <img src="https://placehold.it/150x100" alt="...">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-12">
                </div>
                <div class="col-6">
                    <a href="#" class="btn btn-secondary">Voltar</a>
                </div>
                <div class="col-6">
                    <input type="submit" value="Cadastrar" class="btn btn-success float-right">
                </div>
            </div>
        </div>
    </div>
@endsection
