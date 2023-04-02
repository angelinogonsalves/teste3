@extends('layout.app')

@section('content')
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Pedidos.. </h3>
        </div>

        <div class="card-body">
            <form>
                <div class="row">
                    <input type="hidden" name="id" id="id" value="{{ old('id', $dados->id) }}">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Selecione a unidade *</label>
                            <div class="select-purple">
                                <select name="unidade_id" id="unidade_id" class="form-control"
                                    data-placeholder="Selecione as unidades" onchange="buscaProdutos()">
                                    <option value="">Selecione...</option>
                                    @forelse ($lista_unidades as $u)
                                        <option value="{{ $u->id }}"
                                            @if ($u->id == $dados->unidade_id) selected="" @endif>{{ $u->nome_fantasia }}
                                        </option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Nome Completo do Aluno (Atleta)*</label>
                            <input type="text" name="nome_aluno" id="nome_aluno" class="form-control"
                                placeholder="informe.." value="{{ $dados->nome_aluno }}">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>R.A (Registro academico)*</label>
                            <input type="text" name="ra_aluno" id="ra_aluno" class="form-control"
                                placeholder="Informe.." value="{{ $dados->ra_aluno }}">
                        </div>
                    </div>
                    <div class="col-12 col-sm-12">
                        <h4 class="mt-12"><small>Esolha o produto e adicione aos itens</small></h4>
                        <hr>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Escolha produto para Adicionar aos itens *</label>
                            <div class="select-purple">
                                <select name="add_produto" id="add_produto" class="form-control" onchange="buscaTamanhos()";
                                    data-placeholder="Selecione unidades"style="width: 100%;">
                                    <option value="">Selecione...</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-4">
                        <div class="col-md-4  d-flex ">
                            <img src="{{ asset('img/perfil.jpg') }}" class="img-thumbnail" alt="produto">
                        </div>
                    </div> --}}
                    <div class="col-12 col-sm-12">
                        <label>Selecione um tamanho para o produto *</label>
                    </div>
                    <div class="col-12 col-sm-12">
                        <div class="form-group">
                            <div id="div_tamanhos" class="btn-group" data-toggle="buttons">
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4">
                        <div class="form-group">
                            <label>Selecione Modalidade (se houver)</label>
                            <div class="select-purple">
                                <select name="modalidade_id" id="modalidade_id" class="form-control"
                                    data-placeholder="Selecione Modalidade">
                                    <option value="">Selecione...</option>
                                    @forelse ($lista_modalidades as $m)
                                        <option value="{{ $m->id }}">{{ $m->modalidade }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Nome Personalizado (se houver)</label>
                            <input type="text" name="nome_personalizado" id="nome_personalizado" class="form-control"
                                placeholder="Informe..">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Numero Personalizado (se houver)</label>
                            <input type="text" name="numero_personalizado" id="numero_personalizado" class="form-control"
                                placeholder="Informe..">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12">
                    <h5 class="mt-12 text-center"><small>Confira os itens do pedido na tabela abaixo</small></h5>
                    <hr>
                </div>
                <div class="card-footer text-center">
                    <button type="button" class="btn btn-primary btn-sm" onclick="adicionarItem();">
                        <i class="fas fa-cart-plus fa-lg mr-2"></i>
                        Adicionar item
                    </button>
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
                                <tbody id="tbodyitens_produto">
                                    @forelse ($dados->itens as $p)
                                        <tr class='itens_produtos' valor_produto="{{ $p->valor_unitario }}"
                                            unidade_id="{{ $p->unidade_id }}" produto_id="{{ $p->produto_id }}"
                                            tamanho_id="{{ $p->tamanho_id }}" modalidade_id="{{ $p->modalidade_id }}"
                                            nome_personalizado="{{ $p->nome_personalizado }}"
                                            numero_personalizado="{{ $p->numero_personalizado }}">
                                            <td><img width="50px" src="{{$p->url}}" class="img-thumbnail" alt="produto">
                                            <a target="blank"
                                                    href="{{ url('/produtos/detalhes', [$p->produto_id]) }}"> {{ $p->produto->produto }}</a>
                                            </td>
                                            <td class="align-middle"><input class='form-control-sm quantidade' required type='number'
                                                    value='{{ $p->quantidade }}' min='0'max='10'
                                                    step='0' onchange='calcularTotal()' /></td>
                                            <td class="align-middle">@money($p->valor_unitario)</td>
                                            <td class="align-middle">{{ $p->tamanho->tamanho }}</td>
                                            <td class="align-middle">{{ $p->modalidade->modalidade }}</td>
                                            <td class="align-middle">{{ $p->modalidade->nome_personalizado }}</td>
                                            <td class="align-middle">{{ $p->modalidade->numero_personalizado }}</td>
                                            <td class="align-middle">
                                                <button class='btn btn-sm btn-default excluir' type='button'
                                                    title='Remover'> <span class='text-danger fas fa-trash-alt'></span>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
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
                                <td><strong id="totalProdutos"></strong></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <button onclick="salvar();" type="button" class="btn btn-success float-center" id="fechar-pedido"><i
                        class="far fa-credit-card"></i>
                    Fechar Pedido
                </button>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            buscaProdutos();
            calcularTotal();
            $('.excluir').on('click', function() {
                $(this).parent().parent().remove();
                calcularTotal();
            });

        });

        function buscaProdutos() {
            unidade_id = $("#unidade_id").val();

            $("#add_produto").empty().append('<option value="">Selecione...</option>');

            if (unidade_id) {
                url = '{{ url('/produtos/listaporunidade/') }}' + '/' + unidade_id;

                $.ajax({
                    type: 'GET',
                    url: url,
                    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                    async: true,
                    success: function(data) {
                        console.log(data);
                        $.each(data, function(key, value) {
                            $("#add_produto").append('<option '+
                                ' personaliza_nome='+value.personaliza_nome+
                                ' personaliza_numero='+value.personaliza_numero+
                                ' personaliza_modalidade='+value.personaliza_modalidade+
                                ' url='+value.url+
                                ' valor=' + value.valor + ' value=' + value
                                .id + '>' + value.produto +
                                '</option>');
                        });
                    },

                    complete: function() {

                    },
                    beforeSend: function() {

                    },
                    error: function(data) {

                    }
                });
            }
        }

        function buscaTamanhos() {
            $("#div_tamanhos").html('');

            produto_id = $("#add_produto").val();

            if (produto_id) {
                url = '{{ url('/tamanhos/listaporproduto/') }}' + '/' + produto_id;

                $.ajax({
                    type: 'GET',
                    url: url,
                    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                    async: true,
                    success: function(data) {
                        $.each(data, function(key, value) {
                            $("#div_tamanhos").append(
                                ' <label class="btn btn-default text-center">' +
                                '   <input type="radio" name="add_tamanho_id" value="' + value.id +
                                '" autocomplete="off"> ' +
                                '     <span class="text-xl">' + value.tamanho + '</span> ' +
                                ' </label> ');
                        });
                    },
                });
            }
        }

        function adicionarItem() {
            let unidade_id = $('#unidade_id').val();
            let nome_aluno = $('#nome_aluno').val();
            let ra_aluno = $('#ra_aluno').val();
            let produto_id = $('#add_produto').val();
            let nome_produto = $("#add_produto option:selected").text();
            let valor_produto = $("#add_produto option:selected").attr('valor');
            let modalidade_id = $('#modalidade_id').val();
            let nome_modalidade = $("#modalidade_id option:selected").text();
            let nome_personalizado = $('#nome_personalizado').val();
            let numero_personalizado = $('#numero_personalizado').val();
            let personaliza_nome = $("#add_produto option:selected").attr('personaliza_nome');
            let personaliza_numero = $("#add_produto option:selected").attr('personaliza_numero');
            let personaliza_modalidade = $("#add_produto option:selected").attr('personaliza_modalidade');
            let url_imagem = $("#add_produto option:selected").attr('url');

            let tamanho_id = false;

            if (document.querySelector('input[name="add_tamanho_id"]:checked')) {
                tamanho_id = document.querySelector('input[name="add_tamanho_id"]:checked').value;
            }

            let formatter = new Intl.NumberFormat('pt-BR', {
                style: 'currency',
                currency: 'BRL',
            });
            valor = formatter.format(valor_produto).substring(3);
         
            if (unidade_id && nome_aluno && ra_aluno && tamanho_id) {
                if (personaliza_nome == 1 && nome_personalizado == ''){
                    alert("Preencha o Nome personalizado");
                } else if (personaliza_numero == 1 && numero_personalizado == '') {
                    alert("Preencha o Número personalizado");
                } else if (personaliza_modalidade == 1 && modalidade_id == '') {
                    alert("Preencha a Modalidade");
                } else {
                    $("#tbodyitens_produto").append("<tr class='itens_produtos' valor_produto='" + valor_produto + "' ra_aluno='" +
                        ra_aluno + "' nome_aluno='" + nome_aluno + "' unidade_id='" + unidade_id + "' produto_id='" + produto_id +
                        "' tamanho_id='" + tamanho_id + "' modalidade_id='" + modalidade_id + "' nome_personalizado='" +
                        nome_personalizado + "' numero_personalizado='" + numero_personalizado + "'>" +
                        "<td><img width='50px' src='"+url_imagem+"' class='img-thumbnail' alt='produto'>"+
                        "<a target='blank' href=''>  " + nome_produto + "</a></td>" +
                        "<td><input class='form-control-sm quantidade' required type='number' value='1' min='0' max='10' step='0'/ onchange='calcularTotal()'></td>" +
                        "<td>" + valor + "</td>" +
                        "<td>" + tamanho_id + "</td>" +
                        "<td>" + nome_modalidade + "</td>" +
                        "<td>" + nome_personalizado + "</td>" +
                        "<td>" + numero_personalizado + "</td>" +
                        "<td> <button class='btn btn-sm btn-default excluir' type='button' title='Remover'> <span class='text-danger fas fa-trash-alt'></span> </button></td>" +
                        "</tr>"
                    );

                    excluir();
                    calcularTotal();
                    adicionarQuantidade();
                }
            } else {
                alert("Preencha todos os campos");
            }
        }

        function excluir() {

        }

        function calcularTotal() {
            let total = 0;

            if ($('.itens_produtos').length > 0) {
                $.each($('.itens_produtos'), function(key, value) {
                    let valor = $(this).attr('valor_produto');

                    if ($(this).find('.quantidade').val().length > 0) {
                        valor *= $(this).find('.quantidade').val();
                    }

                    total += parseFloat(valor);
                });

                let formatter = new Intl.NumberFormat('pt-BR', {
                    style: 'currency',
                    currency: 'BRL',
                });
                total = formatter.format(total).substring(3);
            }

            $('#totalProdutos').text('R$ ' + total);
        }

        function adicionarQuantidade() {
            $('.quantidade').on('keyup', function() {
                calcularTotal();
            });
        }

        function salvar() {
            let produtos = [];

            if (0 == $('.itens_produtos').length) {
                alert('Adicione ao menos um produto');

                return;
            }

            let unidade_id = $('#unidade_id').val();
            let nome_aluno = $('#nome_aluno').val();
            let ra_aluno = $('#ra_aluno').val();
            let id = $('#id').val();

            $.each($('.itens_produtos'), function(key, value) {

                let produto_id = $(this).attr('produto_id')
                let modalidade_id = $(this).attr('modalidade_id');

                alert(modalidade_id);
                let tamanho_id = 1; // só para salvar, depois arrumar o front
                let nome_personalizado = $(this).attr('nome_personalizado');
                let numero_personalizado = $(this).attr('numero_personalizado');
                let quantidade = $(this).find('.quantidade').val();

                // Verifica se foi informado uma quantidade.
                if (quantidade == 0 || !quantidade) {
                    produtos = [];

                    return false;
                }

                produtos.push({
                    produto_id,
                    quantidade,
                    tamanho_id,
                    modalidade_id,
                    nome_personalizado,
                    numero_personalizado
                });
            });

            if (0 == produtos.length) {
                alert('Informe uma quantidade para o produto');
                return;
            }

            urlSalvar = '{{ url('/pedidos/salvar/') }}';

            $.ajax({
                url: urlSalvar,
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    id,
                    unidade_id,
                    nome_aluno,
                    ra_aluno,
                    produtos
                },
                success: function(data) {
                    if (data.success) {
                        alert('Pedido Realizado com sucesso');
                        window.location.href = "{{url('pedidos')}}";
                    } else {
                        alert('Falha ao realizado Pedido');
                    }
                },
                error: function(request, status, error) {
                    alert('Erro ao tentar salvar')
                }
            });
        }
    </script>
@endsection
