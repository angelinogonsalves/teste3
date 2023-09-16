@extends('layout.app')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cadastrando Produto...</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ url('produtos/salvar') }}" method="post" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{ old('id', $dados->id) }}">

                <div class="row col-md-12">
                    <div class="col-sm-3">
                        <label>Produto disponível para:</label>
                        <div class="form-group">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="disponibilidade" id="disponibilidade_coordenador" value="coordenador" {{ (old('disponibilidade', $dados->disponibilidade) == 'coordenador' ? 'checked' : '')}}>
                                <label class="form-check-label" for="disponibilidade_coordenador">coordenador</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="disponibilidade" id="disponibilidade_aluno" value="aluno" {{ (old('disponibilidade', $dados->disponibilidade) == 'aluno' ? 'checked' : '')}}>
                                <label class="form-check-label" for="disponibilidade_aluno">aluno</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Código RZ</label>
                            <input type="text" name="codigo" class="form-control" placeholder="código RZ"
                                value="{{ old('codigo', $dados->codigo) }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Nome do Produto</label>
                            <input type="text" name="produto" class="form-control" placeholder="Escreva nome do produto"
                                value="{{ old('produto', $dados->produto) }}">
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Descrição do Produto</label>
                            <textarea class="form-control" name="descricao" rows="3" placeholder="Descrição">{{ old('descricao', $dados->descricao) }}</textarea>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Tamanhos disponiveis</label>
                            <div class="select2-purple">
                                <select name="tamanhos[]" class="selectpicker bs-select form-control" multiple=""
                                    data-live-search="true" title="Selecione ">
                                    @forelse ($lista_tamanhos as $t)
                                        <option value="{{ $t->id }}"
                                            @if ($dados->tamanhos->find($t->id)) selected="" @endif> {{ $t->tamanho }}
                                        </option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Valor Produto (R$)</label>
                            <input type="text" name="valor" id="valor_unitario" class="form-control"
                                placeholder="Escreva valor 0,00"
                                value="{{ number_format($dados->valor ?? old('valor'), 2, ',', '.') }}">
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <label>Produtos disponiveis nas seguintes unidades</label>
                            <div class="select2-purple">
                                <select name="unidades[]" class="selectpicker bs-select form-control" multiple=""
                                    data-live-search="true" title="Selecione as unidades">
                                    @forelse ($lista_unidades as $u)
                                        <option value="{{ $u->id }}"
                                            @if ($dados->unidades->find($u->id)) selected="" @endif> {{ $u->nome_fantasia }}
                                        </option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Personaliza Nome</label>
                            <div class="select2-purple">
                                <select name="personaliza_nome" class="form-control">
                                    <option value="0" @if ($dados->personaliza_nome != 1) ? selected="" @endif>Não
                                    </option>
                                    <option value="1" @if ($dados->personaliza_nome == 1) ? selected="" @endif>Sim
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Personaliza Numero</label>
                            <div class="select2-purple">
                                <select name="personaliza_numero" class="form-control">
                                    <option value="0" @if ($dados->personaliza_numero != 1) ? selected="" @endif>Não
                                    </option>
                                    <option value="1" @if ($dados->personaliza_numero == 1) ? selected="" @endif>Sim
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Personaliza Modalidade</label>
                            <div class="select2-purple">
                                <select name="personaliza_modalidade" class="form-control">
                                    <option value="0" @if ($dados->personaliza_modalidade != 1) ? selected="" @endif>Não
                                    </option>
                                    <option value="1" @if ($dados->personaliza_modalidade == 1) ? selected="" @endif>Sim
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group text-center">
                                    <label for="fu_imagem_principal">
                                        <span> <a class="btn btn-primary">Adicionar Foto (275x350)
                                                <i class="fas fa-desktop"></i></a>
                                        </span>
                                        <input type="file" id="fu_imagem_principal" name="fu_imagem_principal"
                                            style="display:none" class="custom-file-input">
                                    </label>
                                </div>

                                <div id="imagem_principal" class="row d-flex justify-content-center">

                                    @forelse ($dados->imagens as $i)
                                        @if ($i->tipo == 'P')
                                            <div class="col-md-4 imgProduto">
                                                <div class="form-group">
                                                    <img src="{{ $i->url }}" class="img-thumbnail" id="img_produto"
                                                        name="img_produto" data-nome="' . $name . '" />
                                                    <input type="hidden" name="foto_produto[]"
                                                        value="{{ $i->imagem }}">
                                                    <div class="row text-center">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <button class="btn btn-danger btnexcluiimagem"
                                                                    onclick="excluiimagem(this)"><i
                                                                        class="fas fa-times-circle"> </i>Remover</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                    </div>
                    <div class="col-6">
                        <a href="{{ url('produtos') }}" class="btn btn-secondary">Voltar</a>
                    </div>
                    <div class="col-6">
                        <input type="submit" value="Salvar Produto" class="btn btn-success float-right">
                    </div>
                </div>
            </form>
        </div>

        <div id="uploadimagebannerModal" class="modal" role="dialog" data-backdrop="static">

            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cortar Imagem</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center">
                                    <input type="hidden" id="destino_imagem" value="">
                                    <div id="image_demo"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col-md-12">
                                <button class="btn btn-primary" id="cortarbanner">Cortar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>



    </div>
    <script>
        $(document).ready(function() {

            $largura = 275; //horizontal   
            $altura = 350;

            $image_crop_banner = $('#image_demo').croppie({
                enableExif: true,
                viewport: {
                    width: $largura - 50,
                    height: $altura - 50,
                    type: 'square' //circle
                },
                boundary: {
                    width: $largura,
                    height: $altura
                }
            });


            $('#fu_imagem_principal').on('change', function() {

                $('#destino_imagem').val('imagem_principal');

                var reader = new FileReader();
                reader.onload = function(event) {
                    $image_crop_banner.croppie('bind', {
                        url: event.target.result
                    }).then(function() {
                        //         console.log('jQuery bind complete');
                    });
                }
                reader.readAsDataURL(this.files[0]);
                $('#uploadimagebannerModal').modal('show');

                this.value = null;
            });

            $('#fu_imagem_tamanhos').on('change', function() {

                $('#destino_imagem').val('imagem_tamanhos');

                var reader = new FileReader();
                reader.onload = function(event) {
                    $image_crop_banner.croppie('bind', {
                        url: event.target.result
                    }).then(function() {
                        //         console.log('jQuery bind complete');
                    });
                }
                reader.readAsDataURL(this.files[0]);
                $('#uploadimagebannerModal').modal('show');

                this.value = null;
            });

            $('#cortarbanner').click(function(event) {


                $image_crop_banner.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function(response) {

                    var destino = $('#destino_imagem').val();
                    $.ajax({
                        url: '{{ url('/imagem/corta') }}',
                        type: "POST",
                        data: {
                            _token: CSRF_TOKEN,
                            "destino": destino,
                            "image": response
                        },

                        async: true,
                        success: function(data) {
                            $('#uploadimagebannerModal').modal('hide');
                            var destino = $('#destino_imagem').val();
                            if (destino == 'imagem_tamanhos') {
                                $('#imagem_tamanhos').html(data);
                            } else {
                                $('#imagem_principal').append(data);
                            }
                        },
                        complete: function() {

                        },
                        beforeSend: function() {},
                        error: function(data) {}
                    });
                })
            });
        });

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        function excluiimagem(elem) {
            $(elem).parents('.imgProduto').remove();
        };
    </script>
@endsection
