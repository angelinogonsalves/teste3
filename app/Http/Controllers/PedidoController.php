<?php

namespace App\Http\Controllers;

use App\Http\Requests\CadastraPedidoRequest;
use App\Http\Services\ModalidadeService;
use App\Http\Services\PagseguroService;
use App\Http\Services\PedidoService;
use App\Http\Services\UnidadeService;
use App\Models\Pedido;

class PedidoController extends BaseController
{
    public $pedidoService;

    public function __construct()
    {
        $this->pedidoService = new PedidoService();
    }

    public function index()
    {   
        $pedidos = $this->pedidoService->getAllPedidos();

        $pagseguroService = new PagseguroService();
        foreach($pedidos as $pedido) {
            if($pedido->podePagar()) {
                $pagseguroService->consultaPedido($pedido);
            }
        }

        if (auth()->user()->tipo_usuario == 4){        
            return view('aluno.aluno-home',['pedidos' => $pedidos]);
        }
        
        return view('pedido.lista-pedido',['dados' =>  $pedidos]);
    }

    public function verPedido(Pedido $pedido)
    {
        $unidadeService = new UnidadeService();
        $lista_unidades = $unidadeService->getAllUnidadesGrupo(auth()->user()->grupo_id);

        $modalidadeService = new ModalidadeService();
        $lista_modalidades = $modalidadeService->getAllModalidades();

        $pedido->itens->map(function($produto) {   
            $url =  url('/img/perfil.jpg');

            if ($produto->produto->imagens){            
                $url = url('/img/produtos')  . '/' . $produto->produto->imagens[0]->imagem;
            }
            return $produto->url = $url;
                     
        });              

        return view('pedido.novo-pedido',['dados' => $pedido,'lista_unidades' => $lista_unidades,'lista_modalidades' => $lista_modalidades]);
    }

    public function detalhesPedidoPrint(Pedido $pedido)
    {   
        return view('pedido.detalhes-pedido-print',['pedido' => $pedido]);
    }
    
    public function salvarPedido(CadastraPedidoRequest $request)
    {        
        $validated_Pedido = $request->validated();    
        return $this->pedidoService->salvaPedido($validated_Pedido);        
    }

    public function excluir(Pedido $pedido)
    { 
        $returnPedido = $this->pedidoService->excluirPedido($pedido);    
        return $this->responseData($returnPedido,'pedidos');
    }

    public function alterarStatus(Pedido $pedido)
    { 
        $returnPedido = $this->pedidoService->alterarStatusPedido($pedido);    
        return $this->responseData($returnPedido,'pedidos');
    }
}
