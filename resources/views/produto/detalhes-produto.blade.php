@extends('layout.app')

@section('content')
    <section class="content">
        <div class="card card-solid">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <h3 class="d-inline-block d-sm-none">NOME PRODUTO</h3>
                        <div class="col-12">
                            <img src="{{ asset('/img/produtos/camisateste.png') }}" class="img-thumbnail" class="product-image"
                                alt="Product Image">
                        </div>
                        <div class="col-12 product-image-thumbs">
                            <div class="product-image-thumb active"><img
                                    src="{{ asset('/img/produtos/agasalhoteste.png') }}" alt="Product Image"></div>
                            <div class="product-image-thumb"><img src="{{ asset('/img/produtos/camisateste.png') }}"
                                    alt="Product Image"></div>
                            <div class="product-image-thumb"><img src="{{ asset('/img/produtos/camisateste.png') }}"
                                    alt="Product Image"></div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <h3 class="my-3">NOME DO PRODUTO</h3>
                        <p>AQUI VAI A DESCRIÇÃO PRODUTO haven't heard of them jean shorts Austin. Nesciunt tofu stumptown
                            aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terr.</p>
                        <hr>
                        <h4 class="mt-3">Tamanhos disponíves <small></small></h4>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-default text-center">
                                <input type="radio" name="color_option" id="color_option_b1" autocomplete="off">
                                <span class="text-xl">S</span>
                            </label>
                            <label class="btn btn-default text-center">
                                <input type="radio" name="color_option" id="color_option_b2" autocomplete="off">
                                <span class="text-xl">M</span>
                            </label>
                            <label class="btn btn-default text-center">
                                <input type="radio" name="color_option" id="color_option_b3" autocomplete="off">
                                <span class="text-xl">P</span>
                            </label>
                            <label class="btn btn-default text-center">
                                <input type="radio" name="color_option" id="color_option_b4" autocomplete="off">
                                <span class="text-xl">G</span>
                        </div>

                        <div class="bg-gray py-2 px-3 mt-4">
                            <h2 class="mb-0">
                                R$ 115,00
                            </h2>
                        </div>
                        <div class="mt-4">
                            <a href="{{ url('pedidos') }}"class="btn btn btn-primary">Voltar para Pedidos</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection
