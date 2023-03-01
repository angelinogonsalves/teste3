@extends('layout.app')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cadastrando Produto...</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">            
            <form action="{{ url('produtos/salvar') }}" method="post">
                @csrf
                
                <input type="hidden" name="id" value="{{old('id', $dados->id)}}">

                <div class="row">
                    <div class="col-sm-4">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Código RZ</label>
                            <input type="text" name="codigo" class="form-control" placeholder="código RZ" value="{{old('codigo', $dados->codigo)}}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Nome do Produto</label>
                            <input type="text" name="produto" class="form-control" placeholder="Escreva nome do produto" value="{{old('id', $dados->id)}}">
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Descrição do Produto</label>
                            <textarea class="form-control" name="descricao" rows="3" placeholder="Descrição">{{old('descricao', $dados->descricao)}}</textarea>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Tamanhos disponiveis</label>
                            <div class="select2-purple">
                                <select class="selectpicker bs-select form-control" multiple="" data-live-search="true"  data-placeholder="Selecione tamanhos">
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
                            <input type="text" name="valor" class="form-control" placeholder="Escreva valor 0,00"  value="{{old('valor', $dados->valor)}}">
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <label>Produtos dipniveis nas seguintes unidades</label>
                            <div class="select2-purple">
                            <select class="selectpicker bs-select form-control" multiple="" data-live-search="true"  data-placeholder="Selecione unidades">                                
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
            </form>
        </div>
    </div>
@endsection


