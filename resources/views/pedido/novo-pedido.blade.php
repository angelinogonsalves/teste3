@extends('layout.app')

@section('content')
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Incluindo pedidos.. </h3>
        </div>

        <div class="card-body">
            <form>
                <div class="row">

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Selecione a unidade *</label>
                            <div class="select-purple">
                                <select class="select-purple form-control" data-placeholder="Selecione unidades"
                                    style="width: 100%;">
                                    <option>Selecione...</option>
                                    <option>Positivo sul</option>
                                    <option>Positivo Junior</option>
                                    <option>Positivo Norte</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Nome Completo do Aluno (Atleta)*</label>
                            <input type="text" name="nome_aluno" class="form-control" placeholder="informe..">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>R.A (Registro academico)*</label>
                            <input type="text" name="nome_aluno" class="form-control" placeholder="Informe..">
                        </div>
                    </div>
                    <div class="col-12 col-sm-12">
                        <h4 class="mt-12"><small>Esolha o produto e adicione aos itens</small></h4>
                        <hr>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label>Escolha produto para Adcionar aos itens</label>
                            <div class="select-purple">
                                <select class="select-purple form-control"
                                    data-placeholder="Selecione unidades"style="width: 100%;">
                                    <option>Selecione...</option>
                                    <option>Calção azul faixa lisa - R$20,50</option>
                                    <option>camiseta pretas positivo R$50,60</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-3">
                        <div class="form-group">
                            <label>Selecione Modalidade (se houver)</label>
                            <div class="select-purple">
                                <select name="unidade_id" class="form-control" data-placeholder="Selecione Modalidade">
                                    <option>Selecione...</option>
                                    <option>Futebol</option>
                                    <option>Volei</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-sm-2">
                        <div class="form-group">
                            <label>Tamanhos disponiveis</label>
                            <div class="select-purple">
                                <select name="tamanho" class="form-control" data-placeholder="Selecione tamanhos">
                                    <option>P</option>
                                    <option>M</option>
                                    <option>G</option>
                                    <option>GG</option>
                                </select>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-12 col-sm-12">
                        <h5 class="mt-12"><small>Selecione um tamanho para o produto</small></h5>
                    </div>
                    <div class="col-12 col-sm-5">
                        <div class="form-group">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-default text-center">
                                    <input type="radio" name="color_option" id="color_option_b1" autocomplete="off">
                                    <span class="text-xl">P</span>
                                </label>
                                <label class="btn btn-default text-center">
                                    <input type="radio" name="color_option" id="color_option_b1" autocomplete="off">
                                    <span class="text-xl">PP</span>
                                </label>
                                <label class="btn btn-default text-center">
                                    <input type="radio" name="color_option" id="color_option_b2" autocomplete="off">
                                    <span class="text-xl">M</span>
                                </label>
                                <label class="btn btn-default text-center">
                                    <input type="radio" name="color_option" id="color_option_b3" autocomplete="off">
                                    <span class="text-xl">G</span>
                                </label>
                                <label class="btn btn-default text-center">
                                    <input type="radio" name="color_option" id="color_option_b4" autocomplete="off">
                                    <span class="text-xl">GG</span>
                                </label>
                                <label class="btn btn-default text-center">
                                    <input type="radio" name="color_option" id="color_option_b4" autocomplete="off">
                                    <span class="text-xl">40</span>
                                </label>
                                <label class="btn btn-default text-center">
                                    <input type="radio" name="color_option" id="color_option_b4" autocomplete="off">
                                    <span class="text-xl">12</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Nome Personalizado (se houver)</label>
                            <input type="text" name="nome_personalizado" class="form-control" placeholder="Informe..">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Numero Personalizado (se houver)</label>
                            <input type="text" name="nome_personalizado" class="form-control" placeholder="Informe..">
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <div class="btn btn-primary btn-sm">
                        <i class="fas fa-cart-plus fa-lg mr-2"></i>
                        Adcionar item
                    </div>
                </div>
            </form>

            <div class="row">
                <div class="col-12">
                    <!-- /.card -->
                    <div class="card">
                        <!-- /.card-header  usar modelo table que baixa em CSV-->
                        <div class="card-body table-responsive p-0">
                            <table id="tabela_itens_produto" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Produto</th>
                                        <th>Quantidade</th>
                                        <th>Valor Item</th>
                                        <th>Tamanho</th>
                                        <th>Modalidade</th>
                                        <th>Nome Pers.</th>
                                        <th>Nº Pers.</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="destalhes">Calção Feminino tipo liso</a></td>
                                        <td><input class="form-control-sm" type="number" value="" min="0"
                                                max="10" step="0" /></td>
                                        <td> 50,99 </td>
                                        <td>M</td>
                                        <td>Futebol</td>
                                        <td>Nome personalizado A </td>
                                        <td>2</td>
                                        <td> <a href="#" class="btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            <a href="#" class="btn-sm">
                                                <i class="fas fa-search"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="destalhes">Camiseta uniforme positivos modelo x</a></td>
                                        <td><input class="form-control-sm" type="number" value="" min="0"
                                                max="10" step="0" /></td>
                                        <td> 100,00 </td>
                                        <td>M</td>
                                        <td>Futebol</td>
                                        <td>Nome personalizado A </td>
                                        <td>2</td>
                                        <td> <a href="#" class="btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            <a href="#" class="btn-sm">
                                                <i class="fas fa-search"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-6">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Total de produtos:</th>
                                <td><strong>R$ 250.30</strong></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <button type="button" class="btn btn-success float-center"><i class="far fa-credit-card"></i>
                    Fechar Pedido
                </button>
            </div>
        </div>
    </div>
@endsection
