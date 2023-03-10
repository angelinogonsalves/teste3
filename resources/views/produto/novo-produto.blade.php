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

                <div class="row">
                    <div class="col-sm-4">
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
                                    data-live-search="true" data-placeholder="Selecione tamanhos">
                                    @forelse ($lista_tamanhos as $t)
                                        <option value="{{ $t->id }}"
                                            {{ in_array($t->id, $tamanhos_selecionados) ? 'selected=""' : '' }}>
                                            {{ $t->tamanho }}</option>
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
                                    data-live-search="true" data-placeholder="Selecione as unidades">
                                    @forelse ($lista_unidades as $u)
                                        <option value="{{ $u->id }}"
                                            {{ in_array($u->id, $unidades_selecionadas) ? 'selected=""' : '' }}>
                                            {{ $u->nome_fantasia }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="form-group">
                            <label for="exampleInputFile">Imagem do produto</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="imagem1" class="custom-file-input" id="">
                                    <label class="custom-file-label" for="">Escolher arquivo </label>
                                </div>
                                <div class="input-group-append">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12">
                        <div class="form-group">
                            <div class="" >
                                <img class="rounded mx-auto d-block"
                                    src="{{ url("storage/produtos/{$dados->imagem1}") }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="form-group">
                            <label for="exampleInputFile">Imagem da de grade do produto</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="imgmedidas" class="custom-file-input" id="">
                                    <label class="custom-file-label" for="">Escolher arquivo </label>
                                </div>
                                <div class="input-group-append">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="timeline-item">
                                <h3 class="timeline-header"><a href="#">Imagem</a> das medidas do
                                    produto</h3>
                                <div class="">
                                    <img  class="rounded mx-auto d-block" src="{{ url("storage/produtos/{$dados->imagem_medidas}") }}" alt="...">
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
                        <input type="submit" value="Salvar Produto" class="btn btn-success float-right">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="uploadimagebannerModal" class="modal" role="dialog" data-backdrop="static">

        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Imagem</h5>
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
                            <button class="btn btn-common" id="cortarbanner">Cortar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {


            // $("#valor_unitario").maskMoney({
            //     prefix: "",
            //     decimal: ",",
            //     thousands: "."
            // });
            alert('teste pag pro');
            $largura = 400; //horizontal   
            $altura = 650;

            //$largura = 650; //vertical   
            //$altura  = 400;


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

                var n = $("#imagem_principal img").length;

                if (n >= 3) {
                    sweetAlert("São Permitidas até 3 Imagens");
                } else {
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
                }
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
                    $.ajax({
                        url: '{{ url('/produtos/corta') }}',
                        type: "POST",
                        data: {
                            _token: CSRF_TOKEN,
                            "pasta": "anuncio",
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

                            swal('Imagem Adicionada', {
                                icon: "success",
                            });
                        },
                        complete: function() {

                        },
                        beforeSend: function() {
                            swal('Processando...', {
                                icon: "info",
                                buttons: false
                            })
                        },
                        error: function(data) {}
                    });
                })
            });
        });


        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        function excluiimagem(elem) {
            $(elem).parents('.imguniforme').remove();
        };
    </script>
@endsection
